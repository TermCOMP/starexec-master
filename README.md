This is a light-weight StarExec presenter using PHP.
#Install
Install a web server, enable PHP plugin, make index.php accessible, and please do:
    chmod a+w caches fromStarExec

#Finalization
When results are final, please do:
    cd caches
    for f in *.php; do php $f > ${f%.php}.html; done
    cd ..
    php index.php > index.html
and remove php files for safety.

