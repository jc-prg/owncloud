# jc://cloud/

My configuration to run an up-to-date owncloud on RPI ...

* tested with OC version 10.3.2 (without PECL yet)
* sql dump as backup & restore backup dump
* crontab info for start-up, backup and executing owncloud cron.php (instead of using AJAX)

If you want to use this, please check exactly if it helps for your purpose. No guarantee!

## Setup

* Clone this repository
* Create a working configuration

```bash
$ cd owncloud/config
$ cp sample.config_prod config_prod
$ nano config_prod                   # make your changes here
$ ./create prod
```

* Build and run for the first time

```bash
$ cd ..
$ docker-compose build
$ docker-compose up -d
```

* Login via Web Interface (e.g. http://localhost/) and make your configurations
  * define admin login and password
  * select MariaDB as database (user: root, passwort: <what you've selected>, db: owncloud, server: mysql:3306)
  * install add-ons from Market place (e.g. calendar, gallery, ...)

* additional configurations to be done ...
  * change trusted domains in config/config.php
  * add commands from maintain/crontab.info to your crontab
  * configure proxy including https (e.g. nginx, not part of this configuration)


