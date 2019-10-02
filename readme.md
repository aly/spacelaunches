Installation 
* Clone repo
* Run `composer install`
* Setup apache site to point to root folder
* Add entry to hosts file:
    127.0.0.1 spacelaunches.local
* Visit spacelaunches.local/index.php


Example apache conf file:
<VirtualHost *:80>

ServerAdmin webmaster@localhost
DocumentRoot /home/user/spacelaunches/htdocs

    ServerName spacelaunches.local

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined

    <Directory />
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

