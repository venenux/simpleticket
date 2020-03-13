simpleticket : osTicket 1.9 fork TRANSLATIONS
==========================================

## Note to Translators ##

It is our hope that osTicket can and will be translated to the native
language of every osTicket administrator. If you are considering helping in
the translation effort, thank you.

Please use the project Github page to share your work and cooperate with
other translators and translations by the rules of [../docs/wiki-contributingrules.md](../docs/wiki-contributingrules.md) document.

### How to translate ###

Please note that translation is not the practice of turning words from one
language to another. It is the process of capturing and presenting the
spirit of a text into another language. Please take the time to understand
the context of the texts, phrases, and documents before describing them in
your target language.

### What not to translate ###

Comments are meant to serve as a consistent hint to the context of the text.

## Starting and work with translation ##
--------------------------

**UPDATE TRANSLATION**: 
Original osticket used Crowdin to manage translations, but not simpleticket, 
so can visit translation page at https://crowdin.com/project/osticket-official 
and copy the template or a based file to work inside simpleticket.

**NEW TRANSLATION**: 
Use/copy the en_US directory as based template and conver all entries to 
the new languaje most of entries are yaml fies and the value after ":" are 
the text to translate.. some cases do not apply, when translating please make tests!

then take the manifiest.php file and change to proper the directory.

each translations are inside a unique directory xx_YY by example es_VE for Venezuelan spanish.

the jrun following commands:

* `msgfmt -f messages.po -o messages.mo`
* `php include/class.translation.php include/i18n/es_ES/LC_MESSAGES/messages.mo > include/i18n/es_ES/LC_MESSAGES/messages.mo.php`
* reload php fpm and web server to take effect

to generate a po file use pre pot as `php setup/cli/manage.php i18n make-pot > include/i18n/es_ES/LC_MESSAGES/message.po`

