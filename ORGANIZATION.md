# Organization

## Deployment
Push the repository to a Heroku PHP server. Then it will work.

To run locally, install a web server, enable PHP plugin and make the directory accessible.
`./.profile` will periodically update ranking.

## Starting Jobs
`createjob.php` will contain buttons for invoking categories.
Take note of job IDs, go to ``Y20XX.info`` and update `'jobid' => xxx` lines.

## Finalization
When results are final, please do:
```
./finalize.sh dir
```
Then directory named ``dir`` containing necessary HTML files will be made.
