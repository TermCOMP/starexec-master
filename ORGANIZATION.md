# Organization

## Deployment
Edit `.profile` to specify the competition to be presented.
Push the repository to a Heroku PHP server. Then it will work.

## Configuring Local Server
1. install a web server
2. enable the PHP plugin
3. enable openssl in PHP by adding the following line in `php.ini`:
```
extension=php_openssl
```
4. make the directory accessible.
`./.profile` will periodically update ranking.

## Finalization
When results are final, please do:
```
./finalize.sh Y20XX
```
Then directory named ``Y20XX`` containing necessary HTML files will be made.
