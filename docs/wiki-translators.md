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
so can visit translation page at http://i18n.crowdin.com/ and copy the 
template or a based file to work inside simpleticket.

**NEW TRANSLATION**: 
Use/copy the en_US directory as based template and conver all entries to 
the new languaje most of entries are yaml fies and the value after ":" are 
the text to translate.. some cases do not apply, when translating please make tests!

then take the manifiest.php file and change to proper the directory.

each translations are inside a unique directory xx_YY by example es_VE for Venezuelan spanish.

## commiting and merge the translation ##
---------------------------

Once finished, follow same contribution guideline as normal code, assumed
you make/have a fork of the project, commit to your fork/local your new file translated 
and then upload to your repository fork.

Once upload to your repository fork, make a pull request to the simpleticket repository, 
please make good description and explanation, and let editable the pull.

