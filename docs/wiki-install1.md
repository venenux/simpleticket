* [README/index](README.md)
* [wiki/documentation](wiki-a-index.md)

simpleticket : osTicket 1.9 fork WIKI installation guide
==========================================

Thank You for Choosing osTicket fork: simpleticket! this its the installation index guide for 1.9 series

The software have a build-in installer that will guide you every step of the way in the installation process.

## Requirements ##

Any OsX, BSD like or linux distribution older or newer can run this software, this fork does not support guindoser like OSs.

### Hardware requirements ###

* Any computer with enought space depending of your support ticket target
  * as example a low-end laptop but with **good hard-drive are mandatory**
  * space of 1000Mb for a aprox of 30000 tickets without attachments, space will depend of your attachments.

### Software requirements ###

* web server: any web server
  * recommended lighttpd due easy of setup, for ngynx need extra config files see [1]
* php:
  * PHP v5.3 or greater - recomended 5.4.30 as minimun
  * MySQLi extension for PHP module loaded and working
  * PHP IMAP extension - Required for mail fetching but not mandatory
* database:
  * Mysql v5.1 / MariaDB 5.2 minimun
* Optionally in order of relevancy:
  * Gdlib extension
  * PHP XML extension - recommended for XML API procesing and integrations.
  * PHP XML-DOM extension - recommended for HTML email processing.
  * Mbstring extension - recommended for all installations
  * PHP JSON extension (faster performance ?¡?) not necesary.
  * Phar extension - recommended for plugins and language packs from official osticket, not mandatory.

## PRocedure install ##

Lest assume the following environment:
1. a local install, so all will be **refered into the** `127.0.0.1` **address ip** machine.
2. has access to a terminal program with **console and a root/administrator access/password** to type commands.
3. has access to a **MySQL/MariaDB database with a username** and their respective password.

The easy and simples way its **put all the files in root web server**, by example if root web server are `/var/www/html` 
then put the complete osticket files inside a new directory as `/var/www/html/simpleticket/` then..

osTicket installer requires ability to write to the configuration file, `include/ost-config.php` so then 
before start to install, copy by the following command assuming the previous environment described in first paragraph:

`cp /var/www/html/simpleticket/include/ost-sampleconfig.php /var/www/html/simpleticket/ost-config.php`

but now must be sure permission are correct, so change owner to the user that runs the software of webserver, 
by example, in mayor linux distros are `www-data` or `httpd` in BSD-like/OsX so the next command wil be:

`chown -R www-data:www-data /var/www/html/simpleticket/`

**once done, open a browser and call `http://127.0.0.1/simpleticket`** the setup program will redirect 
to proper screen to install.

**Pre-setup installation data**: osTicket's installation script will attempt to auto-detect paths and any permission issues. 

* If the script spots any configuration errors then it will not allow you to continue until the errors are corrected.
* If everything checks out, **you will be presented with a form to fill in the required information**.

Please **fill** the user admin login, names, info, **database user, name and address, and very important, emails of admin and system.**

* Fill database username and password, also the database name
* Email user admin and email for send or system mail must be different, Email will work only with php-mail module enabled.
* If any errors occurs, go back and check the data entered.
* On valid data the script will create and populate the database plus write a configuration file.

Note that the installer performs basic configuration required to get osTicket up and running. 
Further configuration is required, post-install, to make the system fully functional. 

**Config file permission**: Change permission of ost-config.php to remove write access as shown below.

`chmod 0644 include/ost-config.php`

Now with last command, your osTicket installation has been completed successfully. 
Your next step is to fully configure your new support ticket system by the web interface.

## Specific procedures by OS

* Devuan [wiki-install2-devuan.md](wiki-install2-devuan.md)
* hiawatta [wiki-install2-hiawatta.md](wiki-install2-hiawatta.md)

## external usefully information.

[1](https://github.com/osTicket/osTicket-1.7/issues/538#issuecomment-285117948)
