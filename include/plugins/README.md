amount of plugins for osTicket/simpleticket
=========================

This directory have plugins for osTicket 1.8, 1.9 and some 1.10.
Tested with osticket 1.10+ and 1.9+ with php 5.4 and 5.3.10 respectivelly.

## Installing a plugin

Read each `README.md` file inside each plugin directory, must download independent directories 
of each plugin and place the contents into your `include/plugins` directory.

For **simpleticket, has built-in** with all the requirements, but must enable the attachment_preview plugin.

For the osticket, go to `plugin` directory and clone/download-zip there with own directory name 

One files are there, go to admin panel and in plugins enable it and then configure it.

## To Remove:

Navigate to admin plugins view, click the checkbox and push the "Delete" button.

The plugin will still be available, you have deleted the config only at this point, 
to remove after deleting, remove the related directory inside plugins directory..

# translating:

Please read the [i18n.md](i18n.md) fiel to learn how to locally manual translating.

# Plugin list:

* [attachment_preview](attachment_preview/README.md) autopreview each attachment in the thread view of a ticket
* [tinymce](tinymce/README.md) allow change and provide better compelte editor inline
* [notefirst](notefirst/README.md) permits to use the note tab directly in the thread view of a ticket event the response
* [auth-oauth](auth-oauth/README.md) permits to reuse the Google authentication to osticket
* [auth-passthru](auth-passthru/README.md) permits to reuse the HTTP basic authentication to osticket
* [preventautoscroll](preventautoscroll/README.md) prevents get down the scroll of the ticket thread view
* [spreader](spreader/README.md) allow to distribute the open tickets amont the managers
* [storage-fs](storage-fs/README.md) permits to use the real filesystem event store the attachments in the database




