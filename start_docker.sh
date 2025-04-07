#!/bin/bash
sudo docker run -v .:/var/www/html -d -p 2222:80 --name=termcomp --rm -t termcomp
