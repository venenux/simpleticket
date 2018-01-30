# osticket: Attachment Preview

[simpleticket/osticket 1.9 seires](https://gitlab.com/venenux/simpleticket109) plugin 
for that when you view a ticket allowing inlining preview of Attachments, see screenshots at the end.

Currently works with 1.9 and 1.10 api see in:: https://github.com/clonemeagain/attachment_preview/

Tested with osticket 1.10+ and 1.9+ with php 5.4 and 5.3.10 respectivelly.

## Current features:

- **This version parse as new popup window the links of each attachment**, respect the original.
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

For **simpleticket, has built-in** with all the requirements.

For the osticket, go to `plugin` directory and clone/download-zip there with own directory named `attachment_preview`:

One files are there, go to admin panel and in plugins enable it and then configure it.

## To Remove:

Navigate to admin plugins view, click the checkbox and push the "Delete" button.

The plugin will still be available, you have deleted the config only at this point, 
to remove after deleting, remove the `attachment_preview` related directory inside plugins directory..

# How it works:

Essentially it's simple, when enabled, and a ticket page is viewed, on osTicket BootStrap which 
waits for the page to be finished rendering by osTicket.
* an output buffer is created on osTicket BootStrap using php's register_shutdown_function & ob_start
* When that's done, we fetch the output buffer of the rendering override boostrap function of plugin
* and convert the HTML structure into a DOMDocument, by the preview plugin reuse class.
* The plugin then runs through the link elements of the Document, to find all Attachments.
* It then adds a new DOMElement after the attachments section, inlining each attachment. PDF's become `<object>`'s, PNG's become `<img>` etc. 

The plugin is self-contained, so ZERO MODS to core are required.

# How it looks:

![agent_view](https://cloud.githubusercontent.com/assets/5077391/15166401/bedd01fc-1761-11e6-8814-178c7d4efc03.png)

