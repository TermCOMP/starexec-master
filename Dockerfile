FROM ubuntu/apache2

RUN apt-get -y update

RUN apt-get -y install php
RUN apt-get -y install libapache2-mod-php
RUN apt-get -y install git
RUN apt-get -y install php-cgi

RUN echo 'extension=php_openssl' >> /etc/php/php.ini

WORKDIR /var/www/html/
RUN rm -rf /var/www/html
COPY . .
