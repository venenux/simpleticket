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

$info=($_POST && $errors)?Format::htmlchars($_POST):array();

$dept = $ticket->getDept();

if ($ticket->isClosed() && !$ticket->isReopenable())
    $warn = __('This ticket is marked as closed and cannot be reopened.');

//Making sure we don't leak out internal dept names
if(!$dept || !$dept->isPublic())
    $dept = $cfg->getDefaultDept();

?>



<!-- DMT EXTENDED Header -->
<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header"><?php echo sprintf(__('Ticket #%s'), $ticket->getNumber()); ?> 

          <a class="btn btn-success" href="tickets.php?id=<?php echo $ticket->getId(); ?>" title="Reload" role="button"><i class="fa fa-refresh"></i>
          </a>
            <?php if ($cfg->allowClientUpdates()
                  // Only ticket owners can edit the ticket details (and other forms)
                  && $thisclient->getId() == $ticket->getUserId()) { ?>
            <a class="btn btn-warning" style="margin-right: 10px;" href="tickets.php?a=edit&id=<?php
                               echo $ticket->getId(); ?>"><i class="fa fa-edit"></i></a>
            <?php } ?>
            
            <?php if ($thisclient && $thisclient->isGuest() && $cfg->isClientRegistrationEnabled()) { ?>
		  			<span class="page-header-meta" id="msg_info"><strong><?php echo __('Looking for your other tickets?'); ?></strong>
                    	<a href="<?php echo ROOT_PATH; ?>login.php?e=<?php echo urlencode($thisclient->getEmail()); ?>">
							<?php echo __('Sign In'); ?>
                        </a> 
						<?php echo sprintf(__('or %s register for an account %s for the best experience on our help desk.'),
				  		'<a href="account.php?do=create" style="text-decoration:underline">','</a>'); ?> 
                    </span>
		  <?php } ?>
            
        </h2>
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
  
  
  <?php
foreach (DynamicFormEntry::forTicket($ticket->getId()) as $idx=>$form) {
    $answers = $form->getAnswers();
    if ($idx > 0 and $idx % 2 == 0) { ?>
        </tr><tr>
    <?php } ?>
    <td width="50%">
        <table class="infoTable" cellspacing="1" cellpadding="3" width="100%" border="0">
    <?php foreach ($answers as $answer) {
        if (in_array($answer->getField()->get('name'), array('name', 'email', 'subject')))
            continue;
        elseif ($answer->getField()->get('private'))
            continue;
        ?>
        <tr>
        <th width="100"><?php echo $answer->getField()->get('label');
            ?>:</th>
        <td><?php echo $answer->display(); ?></td>
        </tr>
    <?php } ?>
    </table></td>
<?php } ?>
</tr>
</table>

<ul class="list-group">
    <li class="list-group-item active"><?php echo __('Subject'); ?>: <strong><?php echo Format::htmlchars($ticket->getSubject()); ?></strong>
    </li>
        

<?php
if($ticket->getThreadCount() && ($thread=$ticket->getClientThread())) {
    $threadType=array('M' => 'message', 'R' => 'response');
    foreach($thread as $entry) {

        //Making sure internal notes are not displayed due to backend MISTAKES!
        if(!$threadType[$entry['thread_type']]) continue;
        $poster = $entry['poster'];
        if($entry['thread_type']=='R' && ($cfg->hideStaffName() || !$entry['staff_id']))
            $poster = ' ';
        ?>
        <li class="list-group-item">
        		<?php echo Format::clickableurls($entry['body']->toHtml()); ?><br />
				<p class="well bg-info spacer-top"><small><?php echo Format::db_datetime($entry['created']); ?> | <?php echo $poster; ?>

            <?php
            if($entry['attachments']
                    && ($tentry=$ticket->getThreadEntry($entry['id']))
                    && ($urls = $tentry->getAttachmentUrls())
                    && ($links= $tentry->getAttachmentsLinks())) { ?>
                 | <?php echo $links; ?>

<?php       }
            if ($urls) { ?>
                <script type="text/javascript">
                    $(function() { showImagesInline(<?php echo
                        JsonDataEncoder::encode($urls); ?>); });
                </script>
<?php       } ?>
</small></p>
        </li>
    <?php
    }
}
?>
</ul>

<?php

if (!$ticket->isClosed() || $ticket->isReopenable()) { ?>
  <div class="panel panel-default">
<form id="reply" action="tickets.php?id=<?php echo $ticket->getId(); ?>#reply" name="reply" method="post" enctype="multipart/form-data">
    <?php csrf_token(); ?>
    <div class="panel-heading" style="background-color:#337AB7; color:#ffffff;">
    <?php echo __('Post a Reply');?>
    </div>
    	<div class="panel-body">
    <input type="hidden" name="id" value="<?php echo $ticket->getId(); ?>">
    <input type="hidden" name="a" value="reply">

                <?php
                if($ticket->isClosed()) {
                    $msg='<b>'.__('Ticket will be reopened on message post').'</b>';
                } else {
                    $msg=__('To best assist you, we request that you be specific and detailed');
                }
                ?>
                        	<blockquote>
                <span id="msg"><em><?php echo $msg; ?> </em></span><font class="error">*&nbsp;<?php echo $errors['message']; ?></font>
                </blockquote>
                <textarea name="message" id="message" cols="50" rows="9" wrap="soft"
                    data-draft-namespace="ticket.client"
                    data-draft-object-id="<?php echo $ticket->getId(); ?>"
                    class="richtext ifhtml draft"><?php echo $info['message']; ?></textarea>

    
        <?php
        if ($messageField->isAttachmentsEnabled()) { ?>
        				<div class="dropzone"><i class="icon-upload"></i>
<?php
            print $attachments->render(true);
            print $attachments->getForm()->getMedia();
?>
						</div>
        <?php
        } ?>

        <div>
        <input class="btn btn-success" type="submit" value="<?php echo __('Post Reply');?>">
        <input class="btn btn-warning" type="reset" value="<?php echo __('Reset');?>">
        <input class="btn btn-danger" type="button" value="<?php echo __('Cancel');?>" onClick="history.go(-1)">
        </div>
      </div>
      </form>
<?php
} ?>

  
  
</div>

<!-- DMT EXTENDED -->

</div>
</div>