# osTicket-APIclass-php

php class for interact with osticket with some patches for create or send tickets using json own format.

## usage

some patches are need, please revise the patches directory to compare the files apropiates.

## example:

``` php
<?php
require_once("config.php");
require_once("tickets.php");

$t = new tickets(true, $global_config["tickets_db"]);

$user_data=json_decode('{"name":"Thomas","surname":"Anderson","email":"neo@matrix.com"}');
$post_data=array(
"department_id"=>1,
"subject"=>"Who is Trinity?",
"txt"=>"Dear Sir or Madam, I'm looking for..."
);

var_dump($t->create($post_data,$user_data,false));
```

This will output as `var_dump`:

``` php
array(2) {
  ["ok"]=>
  string(2) "ok"
  ["d"]=>
  int(351425)
}
```
where 351425 is a ticket id

