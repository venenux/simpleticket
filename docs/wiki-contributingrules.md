* [README/index](README.md)
* [wiki/documentation](wiki-a-index.md)

simpleticket : osTicket 1.9 fork CONTRIBUTING GUIDELINES AND RULES
================================

<a href="https://venenux.github.io/simpleticket109/"><img src="media/simpleticketlogo.gif"
align="left" hspace="10" vspace="6"></a>

Fork from **osTicket** 1.9 version series, widely-used open source support 
ticket system; integrates inquiries created via email, phone or web-based 
simple easy-to-use multi-user interface.

Contributing introductions
--------------------------

In quick resumen, create your own fork of the project and use
[git-flow](https://github.com/nvie/gitflow) to create a new feature. Once
the feature is published in your fork, send a pull request to begin the
conversation of integrating your new feature into osTicket.

Translation information guide
-----------------------------

Please read the  [wiki-translators.md](wiki-translators.md) document for specific guidelines 
respect translation rules. Original osticket used Crowdin to manage translations, but not simpleticket.

Basically can use the `en_US` directory as template and rename to the new lang or 
can visit translation page at http://i18n.crowdin.com/ and copy the 
template or a based file to work inside simpleticket and conver all entries to.

# Code and source Contribution Guidelines #
-------------------------------------------

**Gerenal rules for start suggestions and request**:
* Start individual Issue for each discussion topic
* Make individual pull requests for each atomic change
* Be sure you have searched for duplicate of your addition in existing list and Issues/Pull requests
* Remove unneeded trailing whitespaces
* Format code according to the rules explained in this document below

**General rules for that pulls/merge code into the repository**:
* must be php 5.3 compatible and mysql 5.2 compatible
* must be linux related and bsd working instalations
* must provide explanations and documentations
* all pull/merge must be editable by the contributor not only the autors
* all must be in gitlab, github its a privative piece of shit only mirror!

Please follow the reading to understand all the related conventions:

## Indenting, Open/close and Whitespace ##

* **Ident** of 4 spaces, with no tabs.
* **Lines** should have no trailing whitespace at the end.
* **Files** should be formatted with `\n` as the line ending (Unix line endings), not any guindoser like.
* **Text** files should end in a single alone newline `\n` at the end of. 
* The **opening curly** should be on the new line as the opening statement, preceded by one space in previously line. 
* The **closing curly** should be on a line by itself and indented to the same level as the opening statement.

**IMPORTANT**: we need the single alone newline ending this makes patches easier to read since it's clearer 
what is being changed when lines are added to the end of a file, also to 
avoids verbose "\ No newline at end of file" patch warning .

**NOTE**: All blocks at the beginning of a PHP file should be separated by a blank line.
This includes the /** @file */ block, the namespace declaration and the use statements (if present) as well 
as the subsequent code in the file. 

So, for example, a **class header might look as** follows:

``` php
<?php

/**
 * @class
 * Provides example class abstraction.
 */

namespace This\Is\The\Namespace;

use Class;

/**
 * Provides examples.
 */
class ExampleClassName 
{
```

Or, for a **non-class file might look as** follows:

``` php
<?php

/**
 * @file
 * Provides example functionality.
 */

use Class;

/**
 * Implements hook_help().
 */
function example_help($route_name) 
{
```

## Operators, conditionals and control cicles ##

All **binary operators** (operators that come between two values), such as `+, -, =, !=, ==, >,` etc. 
should have a space before and after the operator, for readability. For example, an assignment 
should be formatted as `$foo = $bar;` rather than `$foo=$bar;`. 

All **Unary operators** (operators that operate on only one value), such as `++, --,` etc 
should not have a space between the operator and the variable or number they are operating on.

All **inequality Checks** for coding non-sql weak-typed inequality MUST use the `!=` operator. 
Only **for SQL** must be use the `<>` operator, and MUST NOT be used in PHP/C/GAMBAS code.

All **Control structures** include `if, for, while, switch,` etc. should have one space 
between the control keyword and opening parenthesis, to distinguish them from function calls, 

All **Control statements** must use curly braces even in situations where they are technically optional, 
unless the block code will be a if-else only block of the entire file.

Having them increases readability and decreases the likelihood of logic errors being introduced when new lines are added.

``` php
if (condition1 || condition2) 
{
    action1;
}
elseif ((condition3 && condition4) != condition5)  // and Don't use "else if" -- always use elseif.)
{
    action2;
}
else 
{
    defaultaction;
}
```

For switch statements:

``` php
switch (condition) 
{
    case 1:
      action1;
      break;

    case 2:
        action2;
        break;

    default:
        defaultaction;
}
```

For do-while statements:

``` php
do 
{
    actions;
} while ($condition);
```

## mixed control code structures ##

In mixed code, the alternate control statement syntax using : instead of brackets is prefered. 
Note that there should not be a space between the closing parenthesis after the control keyword, and the colon, 
and HTML/PHP inside the control structure should be indented. For example:

``` php
<?php if (!empty($item)): ?>
    <p><?php print $item; ?></p>
<?php endif; ?>
```

``` php
<?php foreach ($items as $item): ?>
    <p><?php print $item; ?></p>
<?php endforeach; ?>
```

## Arrays ##

Arrays should be formatted **using long array syntax** with a space separating each element (after the comma), 
and spaces around the `=>` key association operator, all of this for php compatibility:

`$some_array = array('hello', 'world', 'foo' => 'bar');`

Note that if the line declaring an array spans longer than 80 characters (often the case with form and menu declarations), 
each element should be broken into its own line, and indented one level and taking care of itentation:

``` php
$form['title'] = array(
      '#type' => 'textfield',
      '#title' => t('Title'),
      '#size' => 60,
      '#maxlength' => 128,
      '#description' => t('The title of your node.'),
    );
```

Note the comma at the end of the last array element; This is not a typo! It helps prevent parsing errors if another element is placed at the end of the list later.

## Declarations and Calls ##

References and objects should be called with no spaces between the name, the opening parenthesis, and the first parameter; 
spaces between commas and each parameter, and no space between the last parameter, the closing parenthesis, and the semicolon.

`$var = foo($bar, $baz, $quux);`

Arguments with default values go at the end of the argument list. Always attempt to return a meaningful value from a function.

``` php
function funstuff_system($field, $withdefault=null) 
{
    $system['description'] = t("This module inserts funny text into posts randomly.");
    if ($withdefault === null)
        $filed = 'description';
    return $system[$field];
}
```

When calling class constructors with no arguments, always include parentheses:
This is to maintain consistency with constructors that have arguments:
Note that if the class name is a variable, the variable will be evaluated first to get the class name, 
and then the constructor will be called. Use the same syntax:

``` php
$bar = 'MyClassName';
$foo = new $bar();
$foo = new $bar($arg1, $arg2);
```

## Line length and wrapping ##

Based lossy in Doxygen documentation and comment formatting conventions for rules pertaining to comments.

* In general, all lines of code should not be longer than 80 characters.
* ALWAYS plit out and prepare the conditions separately, which also permits documenting the underlying reasons.
* Lines containing longer function names, function/class definitions, variable declarations, etc are allowed to exceed.
* Control structure conditions may exceed 80 characters, if they are simple to read and understand.
* Conditions should not be wrapped into multiple lines.

## Naming conventions ##

Global variables should start with a single underscore followed by the module/theme name and another underscore.

Constants should always be all-uppercase, with underscores to separate words. (This includes pre-defined PHP constants like TRUE, FALSE, and NULL.)
Module/class defined constant names should also be prefixed by an uppercase spelling of the module/class that defines them.

Functions should be named using lowercase, and words should be separated with an underscore. Functions should in 
addition have the grouping/module name as a prefix, to avoid name collisions between modules.

Variables should be named using lowercase, and words should be separated either with uppercase characters 
example: $lowerCamelCase)` or with an underscore example: `$snake_case`; do not mix camelCase and snake_case naming.

All files should have the file name extension ".md" and must use markdown sintax, 
i dont care stupid and ignorants Guindows systems. Also, the file names for such files should be caption sensitive
while the extension itself is all-lowercase (i.e. txt instead of TXT).

