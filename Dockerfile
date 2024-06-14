FROM ubuntu/apache2

RUN apt-get -y update

RUN apt-get -y install php
RUN apt-get -y install libapache2-mod-php
RUN apt-get -y install git
RUN apt-get -y install php-cgi
RUN apt-get -y install unzip

RUN echo 'extension=php_openssl' >> /etc/php/php.ini

RUN rm -rf /var/www/html
WORKDIR /var/www
RUN git clone https://github.com/TermCOMP/starexec-master.git html
WORKDIR /var/www/html
RUN chown -R www-data /var/www/html

CMD ["sh", "/var/www/html/start.sh"]
