<?php
/*!
 * @copyright 2016 Josh Richard <https://joshrichard.net/licenses/mit>
 * @see <https://github.com/c0nfus3d/osticket-mods/tree/master/autolink-ticket-references>
 */
require('staff.inc.php');

$sql = "SELECT `ticket_id` from " . TICKET_TABLE . " WHERE `number`=" . db_input($_REQUEST['id']) . " LIMIT 1";

if(!($res=db_query($sql))) {
  die("Ticket not found");
}
else {
  $res = db_fetch_array($res);
  header("Location: tickets.php?id={$res['ticket_id']}");
  die();
}

?>
