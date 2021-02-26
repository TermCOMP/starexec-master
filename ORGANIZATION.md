# Organization

## Deployment
Edit `.profile` to specify the competition to be presented.
Push the repository to a Heroku PHP server. Then it will work.

To run locally, install a web server, enable PHP plugin and make the directory accessible.
`./.profile` will periodically update ranking.

## Finalization
When results are final, please do:
```
./finalize.sh Y20XX
```
Then directory named ``Y20XX`` containing necessary HTML files will be made.
