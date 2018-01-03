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

## Download ##

Please download from gitlab or use the mirror github in the remote web server place:
`git clone https://gitlab.com/venenux/simpleticket109 simpleticket`
and a new directory `simpleticket` will be created with the sources.

You can download a single file with all compresed, as tarball, only click here for lasted:
* from gitlab tags marks releases: https://gitlab.com/venenux/simpleticket109/tags
* from github read only mirrored: https://github.com/venenux/simpleticket109/tags
or use the releases page here:
* [https://venenux.github.io/simpleticket109/releases](releases.md)

## Installation ##

Lest assume the following environment:
1. a local install, so all will be **refered into the** `127.0.0.1` **address ip** machine.
2. has access to a terminal program with **console and a root/administrator access/password** to type commands.
3. has access to a **MySQL/MariaDB database with a username** and their respective password.

The easy and simples way its **put all the files in root web server**, by example if root web server are `/var/www/html` 
then put the complete osticket files inside a new directory as `/var/www/html/simpleticket/` then..

A **professional way its to use aliasing**, this means download in a directory away from webroot, 
then make aliasing of the real path directory to the webb root place into the web server.

**For specific installations cases, use our specific documentation for each OS or cases at the end of the page!**

### Download case: XAMP and remote console access ###

We will **assumed that a XAMP installation its for test and no production usage** so 
will use lasted development in this case: in the console, clone it into the web root, 
so by example, if web root (htdocs) are in `/opt/xamp/htdoc`, so then:

`cd /opt/xamp/htdoc;git clone https://gitlab.com/venenux/simpleticket109 websupport`

In that command the osticket "simpleticket109" software will be downloaded into the 
directory `htdoc` of the XAMP software at the `/opt/xamp/` place, but in a specific 
subpath directory named `websuppor` so for the web server the browser call will 
be as: `http://<serverip>/websupport` so if your webserver has ip `192.168.1.10` as example 
the call will be in the web browser as: `http://192.168.1.10/websupport`

### Download case: COMPRESED file and no console accesss ###

If **no direct console/ssh access are allowed with the web server, download a compresed single file** 
firts, using this link https://venenux.github.io/simpleticket109/releases
and then upload decompressed using a ftp client or webfilemanager clien, 
directly in the htdoc directory of the web server, by example `/var/www/html` or 
in some cases if you are using a provider could be `/home/userxyz/public_html/` ...

You can also download lasted development from gitlab directly:
using this link (for lasted development) https://gitlab.com/venenux/simpleticket109/repository/master/archive.tar.gz
or also use the mirror readonly github directly too:
using this link (for lasted clone mirror) https://github.com/venenux/simpleticket109/archive/master.tar.gz

### Pre-setup preparation and file permission###

osTicket installer requires ability to write to the configuration file, `include/ost-config.php` so then 
before start to install, copy by the following command assuming directory path are in `/var/www/html` as:

`cp /var/www/html/simpleticket/include/ost-sampleconfig.php /var/www/html/simpleticket/ost-config.php`

but now must be sure permission are correct, so change owner to the user that runs the software of webserver, 
by example, in mayor linux distros are `www-data` or `httpd` in BSD-like/OsX so the next command wil be:

`chown -R www-data:www-data /var/www/html/simpleticket/`

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

**Config file permission**: Change permission of ost-config.php to remove write access as shown below.

`chmod 0644 include/ost-config.php`

Now with last command, your osTicket installation has been completed successfully. 
Your next step is to fully configure your new support ticket system by the web interface.

# Installation guides - Specific procedures by OS and special cases

* XAMP [wiki-install1-xamp.md](wiki-install1-xamp.md)
* Devuan and lighty [wiki-install2-devuan.md](wiki-install2-devuan.md)
* Debian and apache2 [wiki-install2-devuan.md](wiki-install2-debian.md)
* hiawatta [wiki-install2-hiawatta.md](wiki-install2-hiawatta.md)

## external usefully information.

[1](https://github.com/osTicket/osTicket-1.7/issues/538#issuecomment-285117948)
