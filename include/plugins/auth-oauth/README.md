# osticket-oauth

[simpleticket/osticket 1.9 seires](https://gitlab.com/venenux/simpleticket109) plugin 
for OAuth that provides SSO sign in from many popular external sources
including Google+, GitHub, Facebook, Windows Azure, and many more.


Original work are stalled see in: https://github.com/osTicket/osTicket-plugins/tree/develop/auth-oauth

## Current status:

**At the current time, only Google+ authentication is implemented.** and development seems stalled!

## To Install:

for simpleticket, has built-in.

For the osticket, go to `plugin` directory and clone/download-zip there with own directory named `auth-oauth` 

One files are there, go to admin panel and in plugins enable it and then configure it and enableit.

## To Remove:

Navigate to admin plugins view, click the checkbox and push the "Delete" button.

The plugin will still be available, you have deleted the config only at this point, to remove after deleting, 
remove the directory plugin.

# how its works:

**Google+** Authentication

To register for Google+ authentication,

* Visit the Google Cloud Console (https://console.developers.google.com/)
* Sign in to Google via a relevant account
* Create a project (name it whatever -- osTicket Help Desk)
* Manage the project, navigate to APIs and Auth / Credentials and create an
  OAuth Client ID
* Register the key with the URL of your helpdesk plus `api/auth/ext`
  (`http://support.mycompany.com/api/auth/ext`). This is called the *Redirect
  URI*
* Navigate to APIs & Auth / Consent Screen and fill in the relevant information
* Navigate to APIs & Auth / APIs and add / enable the *Google+ API*
* Install the plugin in osTicket **1.9**
* Configure the plugin with your Google+ Client ID and Secret
* Configure the plugin to authenticate agents (staff), users or both
* Enable the OAuth plugin
* Log out and back in with Google+
* Enjoy!

