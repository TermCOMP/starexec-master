#!/bin/bash

competition=$1
shift

php-cgi -f index-main.php competition=$competition root='..' $* > tmp
cp tmp $competition/index.html
