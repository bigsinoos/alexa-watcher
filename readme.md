### Alexa Watcher

Alexa watcher is a laravel written script that allows you to watch changes for an specific site.
The watcher is run every 60 minutes by laravel ```Schedule``` system so you should only add the global cron of laravel to your machine.
Currently change notifications are pushed by emails but you can implement any driver you wany.

### Config

 - Clone the repo
 - Run ```composer update```
 - Replace your desired emails and sites to ```config/alexa.php``` to make them able to watch
 - Add Laravel's global cron for scheduling jobs
 - Or you can run ```php artisan alexa:watch``` to check manually.

