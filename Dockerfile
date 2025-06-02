FROM ubuntu/apache2

RUN apt-get -y update

RUN apt-get -y install php
RUN apt-get -y install libapache2-mod-php
RUN apt-get -y install git
RUN apt-get -y install php-cgi
RUN apt-get -y install unzip

RUN echo 'extension=php_openssl' >> /etc/php/php.ini
# enable .htaccess
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

WORKDIR /var/www/html

CMD ["sh", "/var/www/html/start.sh"]
