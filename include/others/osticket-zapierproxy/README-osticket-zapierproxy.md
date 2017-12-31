# OsTicket Zapier HTTP Proxy brigde

PHP file that will redirect Zapier HTTP POST requests to Osticket site.


Zapier will contain most of the information pulled from HubSpot. 
This information will get sent to the PHP script, which will then redirect it to OS Ticket.

OS Ticket has a current limitation where it can **only accept one IP address per API Key**. 
Zapier uses load balancing to distibute their tasks, so **it will not work with Os Ticket without this proxy**.

must be tunned for usage.
