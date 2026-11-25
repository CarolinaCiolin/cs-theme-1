FROM wordpress:6.6.2-php8.3-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends ca-certificates curl less mariadb-client openssl \
    && curl -fsSL https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar -o /usr/local/bin/wp \
    && chmod +x /usr/local/bin/wp \
    && apt-get purge -y --auto-remove curl \
    && rm -rf /var/lib/apt/lists/*

COPY setup-wordpress.sh /usr/local/bin/setup-wordpress
RUN chmod +x /usr/local/bin/setup-wordpress
