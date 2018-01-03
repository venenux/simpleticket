* [README/index](README.md)
* [wiki/documentation](wiki-a-index.md)

simpleticket : osTicket 1.9 fork WIKI TRANSLATIONS
==========================================

## Note to Translators ##

It is our hope that osTicket can and will be translated to the native
language of every osTicket administrator. If you are considering helping in
the translation effort, thank you.

Please use the project Github page to share your work and cooperate with
other translators and translations by the rules of [wiki-contributingrules.md](wiki-contributingrules.md) document.

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
so can visit translation page at https://crowdin.com/project/osticket-official and copy the 
template or a based file to work inside simpleticket.

**NEW TRANSLATION**: 
Use/copy the en_US directory as based template and conver all entries to 
the new languaje most of entries are yaml fies and the value after ":" are 
the text to translate.. some cases do not apply, when translating please make tests!

then take the manifiest.php file and change to proper the directory.

each translations are inside a unique directory xx_YY by example es_VE for Venezuelan spanish.

### System Languages ###
--------------------------

At various parts of the system, there are several possibilities for the
language selection of the "local" language:

  1. User (client or agent) preference
  2. Ticket thread (for system activity notes)
  3. System (for logs and administrative messages)

The system is flexible enough to support these different cases and provides
a few wrapper functions to connect your string to the appropriate language.
Bear in mind when writing new code that strings may need to be translated
into more than one language. For instance, if a string is to be displayed as
an error in a web page as well as appear in an email to the administrator,
it may need to be translated differently for both.

Consider a Spanish-speaking user visiting a German-based help desk. After
attempting to log in several times, they receive an error banner with a
particular message. A message is also sent to the site administrator warning
about possible brute force attack. These messages will need to consider
different audiences when being localized. The site administrator should
receive a warning email in German; whereas the user should see a Spanish
error message with details about what to do next.

### Creating localized strings ###
--------------------------

Creating localized strings in osTicket is similar to creating localized
strings in any gettext-based project. osTicket has opted to use a pure-php
version of gettext in order to avoid possible pitfalls surrounding usage of
gettext with PHP including

  * MO file caching requiring HTTP server restart
  * `gettext` missing from the PHP installation
  * Requirement of locale pre-configuration on the server

#### Adding new strings

Use a few function calls to get your text localized:

  * `__('string')` localize the string to the current user preference
  * `_N('string', 'strings', n)` localize a string with plural alternatives
    to the current user locale preference.
  * `_S('string')` localize the string to the system primary language
  * `_NS('string', 'strings', n)` localize a string with plural alternatives
    to the system primary language.
  * `_L('string', locale)` localize a string to a named locale. This is
    useful in a ticket thread, for instance, which may have a language
    preference separate from both the user and the system primary language
  * `_NL('string', 'strings', n, locale)` localize a string with plural
    alternatives to a specific locale.
  * `_P('context', 'string')` localize a string which may have the same
    source text as another string but have a different context or usage. An
    example would be `open` used as a noun, adjective, and verb.
  * `_NP('context', 'string', 'strings', n)` localize a string with plural
    alternatives which may have different contexts in the source language.

In some cases, it is not possible to use a function to translate your
string. For instance, if it is used a as a class constant or default value
for a class variable. In such a case, a hint can be used to tell the POT
scanner to translate the string for use elsewhere. As an example, one might
set something like this up:

```php
    class A {
        static $name = /* @trans */ 'Localized string';
    }

    print __(A::$name);
```

In this case the localized version of the class variable is translated when
it is used — not when it is defined.

The `* @trans *` text in comment is significant. Both the asterisks and the
term `@trans` are used to signify that the phrase should be made
translatable. The comment must also be placed immedately before or after the
string without any other PHP symbols in between (like the semi-colon).

#### Adding context to your strings

Your text may be ambiguous or unclear when it is viewed outside the context
of the code in which it appears. The system allows adding of comments
similar to the stock gettext tools. Any comments written directly beside
(behind or in front of) a localized string will be captured with the string
in the translation template. For instance

```php
    print __('Localized' /* These comments are exported */);
```

All types of PHP comments are supported. They must be placed inside the
parentheses of the localization call. If using single-line comments, use
multiple lines if necessary to define the call so that your single-line
comments can be used. For instance:

```php
    print sprintf(__(
        // Tokens will be <a> of <b> <object(s)>
        '%1$d of %2$d %3$s'
        ),
        $a, $b,
        _N('object', 'objects', $b)
    );
```

### Building POT file for translations

Use the command line to compile the POT file to standard out

    php setup/cli/manage.php i18n make-pot > message.pot

### Building language packs

In an effort for the php version of gettext to offer similar performance to
the extension counterpart, a variant of the MO file is used which is a PHP
serialized array written to a file. The original MO file functions basically
like a text array. In stead of searching through the MO file for each string
to be translated, the original and translated texts are placed into a hash
array for quick access and the hash array is serialized for the language
pack. At runtime, the hash array is recreated from the export and the
strings are quickly accessed from the PHP hash array.

A MO file can be manually compiled using a command-line interface

    php include/class.translation.php message.mo > message.mo.php

## commiting and merge the translation ##
---------------------------

Once finished, follow same contribution guideline as normal code, assumed
you make/have a fork of the project, commit to your fork/local your new file translated 
and then upload to your repository fork.

Once upload to your repository fork, make a pull request to the simpleticket repository, 
please make good description and explanation, and let editable the pull.

