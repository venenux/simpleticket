# osticket-oauth

[simpleticket/osticket](https://gitlab.com/venenux/simpleticket109) plugin 
for OAuth that provides SSO sign in from HTTP basic auth

Original work are stalled see in: https://github.com/osTicket/osTicket-plugins/tree/develop/auth-passthru

## Current status:

seems work, not fully tested

## To Install:

for simpleticket, has built-in.

For the osticket, go to `plugin` directory and clone/download-zip there with own directory named `auth-passthru` 

One files are there, go to admin panel and in plugins enable it and then configure it and enableit.

## To Remove:

Navigate to admin plugins view, click the checkbox and push the "Delete" button.

The plugin will still be available, you have deleted the config only at this point, to remove after deleting, 
remove the directory plugin.

# how its works:

the plguin make usage of the php `$_server` global variable by the internal `REMOTE_USER` index presence and a remote redirect per user.