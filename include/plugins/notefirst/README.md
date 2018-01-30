# osticket-plugin: notefirst

[simpleticket/osticket 1.9 seires](https://gitlab.com/venenux/simpleticket109) plugin 
for that when you view a ticket, the "Post Internal Note" tab is highlighted and swicht to if possible.

Currently works with 1.9 and 1.10 api see in: https://github.com/clonemeagain/osticket-plugin-notefirst

Tested with osticket 1.10+ and 1.9+ with php 5.4 and 5.3.10 respectivelly.

## To install

For **simpleticket, has built-in** with all the requirements, but must enable the attachment_preview plugin.

For the osticket, go to `plugin` directory and clone/download-zip there with own directory named `notefirst`:
also install https://github.com/clonemeagain/attachment_preview as this relies on it.

One files are there, go to admin panel and in plugins enable it and then configure it.

## To Remove:

Navigate to admin plugins view, click the checkbox and push the "Delete" button.

The plugin will still be available, you have deleted the config only at this point, 
to remove after deleting, remove the `notefirts` related directory inside plugins directory..

# How its work:

Essentially it's simple, when enabled, and a ticket page is viewed, on osTicket BootStrap which 
waits for the page to be finished rendering by osTicket.
* When that's done, we fetch the output buffer of the rendering override boostrap
* and convert the HTML structure into a DOMDocument, by the preview plugin reuse class.
* The plugin then runs through the link elements of the Document, to find the div of the note id.
* It then using inline javascript made a selft click in the note tag to swich to.

This its a simpel core modification that can be made much simpler:

* Edit include/class.osticket.php
* Go right to the bottom to the "start" function, add at the beggining: ```global $ost;```
* Effectively, apply https://github.com/osTicket/osTicket/pull/2907 
* Now we don't need the attachments_preview api! :-)
* Now just rename the bootstrap method to "old_bootstrap" and the "new_bootstrap" method should be renamed "bootstrap"

 