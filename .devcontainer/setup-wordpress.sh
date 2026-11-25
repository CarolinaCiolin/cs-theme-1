#!/usr/bin/env bash
set -euo pipefail

cd /var/www/html

for attempt in $(seq 1 60); do
  if wp core is-installed --allow-root >/dev/null 2>&1; then
    break
  fi
  if wp core download --force --allow-root >/dev/null 2>&1; then
    break
  fi
  sleep 2
done

if ! wp core is-installed --allow-root >/dev/null 2>&1; then
  admin_password="${WP_ADMIN_PASSWORD:-}"
  if [ -z "$admin_password" ]; then
    admin_password="$(openssl rand -hex 16)"
    umask 077
    printf '%s\n' "$admin_password" > /tmp/cs-theme-1-wp-admin-password
  fi

  wp core install \
    --url="http://localhost:8080" \
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
echo "WordPress pronto: http://localhost:8080"
if [ -f /tmp/cs-theme-1-wp-admin-password ]; then
  echo "Utilizador: csadmin"
  echo "Password temporária (apenas neste Codespace): $(cat /tmp/cs-theme-1-wp-admin-password)"
  echo "A password está guardada fora do workspace em /tmp/cs-theme-1-wp-admin-password."
fi
