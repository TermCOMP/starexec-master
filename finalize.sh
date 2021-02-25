#!/bin/bash

mkdir "$1"
mkdir "$1/fromStarExec"
cp definitions.js master.css "$1"

php-cgi -f index-main.php competition="$1" finalize=1 > "$1/index.html"
mv graph_*.html job_*.html "$1"
mv fromStarExec/* "$1/fromStarExec"
