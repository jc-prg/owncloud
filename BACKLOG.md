# jc://cloud/backlog

* add sendmail to OC Dockerfile
* change background image on login-page (owncloud theme) based on config_file
* maintenance script to ...
  ... enable theme jc-cloud-theme (php occ app:enable "$app_name")
  ... switch on/off maintenance mode
  ... trigger a rescan (e.g. if copied files to the oc_data_dir manually)
  
* remove info/index.php from the oc image (as it causes an integrity check:error)
