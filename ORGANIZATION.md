# Organization

## Preparing for New Competition

1. Create a new directory, e.g., `Y20XX`.

2. Create `Y20XX/info.php` by copying last year's one.

3. Set all
   ```
   id => xxxxx
   ```
   fields (holding job ids) into
   ```
   id => null
   ```

4. Comment out participants informations.

## Configuring Server

The following are automatic if you use Heroku with heroku-php-apache2 web server.

1. Make sure that apache2 and PHP are installed.

2. Make sure the PHP plugin in apache2 is enabled.

3. Make sure the openssl extension in PHP is enabled, i.e., the following line is in your `php.ini`:
   ```
   extension=php_openssl
   ```
4. Make the `starexec-master` directory accessible from the web server.

5. Run
   ```
   ./.profile
   ```
and keep it running until competition is finished. This will fetch past data and periodically update the present status from StarExec.

## Job Creation

1. Open browser and log in to StarExec.

2. In the same browser, open `http://url-to-starexec-master/createjob.php?competition=Y20XX`.

3. Follow the interface. Keep in mind that StarExec might automatically log you off.

4. When job is created, update the corresponding job ids in `Y20XX/info.php`.

## Finalization
When results are final, you can stop the process running `./.profile`.
Backup the `Y20XX` directory into [the termCOMP repository](https://github.com/TermCOMP/TermCOMP.github.io).

