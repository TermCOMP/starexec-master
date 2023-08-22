# Organization

## Preliminary Work

1. Fix dates.
2. Create the information web page.
3. Ask Aaron Stump to reserve the termcomp queue in StarExec.

## Opening Resigstration

1. Create a new directory, e.g., `Y20XX`.
2. Create `Y20XX/info.php` by copying last year's one.
3. Update the preamble.
4. Set all
   ```
   id => xxxxx
   ```
   fields (holding job ids) into
   ```
   id => null
   ```
5. Comment out participants informations.
6. Make announcement.

## Configuring Server

The following are automatic if you use Heroku with heroku-php-apache2 web server.

1. Make sure that apache2 and PHP are installed.
2. Make sure the PHP plugin in apache2 is enabled.
3. Make sure the openssl extension in PHP is enabled, i.e., the following line is in your `php.ini`:
   ```
   extension=php_openssl
   ```
4. Make the `starexec-master` directory accessible from the web server.
5. Update `.profile` and keep it running until competition is finished. This will periodically update the present status from StarExec.
6. It will be nicer to automatically synchronize with the starexec-master repository.

## Creating StarExec Jobs

1. If needed, upload postprocessors in StarExec, especially [the CeTA postprocessor](https://github.com/TermCOMP/CeTApostproc).
2. If needed, upload benchmarks, and make them public.
3. Update `createjob.php` with appropriate ids.
4. Open browser and log in to StarExec.
5. In the same browser, open `http://url-to-starexec-master/createjob.php?competition=Y20XX`.
6. Follow the interface. Keep in mind that StarExec might automatically log you off.
7. When a job is created, update the corresponding job ids in `Y20XX/info.php`.
8. Go to `http://url-to-starexec-master/Y20XX` and check jobs are created.
9. Start all jobs, by going to starexec job pages. Start bigger jobs first, to make it run parallel.

## Finalization
When results are final, you can stop the process running `./.profile`. Backup the `Y20XX` directory into [the termCOMP repository](https://github.com/TermCOMP/TermCOMP.github.io).

