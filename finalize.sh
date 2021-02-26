#!/bin/bash

comp=$1
shift

mkdir "$comp"
mkdir "$comp/fromStarExec"
cp definitions.js master.css "$comp"

php-cgi -f index-main.php competition="$comp" finalize=1 $* > "$comp/index.html"
mv graph_*.html job_*.html Job*.json "$comp"
mv fromStarExec/* "$comp/fromStarExec"
