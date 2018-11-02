<?php
/*********************************************************************

	Responsive Bootstrap Theme "Extended Basic" 1.0.1
    Stable Version "Great Pumpkin" | Released 2015.10.31
	
	Jürgen Buchberger <jbuchberger@direktmarketingtool.de>
	Copyright (c) 2015 DMT direktmarketingtool.de GmbH
	http://www.direktmarketingtool.de

	Follow us on Facebook in English: https://www.facebook.com/dmtgmbhen
	Folge uns auf Facebook in Deutsch: https://www.facebook.com/dmtgmbh

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

**********************************************************************/
?>

<?php

if(!defined('OSTCLIENTINC') || !$thisclient || !$ticket || !$ticket->checkUserAccess($thisclient)) die('Access Denied!');

?>

<!-- DMT EXTENDED Header -->
<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header"><?php echo sprintf(__('Editing Ticket #%s'), $ticket->getNumber()); ?></h2>
    </div>
</div>

<!-- DMT EXTENDED Content -->

<div class="row">

<!-- DMT EXTENDED Left Column -->

<div class="col-md-3">
  <ul class="list-group">
    <li class="list-group-item active">
      Info
    </li>
    <li class="list-group-item"> <b><?php echo __('Ticket Status');?>:</b><br />
      <?php echo $ticket->getStatus(); ?> </li>
    <li class="list-group-item"> <b><?php echo __('Name');?>:</b><br />
      <?php echo mb_convert_case(Format::htmlchars($ticket->getName()), MB_CASE_TITLE); ?> </li>
    <li class="list-group-item"> <b><?php echo __('Department');?>:</b><br />
      <?php echo Format::htmlchars($dept instanceof Dept ? $dept->getName() : ''); ?> </li>
    <li class="list-group-item"> <b><?php echo __('Email');?>:</b><br />
      <?php echo Format::htmlchars($ticket->getEmail()); ?> </li>
    <li class="list-group-item"> <b><?php echo __('Create Date');?>:</b><br />
      <?php echo Format::db_datetime($ticket->getCreateDate()); ?> </li>
    <?php if ($ticket->getPhoneNumber()>""){?>
    <li class="list-group-item"> <b><?php echo __('Phone');?>:</b><br />
      <?php echo $ticket->getPhoneNumber(); ?> </li>
    <?php } ?>
  </ul>
</div>

<!-- DMT EXTENDED Right Column -->

<div class="col-md-9">



<form action="tickets.php" method="post">
    <?php echo csrf_token(); ?>
    <input type="hidden" name="a" value="edit"/>
    <input type="hidden" name="id" value="<?php echo Format::htmlchars($_REQUEST['id']); ?>"/>
<table width="800">
    <tbody id="dynamic-form">
    <?php if ($forms)
        foreach ($forms as $form) {
            $form->render(false);
    } ?>
    </tbody>
</table>
</div>
</div>
<hr>
        <div class="row text-center">
        <input class="btn btn-success" type="submit" value="<?php echo __('Update');?>">
        <input class="btn btn-warning" type="reset" value="<?php echo __('Reset');?>">
        <input class="btn btn-danger" type="button" value="<?php echo __('Cancel');?>" onclick="javascript:
        window.location.href='index.php';"/>
        </div>

</form>

