* [README/index](README.md)
* [wiki/documentation](wiki-a-index.md)

simpleticket : osTicket 1.9 fork WIKI installation guide
==========================================

Thank You for Choosing osTicket fork: simpleticket! this its the installation index guide for 1.9 series

The software have a build-in installer that will guide you every step of the way in the installation process.

## PRE-install and requirements ##

Any Devuan release and normal osticket requirements as your read in the [wiki-install1.md](wiki-install1.md) document.

### prepare software pre-requisites ###

We will use the Lighttpd and MySQL equivalent MariaDB software as http server and database engine, 
also we will need the mysql module and apart of PHP, the json, imap and GDlib extensions:

`apt-get install lighttpd mariadb-server php5 php5-cgi php5-mysql php5-gd php5-json php5-imap`

After run that command the mysql/mariadb will ask for a root administration password, please do not forgot!

### configuring lighttpd web server ###

We need enable the web server modules for php working environment, runs in a console as root:

`lighty-enable-mod  accesslog cgi dir-listing fastcgi fastcgi-php status`

In the extra section (at the end) we will optimize the webserver and php setting depending on some usage.

### configuring mariadb/mysql database ###

We need enable the database access for a osticket user and scheme environment so connect to te database engine:

`mysql -u root -h localhost -p`

**By default Devuan/Debian do not allow remote access to database, only localhost**

Now we create and perform access to the installation and usage of system software, so in the connection runs:

`CREATE USER 'osticket'@'localhost' IDENTIFIED BY '***';`

`GRANT USAGE ON *.* TO 'osticket'@'localhost' IDENTIFIED BY '***' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;`

Create the database and performs usage and privilegies on:

`CREATE DATABASE IF NOT EXISTS osticketdb ;GRANT ALL PRIVILEGES ON osticket . * TO 'osticket'@'localhost';`

### downloading and path install ###

The **default htdoc web root** directory will be at `/var/www/html` but as professional install we 
not put directly the files here, avoid provide easy cracking for alienate users, due our osticket 
are good patched we will use the aliasing technique. Runs in a console as root:

`cd /opt/; wget https://gitlab.com/venenux/simpleticket109/repository/master/archive.tar.bz2`

and then uncompress and rename to proper isntall:

`tar -xvvzf osticket.tar.gz;mv simpleticket* osticket`

Also if prefer lasted can directly download all files extracted from git as:

`cd /opt/; git clone https://gitlab.com/venenux/simpleticket109.git osticket`

### performing permission web root and ost-config file ###

Now files must be prepared the ost-config and file permission:

`cp /opt/osticket/include/ost-sampleconfig.php /opt/osticket/include/ost-config.php`

`chown -R www-data:www-data /opt/osticket/`

### lighttpd web aliasing ###

Remenber that we perform a professional install, so we configure an alias in `/opt/osticket` so
runs as root the following command to perfomr the required configuration alias in web server:

```
cat <<EOF > /opt/osticket/99-osticket.conf

alias.url += ( "/osticket/" => "/opt/osticket/" ),

$HTTP["url"] =~ "^/osticket($|/)" {
    dir-listing.activate = "disable"
    }

EOF
```
then we must protect the file from alienate visitors:

`chmod 640 /opt/osticket/99-osticket.conf`

Now at this point we can call the setup install process in the web browser.

## Setup install process ##

Now open your browser and input the server ip address and subpath `osticket` by example:

http://127.0.0.1/osticket

and the software will redirect to the setup process to finish the installation:
* If the setup script spots any configuration errors then it will not allow you to continue until the errors are corrected.
* If everything checks out, **you will be presented with a form to fill in the required information**.

### screen 1 : checks ###

Here all the checks must be provided as marcked, but for something there the commands that must run as root to solve:

* IMAP: with `apt-get install php5-imap`
* Gdlib extension: `apt-get install php5-gd`
* PHP XML extension: `apt-get install php5-common php5-cgi`
* PHP XML-DOM extension: `apt-get install php5-common php5-cgi`
* Mbstring extension: `apt-get install php5-mcrypt`
* PHP JSON extension: `apt-get install php5-common php5-json`
* Phar extension: `apt-get install php5-common php5-cgi`

The package `php5-common` refers and means that the module/extension are provided as built-in.

### screen 2 : checks ###

**System setting section**

Here **the firts section** need a name for the heldesk site, and the system main email, if do not have 
an email system, dont worry, can give a false email but must be valid type.

**Admin user section**

The most important fields here are admin username and admin password, rest of fields are for misc information.
All the fileds are mandatory. Do not forgoet the admin username and admin passowrd, will be used for accesss.

**Database settings section**

Please **fill** the database user, name and address, already defined in the preconfigurated steps, 

* Fill database username and password, we previously configured as "osticket" the username
* The database name must be entered, we previously configured as "osticketdb" the sheme
* The prefix must be remain same, due as we previously configured as "ost" the prefix
* 

Note that the installer performs basic configuration required to get osTicket up and running. 
Further configuration is required, post-install, to make the system fully functional. 

**Config file permission**:

Now at isntall change permission of ost-config.php to remove write access as root runs:

`chmod 0640 /opt/osticket/include/ost-config.php`

also the setup install directory must be denied from outside with this command as root:

`chmod 0600 /opt/osticket/setup`

Now with last command, your osTicket installation has been completed successfully. 

Your next step is to fully configure your new support ticket system by the web interface.
for that please read the [wiki-userman-1-setup.md](wiki-userman-1-setup.md)



