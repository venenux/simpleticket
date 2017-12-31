<?php
  require_once("Mail.php");

  /**
   * Find user with less tickets and assing the new one
   */
  function assignTicketToBoredStaff($conOst, $ticket) {
    $sqlOkm = "SELECT id, mail FROM okm_assigner WHERE active=1 GROUP BY tickets HAVING tickets=MIN(tickets) LIMIT 1";
    $stmtOkm = $conOst->prepare($sqlOkm);
    $stmtOkm->execute();

    if ($rsOkm = $stmtOkm->fetch()) {
      $staffId = $rsOkm['id'];
      $staffMail = $rsOkm['mail'];
      echo "Assign ticket ".$ticket." to staff ".$staffId." (".$staffMail.")\n";

      // Assign the ticket
      $sqlOst = "UPDATE ost_ticket SET staff_id=:staff WHERE ticket_id=:ticket";
      $stmtOst = $conOst->prepare($sqlOst);
      $stmtOst->execute(array('staff' => $staffId, 'ticket' => $ticket));

      // Increase ticket count
      $sqlOkm = "UPDATE okm_assigner SET tickets=tickets+1 WHERE id=:id";
      $stmtOkm = $conOst->prepare($sqlOkm);
      $stmtOkm->execute(array('id' => $staffId));

      // Send mail
      $from = "<contact@yourdomain.com>"; $to = $staffMail;
      $host = "mail.yourdomain.com"; $username = "mail-user@yourdomain.com"; $password = "mail-password";
      $headers['From'] = $from; $headers['To'] = $to;
      $headers['Subject'] = 'New ticket assigned';
      $headers['MIME-Version'] = '1.0'; $headers['Content-Type'] = 'text/html; charset=UTF-8';
      $smtp = Mail::factory('smtp', array ('host' => $host, 'auth' => true, 'username' => $username, 'password' => $password));
      $body = '<html><body>';
      $body .= 'New ticket assigned';
      $body .= ' <a href="http://support.yourdomain.com/scp/tickets.php?id='.$ticket.'">Ticket #'.$ticket.'</a>';
      $body .= '</body></html>';
      $mail = $smtp->send($to, $headers, $body);

      if (PEAR::isError($mail)) {
        die("Mail send error: ".$mail->getMessage());
      }
    } else {
      die("Query did no return any staff member");
    }
  }

  /**
   * Assing a ticket to an user
   */
  function assignTicket($con, $ticket, $staff) {
    $sql = "UPDATE ost_ticket SET staff_id=:staff WHERE ticket_id=:ticket";
    $stmt = $con->prepare($sql);
    $stmt->execute(array('staff' => $staff, 'ticket' => $ticket));
  }

  /**
   * Obtain unassigned new created tickets
   */
  function getUnassignedTickets($con) {
    $sql = "SELECT ticket_id, number, dept_id, staff_id, status FROM ost_ticket WHERE status='open' and staff_id=0";
    $ret = array();
    $stmt = $con->prepare($sql);
    $stmt->execute();

    while ($rs = $stmt->fetch()) {
      $ret[] = $rs['ticket_id'];
    }

    return $ret;
  }

  $conOst = new PDO('mysql:host=localhost;dbname=ost_db', 'ost_user', 'ost_password');
  foreach (getUnassignedTickets($conOst) as $ticket) {
    $staff = assignTicketToBoredStaff($conOst, $ticket);
  }
?>
