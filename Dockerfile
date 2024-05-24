FROM ubuntu/apache2

RUN apt -y update

RUN apt -y install php
RUN apt -y install libapache2-mod-php
RUN apt -y install git
RUN apt -y install php-cgi

RUN echo 'extension=php_openssl' >> /etc/php/php.ini

WORKDIR /var/www/html/
RUN git clone https://github.com/TermCOMP/starexec-master.git

