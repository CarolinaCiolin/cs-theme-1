#!/usr/bin/env bash
set -euo pipefail

cd /var/www/html

for attempt in $(seq 1 60); do
  if [ -f wp-config.php ] && wp db check --allow-root >/dev/null 2>&1; then
    break
  fi
  sleep 2
done

if ! [ -f wp-config.php ] || ! wp db check --allow-root >/dev/null 2>&1; then
  echo "WordPress ou MariaDB não ficaram disponíveis a tempo." >&2
  exit 1
fi

# Codespaces termina TLS no proxy. WordPress deve usar o host HTTPS recebido
# pelo navegador, mas manter um fallback para comandos CLI sem HTTP_HOST.
if ! grep -q 'CS_CODESPACES_DYNAMIC_URL' wp-config.php; then
  php <<'PHP'
<?php
$path = '/var/www/html/wp-config.php';
$config = file_get_contents($path);
$marker = "/* That's all, stop editing! Happy publishing. */";
$snippet = <<<'CODE'
/* CS_CODESPACES_DYNAMIC_URL */
$cs_forwarded_proto = isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) ? strtolower( (string) $_SERVER['HTTP_X_FORWARDED_PROTO'] ) : '';
$cs_protocol = ( 0 === strpos( $cs_forwarded_proto, 'https' ) || ( ! empty( $_SERVER['HTTPS'] ) && 'off' !== strtolower( (string) $_SERVER['HTTPS'] ) ) ) ? 'https' : 'http';
$cs_host = isset( $_SERVER['HTTP_HOST'] ) ? preg_replace( '/[^A-Za-z0-9.:-\[\]]/', '', (string) $_SERVER['HTTP_HOST'] ) : 'localhost:8080';
$cs_url = $cs_protocol . '://' . ( $cs_host ?: 'localhost:8080' );
define( 'WP_HOME', $cs_url );
define( 'WP_SITEURL', $cs_url );
if ( 'https' === $cs_protocol ) {
    $_SERVER['HTTPS'] = 'on';
}
CODE;
if ( false !== strpos( $config, $marker ) ) {
    file_put_contents( $path, str_replace( $marker, $snippet . "\n" . $marker, $config ) );
}
PHP
fi

if ! wp core is-installed --allow-root >/dev/null 2>&1; then
  admin_password="${WP_ADMIN_PASSWORD:-}"
  if [ -z "$admin_password" ]; then
    admin_password="$(openssl rand -hex 16)"
    umask 077
    printf '%s\n' "$admin_password" > /tmp/cs-theme-1-wp-admin-password
  fi

  bootstrap_url="https://codespaces.local"
  if [ -n "${CODESPACE_NAME:-}" ] && [ -n "${GITHUB_CODESPACES_PORT_FORWARDING_DOMAIN:-}" ]; then
    bootstrap_url="https://${CODESPACE_NAME}-8080.${GITHUB_CODESPACES_PORT_FORWARDING_DOMAIN}"
  fi

  wp core install \
    --url="$bootstrap_url" \
    --title="CS Theme 1 – Development" \
    --admin_user="csadmin" \
    --admin_password="$admin_password" \
    --admin_email="devnull@example.test" \
    --skip-email \
    --allow-root
fi

wp theme activate cs-theme-1-christoph --allow-root
wp plugin activate cs-blocks --allow-root || true

if ! wp post list --post_type=page --name=demo-home --format=ids --allow-root | grep -q .; then
  demo_page_id="$(wp post create --post_type=page --post_status=publish --post_title='Demo Homepage' --post_name=demo-home --post_content='<!-- wp:pattern {"slug":"cs-theme-1-christoph/homepage"} /-->' --porcelain --allow-root)"
  wp option update show_on_front page --allow-root
  wp option update page_on_front "$demo_page_id" --allow-root
fi

wp rewrite structure '/%postname%/' --hard --allow-root >/dev/null
echo "WordPress pronto na URL HTTPS encaminhada da porta 8080."
if [ -f /tmp/cs-theme-1-wp-admin-password ]; then
  echo "Utilizador: csadmin"
  echo "Password temporária (apenas neste Codespace): $(cat /tmp/cs-theme-1-wp-admin-password)"
  echo "A password está guardada fora do workspace em /tmp/cs-theme-1-wp-admin-password."
fi
