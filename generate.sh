#!/bin/bash

competition=$1
shift

php-cgi -f index-main.php competition=$competition root=.. $* > $competition/tmp
cp $competition/tmp $competition/index.html
