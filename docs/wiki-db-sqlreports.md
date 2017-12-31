* [README/index](README.md)
* [wiki/documentation](wiki-a-index.md)

simpleticket : osTicket 1.9 fork
================================

Wiki SQL querys for reports, inspired in https://github.com/williamhamilton/osTicketReports and with many others more:

### Summary query ###

``` sql
SELECT `ost_organization`.`name`,
       `ost_ticket`.`number`,
       `ost_user`.`name`,
       `ost_ticket`.`user_email_id`,
       `ost_sla`.`name`,
       `ost_ticket`.`topic_id`,
       `ost_staff`.`firstname`,
       `ost_ticket`.`email_id`,
       `ost_ticket`.`flags`,
       `ost_ticket`.`ip_address`,
       `ost_ticket`.`source`,
       `ost_ticket`.`isoverdue`,
       `ost_ticket`.`isanswered`,
       `ost_ticket`.`duedate`,
       `ost_ticket`.`est_duedate`,
       `ost_ticket`.`reopened`,
       `ost_ticket`.`closed`,
       `ost_ticket`.`lastupdate`,
       `ost_ticket`.`created`,
       `ost_ticket`.`updated`
FROM `helpdesk`.`ost_user` AS `ost_user`,
     `helpdesk`.`ost_ticket` AS `ost_ticket`,
     `helpdesk`.`ost_organization` AS `ost_organization`,
     `helpdesk`.`ost_ticket_status` AS `ost_ticket_status`,
     `helpdesk`.`ost_staff` AS `ost_staff`,
     `helpdesk`.`ost_department` AS `ost_department`,
     `helpdesk`.`ost_sla` AS `ost_sla`
WHERE `ost_user`.`id` = `ost_ticket`.`user_id`
  AND `ost_organization`.`id` = `ost_user`.`org_id`
  AND `ost_ticket_status`.`id` = `ost_ticket`.`status_id`
  AND `ost_staff`.`staff_id` = `ost_ticket`.`staff_id`
  AND `ost_department`.`id` = `ost_ticket`.`dept_id`
  AND `ost_sla`.`id` = `ost_ticket`.`sla_id`
  AND `ost_department`.`id` = `ost_staff`.`dept_id`
```

### list all tickets query ###

``` sql
SELECT `ost_ticket`.`number` AS `Ticket Number`, `ost_user`.`name` AS `Client Ticket Owner`, `ost_ticket__cdata`.`subject` AS `Subject`,
 `ost_staff`.`username` AS `Staff Member`, `ost_ticket_status`.`name` AS `Ticket Status`,
 `ost_ticket`.`closed` AS `Closed Date`, `ost_organization`.`name` AS `Client Org` 
FROM
 { oj `helpdesk`.`ost_ticket` AS `ost_ticket` 
LEFT OUTER JOIN `helpdesk`.`ost_user` AS `ost_user` ON `ost_ticket`.`user_id` = `ost_user`.`id` 
RIGHT OUTER JOIN `helpdesk`.`ost_ticket__cdata` AS `ost_ticket__cdata` ON `ost_ticket`.`ticket_id` = `ost_ticket__cdata`.`ticket_id` },
 `helpdesk`.`ost_staff` AS `ost_staff`,
 `helpdesk`.`ost_ticket_status` AS `ost_ticket_status`,
 `helpdesk`.`ost_organization` AS `ost_organization` 
WHERE
 `ost_staff`.`staff_id` = `ost_ticket`.`staff_id` 
AND
 `ost_ticket_status`.`id` = `ost_ticket`.`status_id` 
AND
 `ost_organization`.`id` = `ost_user`.`org_id`
```

