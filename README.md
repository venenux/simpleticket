* [README/index](docs/README.md)
* [wiki/documentation](docs/wiki-a-index.md)

simpleticket : osTicket 1.9 fork
================================

<a href="https://venenux.github.io/simpleticket109/"><img src="docs/media/simpleticketlogo.gif"
align="left" hspace="10" vspace="6"></a>

Fork from **osTicket** 1.9 version series, widely-used open source support 
ticket system; integrates inquiries created via email, phone or web-based 
simple easy-to-use multi-user interface.

It's main target: Manage support requests and responses in organized place 
archiving while providing customers with accountability and responsiveness they deserve.

Features and improvements:
----------------------

The simpleticket osTicket's fork core features not only rival, but also exceed most high-priced help desk solutions 
due all the rejected contribution that the dictators of osticket dont merged in 1.9 series 
but also including the improvement of some people hard work... 

* Creating tickets as easy as send emails!
* Customer Portal, customizable rich text forms.
* User can login using email and ticket ID only, if not can be autoregistered!
* Optionally, No user account or registration required to submit a ticket!
* Configurable automatic reply sent out when a new ticket is opened or a message is received.
* Rich text or HTML email/forms, also in staff replies and internal notes posted to the ticket thread
* Custom data collected using filters for email/incoming tickets or by custom inputs in forms.
* Configurable help topics and template answers for all tickets also for customers/clients access.
* Route inquiries without exposing internal departments or priorities.
* Agent Collision Avoidance with Ticket locking mechanism to allow staff avoid conflicting.
* Auto-Assign or/and Transfer beetween departaments or teams for tickets.

Differences from original:

* Attachments are opened in new pop-up window, no more angry!
* Auto ticket cross-references using #XXXX in staff panel if click will be redirect if ticket number exists.
* Collaborators from internal creating new ticket without reply!
* Works with old browsers and runs in olders systems! no limits!
* Responsive theming, improved interface (WIP).
* Allow non-email accounts for logins specially used on intranet's.
* Mantain noifications independently of To email users
* .. many **more details of differences** in the [docs/wiki-diferences-from-original.md](docs/wiki-diferences-from-original.md)

More information:
----------------

We all forked the stupid poor wiki to more improved: [docs/wiki-aindex.md](docs/wiki-a-index.md) 

Original osTicket forum can be point of help in old info: [http://osticket.com/forums/](http://osticket.com/forums/).

### Requirements ###
------------

Documentation **for download and install are all in**: [docs/wiki-install1.md](docs/wiki-install1.md) 
the process it's so easy as easy to use like send a email to the system.

  * HTTPD: prefered lighttpd or hiawatta
  * PHP: version 5.3 or greater with mysqli extension for PHP
  * DB: MySQL database only, version 5.0 or greater
  * OPTIONAL: gd, gettext, imap, json, mbstring, and xml extensions for PHP
  * OPTIONAL: APC module enabled and configured for PHP

Contributing
------------

All the work are made in gitlab repository: https://gitlab.com/venenux/simpleticket109 
In quick resumen, create your own fork of the project/repository and use
[gitlab-flow](https://docs.gitlab.com/ee/workflow/gitlab_flow.html#introduction-to-gitlab-flow) 
to create a new feature or added code changes. Once the feature/change is published/commited in your fork, 
send a pull request to begin the conversation of integrating your new feature into.

Rules for that pulls/merge requests:
* must be php 5.3 compatible and mysql 5.2 compatible
* must be linux realted and bsd working instalations
* must provide explanations and documentations
* code must be well idented, if not pull/merge must be editable
* all must be in gitlab, github its a privative piece of shit only mirror!

PLEASE READ Contribution rules in the [docs/wiki-contributingrules.md](docs/wiki-contributingrules.md) document.

License
-------
simpleticket109 are released under GPL2 license too, diue as original, 
osTicket is released under the GPL2 license. See the included [LICENSE.txt](LICENSE.txt)
file for the gory details of the General Public License.

osTicket is supported by several magical open source projects including:

  * [Font-Awesome](http://fortawesome.github.com/Font-Awesome/)
  * [HTMLawed](http://www.bioinformatics.org/phplabware/internal_utilities/htmLawed)
  * [jQuery dropdown](http://labs.abeautifulsite.net/jquery-dropdown/)
  * [mPDF](http://www.mpdf1.com/)
  * [PasswordHash](http://www.openwall.com/phpass/)
  * [PEAR](http://pear.php.net/package/PEAR)
  * [PEAR/Auth_SASL](http://pear.php.net/package/Auth_SASL)
  * [PEAR/Mail](http://pear.php.net/package/mail)
  * [PEAR/Net_SMTP](http://pear.php.net/package/Net_SMTP)
  * [PEAR/Net_Socket](http://pear.php.net/package/Net_Socket)
  * [PEAR/Serivces_JSON](http://pear.php.net/package/Services_JSON)
  * [php-gettext](https://launchpad.net/php-gettext/)
  * [phpseclib](http://phpseclib.sourceforge.net/)
  * [Spyc](http://github.com/mustangostang/spyc)

