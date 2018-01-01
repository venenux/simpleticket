# Attachment Preview

An [simpleticket 1.9 seires](https://gitlab.com/venenux/simpleticket109) plugin allowing inlining preview of Attachments

own made plugin modifications for osticket 1.9 but reported also work with 1.10 without breaking api.

Original work also has some of the modifications see in: https://github.com/clonemeagain/attachment_preview/

#How it looks:

![agent_view](https://cloud.githubusercontent.com/assets/5077391/15166401/bedd01fc-1761-11e6-8814-178c7d4efc03.png)

## Current features:
- PDF Files attachments are embedded as full PDF `<object>` in the entry.
- Images inserted as normal `<img>` tags. Supported by most browsers: `png,jpg,gif,svg,bmp`
- Text files attachments are inserted into using `<pre>` (If enabled). 
- HTML files are filtered and inserted (If enabled). 
- Youtube links in comments can be used to create embedded `<iframe>` players. (if enabled)
- HTML5 Compatible video formats attached are embedded as `<video>` players. (if enabled)
- All modifications to the DOM are now performed on the server.
- Admin can choose the types of attachments to inline, and who can inline them.
- Default admin options are embed "PDF's & Images" only for "Agents".
- Plugin API: allows other plugins to manipulate the DOM without adding race conditions or multiple re-parses.

## To Install:
Due simpleticket has built-in go to admin panel and in plugins enable it and then configure it.

## To Remove:
Navigate to admin plugins view, click the checkbox and push the "Delete" button.

The plugin will still be available, you have deleted the config only at this point, to remove after deleting, remove the /plugins/attachment_preview folder.


# How it works:
See original wiki work in https://github.com/clonemeagain/attachment_preview/wiki

* Essentially it's simple, when enabled, and a ticket page is viewed, an output buffer is created on osTicket BootStrap which waits for the page to be finished rendering by osTicket. (Using php's register_shutdown_function & ob_start)
* When that's done, we fetch the output buffer and convert the HTML structure into a DOMDocument, pretty standard PHP so far.
* The plugin then runs through the link elements of the Document, to find all Attachments.
* It then adds a new DOMElement after the attachments section, inlining each attachment. PDF's become `<object>`'s, PNG's become `<img>` etc. 

The plugin is self-contained, so ZERO MODS to core are required. You simply clone the repo or download the zip from github and extract into /includes/plugins/ which should make a folder: "attachment_preview", but it could be called anything. 


# TODO:
- ??
- You tell me!
