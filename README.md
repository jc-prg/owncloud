# jc://cloud/

My configuration to run an up-to-date owncloud on RPI ...

* tested with OC version 10.3.2 (without PECL yet)
* sql dump as backup & restore backup dump
* crontab info for start-up, backup and executing owncloud cron.php (instead of using AJAX)

If you want to use this, please check exactly if it helps for your purpose. No guarantee!

## Thanks to the authors of ...

This configuration is based on:

* Docker Image for MariaDB used from: [blepiolot/rpi-mariadb](https://ssi.le-piolot.fr/running-owncloud-w-ssl-in-a-raspberry-pi-docker-container/)
* Docker Image for owncloud based on: https://github.com/docker-library/owncloud
* Image rotation for login screen: http://www.marcofolio.net/

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
  
* add domains to trusted domains in config/config.php if necessary (during first login only 1 domain is added)
```php  
  'tusted_domains' => [
      '192.168.1.10',
      'example.com',
  ],
```

* add jc-cloud-theme if wanted
  * go to app settings when logged in as admin
  * go to deactivated apps and activate "jc-cloud-theme"
  * deactive integrity check in oc-data/html/config/config.php (as it's a private theme)

```php  
  'integrity.ignore.missing.app.signature' => [
      'jc-cloud-theme',
  ],
```
  
* configure **proxy** including https (e.g. nginx, not part of this configuration)
  * ensure that upload of big files work: ```client_max_body_size 513m;```
  * set Strict-Transport-Security: ```add_header Strict-Transport-Security max-age=15552000;```


* additional configurations to be done ...
  * add commands from maintain/crontab.info to your crontab


