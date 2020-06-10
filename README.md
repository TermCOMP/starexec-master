This is a light-weight StarExec presenter using PHP.

# Install
Install a web server, enable PHP plugin, and make index.php accessible from the web.

# Finalization
When results are final, please do:
```
cd caches
for f in *.php; do php $f > ${f%.php}.html; done
cd ..
php index.php > index.html
```
and remove php files for safety.
