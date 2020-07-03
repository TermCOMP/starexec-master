cp index-wait.html index.html
(while [ 1 ]; do php index-main.php finalize > index.html; sleep 5; done) &