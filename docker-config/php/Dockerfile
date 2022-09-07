FROM bitnami/php-fpm

COPY install_postgre_driver.sh /usr/local/bin/init.sh
RUN chmod +x /usr/local/bin/init.sh
RUN /usr/local/bin/init.sh