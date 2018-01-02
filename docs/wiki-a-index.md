* [README/index](README.md)
* [wiki/documentation](wiki-a-index.md)

simpleticket : osTicket 1.9 fork WIKI INDEX
==========================================

https://venenux.github.io/simpleticket109/

## Installation and configuration

* Documentation for install are all in: [wiki-install1.md](wiki-install1.md) 
* Contribution rules are in the [wiki-contributingrules.md](wiki-contributingrules.md) document.
* Some wiki sql querys for reporting tools or specific made: [wiki-db-sqlreports.md](wiki-db-sqlreports.md) 

## Official osTicker original Resources

* [GitHub repo](https://github.com/osTicket/osTicket) - Main repository.
* [Main Website](http://osticket.com) - Main website.
* [Core Plugins](https://github.com/osTicket/osTicket-plugins) - Plugins written by core developers.
* [Forum](http://www.osticket.com/forum/) - Forum hosted by osTicket.
* [FAQ](http://osticket.com/faq) - Technical requirements etc.

## UnOfficial osticker forks active

* **[https://github.com/indefero/osTicketLARUEX](https://github.com/indefero/osTicketLARUEX)** a osticket very 
customized, permits at the site of the users to customize the request of service, extended notifications alerts 
expanded to groups and teams, redone some behaviour and focuses in easy of usage for nebiews. As a 
plus adition, has a extra status "solved" apart of "open" and "closed" derivated status. but use 1.10 version unless.

## Translations/Language-Packs

*Download into `/include/il8n` folder.*

* [Official List](http://osticket.com/download#linguas) - Select "language packs" for latest.
* [Join the efforts](https://crowdin.com/project/osticket-official) - Help us translate osTicket for everyone.

## Plugins

*Install into `/include/plugins` folder.*

### Core Plugins

*Developed by osTicket core developers.*

* [Authentication :: CAS](https://github.com/osTicket/osTicket-plugins/tree/develop/auth-cas) - Allows use of Client Access Server for authentication.
* [Authentication :: LDAP and Active Directory](https://github.com/osTicket/osTicket-plugins/tree/develop/auth-ldap) - Allows use of LDAP server for authentication.
* [Authentication :: Oauth](https://github.com/osTicket/osTicket-plugins/tree/develop/auth-oauth) - Allows use of an oauth service for authentication.
* [Authentication :: HTTP Pass-Through](https://github.com/osTicket/osTicket-plugins/tree/develop/auth-passthru) - Allows the use of webserver/passthrough authentication.
* [Storage :: Attachments in Amazon S3](https://github.com/osTicket/osTicket-plugins/tree/develop/storage-s3) - Allows attachments to be stored in AWS's S3 instead of the database.
* [Storage :: Attachments on the Filesystem](https://github.com/osTicket/osTicket-plugins/tree/develop/storage-fs) - Allows attachments to be stored on the webserver's filesystem instead of the database.

### Simpleticket Plugins

*Modifies how the software works, without changing it.*

* [Attachment Preview](../include/plugins/attachment_preview/README.md): Allows files attached to tickets to be embedded in the thread and auto preview directly.

* [TinyMCE](https://github.com/Micke1101/OSTicket-plugin-TinyMCE) - changes editor with advanced more rich-value editor for both client and agents.
* [Merging](https://github.com/indefero/OSTicket-plugin-Merging) - addeds merging tickets for osticket as plugin.
* [Autotask](https://github.com/indefero/OSTicket-plugin-Autotask) - Automaticly creates a task when a ticket is created
* [Notefirst](https://github.com/indefero/osticket-plugin-notefirst) - Ensures that when you view a ticket, the "Post Internal Note" tab is highlighted event the response tab.
* [Archiver](https://github.com/clonemeagain/osticket-plugin-archiver) - Archives tickets before delete, and allows for auto-pruning of old tickets.
* [Autocloser](https://github.com/clonemeagain/plugin-autocloser) - Automatically closes open tickets.
* [Fetch Note](https://github.com/bkonetzny/osticket-fetch-note) - Automatically fetch additional note content on ticket creation.
* [Field Radio Buttons](https://github.com/Micke1101/OSTicket-plugin-field-radiobuttons) - Enables the use of HTML form element Radio Buttons.
* [Mentioner](https://github.com/clonemeagain/osticket-plugin-mentioner) - Finds Staff mentions in a thread and add's them as collaborators to the ticket.
* [Multi LDAP Auth](https://github.com/philbertphotos/osticket-multildap-auth) - Plugin for multiple LDAP servers authentication and LDAP Sync.
* [Prevent Autoscroll](https://github.com/clonemeagain/osticket-plugin-preventautoscroll) - Stops the agent view from scrolling down to the last message in the thread.
* [Reporting](http://software-mods.com/reports.html) - Paid plugin for extensive reporting.
* [Rewriter](https://github.com/clonemeagain/plugin-fwd-rewriter) - An osTicket plugin to rewrite incoming emails.

### Extra scripts and proyects around

* [https://github.com/techsavyravi/osticketdashboard](https://github.com/techsavyravi/osticketdashboard) perfect and siple great impelmentation of a dashboard easy to manage in php.
* [https://github.com/IFARHU/osticket_dashing](https://github.com/IFARHU/osticket_dashing) project that implement a dashboar in ruby
* [https://github.com/monkiki/osTicket-Addons](https://github.com/monkiki/osTicket-Addons) php script to assing to most free agent in cola. can find here in include/others
* [https://github.com/magisjay/OsTicketProxy](https://github.com/magisjay/OsTicketProxy) php script to redirect Zappier php request to osticket url. can find here original script.
* [https://github.com/SovGVD/osticket-api-class.git](https://github.com/SovGVD/osticket-api-class.git) php class to use own made api, can find here in include/others
* [https://github.com/indefero/osticket-customtabs](https://github.com/indefero/osticket-customtabs) mod to make customized tabs from ui of osticket

### Third Party Integration 

* [Chrome Extension: osTicket Checker](https://chrome.google.com/webstore/detail/osticket-checker/kkcdfipbekoniikpigpklbioladkilig?hl=en) - Checks for new tickets.
* [Jasper Reports](https://github.com/meatballcoder/osticket-jasper-plugin) - A Jasper Reports plugin for osTicket 1.9.
* [Magento Contact Integration](https://github.com/CopeX/magento-osticket-api) - Plugin for Magento to send contact form details to osTicket via the API.
* [Trello](https://github.com/kyleladd/OSTicket-Trello-Plugin) - Integrates Trello with osTicket.
* [Slack](https://github.com/clonemeagain/osticket-slack) - Sends notifications of new and updated tickets to a Slack channel.

## Themes

*Require modifications to osTicket core.*

* [Bootstrap Free Theme](https://github.com/philbertphotos/osticket-bootstrap-theme) - Unofficial bootstrap theme for osticket 1.10.
* [DMT Free Responsive for 1.9.12](http://osticket.com/forum/discussion/86735/dmt-free-responsive-theme-extended-basic-great-pumpkin-stable-1-0-for-osticket-1-9-12/p1) - Looks good. Awaiting upgrade to 1.10.
* [osTicket Themes.com](https://osticketthemes.com/) - Commercial Theme developers.
* [THEMEDOST](http://themedost.com/) - Commercial Themes.

## Guides

* [Wiki](http://osticket.com/wiki/Main_Page) - Has useful getting-started and configuration tips.
* [Search Forums](https://www.google.com.au/search?q=site%3Aosticket.com) - Many questions have already been answered.
* [Youtube Installation Tutorial](https://www.youtube.com/watch?v=mblutpEstZ4) - Step by step demonstration of complete installation for v1.10.

## Provisioning

* [Docker osticket/osticket](https://hub.docker.com/search/?isAutomated=0&isOfficial=0&page=1&pullCount=0&q=osticket&starCount=1) - Docker images.
* [Vagrant](https://github.com/clonemeagain/osticket-vagrant) - Provides a development environment for working with osTicket.

## Development Resources

* [Repo - Signals Docs](https://github.com/osTicket/osTicket/blob/develop/setup/doc/signals.md) - How signals work.
* [Unofficial Plugin Development Guide](https://github.com/poctob/OSTEquipmentPlugin/wiki/Plugin-Development-Introduction) - Provides reverse-engineered instructions on how to develop an osTicket plugin.

## Professional Services

* [Commercial Support](http://osticket.com/commercial-support) - Get the most out of osTicket with tailored plans for your business.
* [Customization](http://osticket.com/customization) - Modify the ticket system to meet your needs.
* [Installation](http://osticket.com/professional-installation) - Implementation, training, migration.
* [Professional Hosting](https://supportsystem.com) - No install necessary.


## @Mentions

* [Linux.com](https://www.linux.com/learn/osticket-help-desk-ticketing-done-right) - osTicket: Help Desk Ticketing Done Right.
* [Test-Driven Conceptual Modelling case-study report](http://upcommons.upc.edu/bitstream/handle/2117/12369/osticket_report11.pdf?sequence=1) - from Universitat Politecnica De Catalulnya (in English).
* [The Next Web - How to Build an Effective Heldesk](https://thenextweb.com/entrepreneur/2011/05/31/how/) - Article.

Shout out to [Enhancesoft](http://enhancesoft.com) the makers of osTicket.


## Mor to do

WIP