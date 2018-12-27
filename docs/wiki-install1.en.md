 --**** [README/index](docs/README.md) --***-- [wiki/documentation](docs/wiki-a-index.md) ****--

osticket/simpleticket install 1.9 series
========================================

Thank You for Choosing osTicket fork: simpleticket! this its the installation index guide.

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
  * PHP v5.3 or greater - recomended 5.4.30 as minimun (*)
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

**NOTE** (*) the 1.9 series are no php 7.2 ready, and the 1.10 release need php 5.4 as minimun.

## Download ##

Please use the releasse page for download at [releases.en.md](releases.en.md)

You can download a single file with all compresed, as tarball, only click here for lasted:
* from gitlab tags marks releases: https://gitlab.com/venenux/simpleticket109/tags
* from github read only mirrored: https://github.com/venenux/simpleticket109/tags

## Installation ##

Lest assume the following environment:
1. A local install, so all will be **refered into the** `127.0.0.1` **address ip** machine.
2. Has access to a terminal program with **console and a root/administrator access/password** to type commands.
3. Has access to a **MySQL/MariaDB database with a username** and their respective password.

The easy and **simples way its put all the files in root web** server, by example if root web server are `/var/www/html` 
then put the complete osticket files inside a new directory **as `/var/www/html/simpleticket/`** then..

A **professional way its to use aliasing**, this means download in a directory away from webroot, 
then make aliasing of the real path directory to the webb root place into the web server.

### Pre-setup preparation and file permission###

osTicket installer requires ability to write to the configuration file, `include/ost-config.php` so then 
before start to install, **get sure you copy the ost-sampleconfig.php file to ost-config.php inside include** directory.

**once done, open a browser and call `http://127.0.0.1/simpleticket`** the setup program will redirect 
to proper screen to install.

### Procedure setup screen ###

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

Your next step is to configure and usage of the system please read [wiki-configure-index.md](wiki-configure-index.md)
to configure and parametrize your installation and then finally read [wiki-usage-index.md](wiki-usage-index.md).

# See also:

1. [wiki-install-index.md](wiki-install-index.md)
2. [wiki-configure-index.md](wiki-configure-index.md)
3. [wiki-usage-index.md](wiki-usage-index.md)

## Specialized install guides

* Debian or Devuan, 1.9 release professional with lighty: [wiki-install2-109.en.md](wiki-install2-109.en.md)
* Debian or Devuan, 1.10 release professional with lighty: [wiki-install2-109.en.md](wiki-install2-110.en.md)
* Debian, 1.9 release for novices with apache2 [wiki-install2-109-debian-apache.md](wiki-install2-109-debian-apache.md)
* Debian, 1.10 release for novices with apache2 [wiki-install2-110-debian-apache.md](wiki-install2-110-debian-apache.md)
* Alpine using 1.10 release with hiawatta [wiki-install2-alpine-hiawatta.md](wiki-install2-hiawatta.md)

## external usefully information.

[1](https://github.com/osTicket/osTicket-1.7/issues/538#issuecomment-285117948)

