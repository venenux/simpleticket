# osticket-plugin: spreader

[simpleticket/osticket 1.9 seires](https://gitlab.com/venenux/simpleticket109) plugin 
for spreading/distribute/autoassigment tickets evenly between several managers.

Original work works with 1.10 api see in: https://github.com/berezuev/osticket-spreader

## Current status:

- does not filter wich one will assing due that, only takes all the checked managers and auto assing if marked to.
- Admin can choose depends of the managers, if one new manager are added must recheck if dessire to assing too.

## To Install:

For **simpleticket, has built-in** with all the requirements.

For the osticket, go to `plugin` directory and clone/download-zip there with own directory named `spreader`:

One files are there, go to admin panel and in plugins enable it and then configure it.

## To Remove:

Navigate to admin plugins view, click the checkbox and push the "Delete" button.

The plugin will still be available, you have deleted the config only at this point, 
to remove after deleting, remove the `spreader` related directory inside plugins directory..

