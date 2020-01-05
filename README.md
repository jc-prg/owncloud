# jc://cloud/

My configuration to run an up-to-date owncloud on RPI ...

* tested with OC version 10.3.2 (without PECL yet)
* sql dump as backup
* restore backup dump
* crontab info for start-up, backup and executing owncloud cron.php (instead of using AJAX)
* experimental modification of index.php and remote.php (should be removed from docker-compose.yml template, if not required)

If you want to use this, please check exactly if it helps for your purpose. No guarantee!
