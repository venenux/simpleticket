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
if(!defined('OSTCLIENTINC')) die('Access Denied!');
$info=array();
if($thisclient && $thisclient->isValid()) {
    $info=array('name'=>$thisclient->getName(),
                'email'=>$thisclient->getEmail(),
                'phone'=>$thisclient->getPhoneNumber());
}

$info=($_POST && $errors)?Format::htmlchars($_POST):$info;

$form = null;
if (!$info['topicId'])
    $info['topicId'] = $cfg->getDefaultTopicId();

if ($info['topicId'] && ($topic=Topic::lookup($info['topicId']))) {
    $form = $topic->getForm();
    if ($_POST && $form) {
        $form = $form->instanciate();
        $form->isValidForClient();
    }
}

?>

<!-- DMT EXTENDED Header -->
<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header"><?php echo __('Open a New Ticket');?><br />
        <small class="page-header-meta"><?php echo __('Please fill in the form below to open a new ticket.');?></small></h2>
    </div>
</div>

<!-- DMT EXTENDED Content -->
  
<div class="row">

<form id="ticketForm" method="post" action="open.php" enctype="multipart/form-data">
  <?php csrf_token(); ?>

<!-- DMT EXTENDED Left Column -->

<div class="col-md-3">
        	<ul class="list-group">
   				<li class="list-group-item active">
    				<?php echo __('Basic Information');?>
    			</li>
   				<li class="list-group-item"> <b><?php echo __('Help Topic');?></b>
                        <select class="form-control" id="topicId" name="topicId" onchange="javascript:
                            var data = $(':input[name]', '#dynamic-form').serialize();
                            $.ajax(
                              'ajax.php/form/help-topic/' + this.value,
                              {
                                data: data,
                                dataType: 'json',
                                success: function(json) {
                                  $('#dynamic-form').empty().append(json.html);
                                  $(document.head).append(json.media);
                                }
                              });">
                        <option value="" selected="selected"><?php echo __('Select a Help Topic');?></option>
                        <?php
                        if($topics=Topic::getPublicHelpTopics()) {
                            foreach($topics as $id =>$name) {
                                echo sprintf('<option value="%d" %s>%s</option>',
                                        $id, ($info['topicId']==$id)?'selected="selected"':'', $name);
                            }
                        } else { ?>
                            <option value="0" ><?php echo __('General Inquiry');?></option>
                        <?php
                        } ?>
            		</select>
           			<span class="bg-danger small">* <?php echo __('Required'); ?><?php echo $errors['topicId']; ?></span>	 
                </li>
    			<?php
        if (!$thisclient) {?>
			<div class="spacer-top">
            <?php
            $uform = UserForm::getUserForm()->getForm($_POST);
            if ($_POST) $uform->isValid();
            $uform->render(false);
			?>
            </div>
            <?php
        }
        else { ?>
 				<li class="list-group-item"> <b><?php echo __('Client'); ?></b><br />
        		<?php echo $thisclient->getName(); ?>
                </li>
 				<li class="list-group-item"> <b><?php echo __('Email'); ?></b><br />
        		<?php echo $thisclient->getEmail(); ?>
                </li>                
			</ul>
        <?php } ?>

</div>
            
   <!-- DMT EXTENDED Right Column -->

<div class="col-md-9">         

  <input type="hidden" name="a" value="open">

   

		<div id="dynamic-form">
        <?php if ($form) {
            include(CLIENTINC_DIR . 'templates/dynamic-form.tmpl.php');
        } ?>
        </div>
	<?php
        $tform = TicketForm::getInstance();
        if ($_POST) {
            $tform->isValidForClient();
        }
        $tform->render(false); ?>

    <?php
    if($cfg && $cfg->isCaptchaEnabled() && (!$thisclient || !$thisclient->isValid())) {
        if($_POST && $errors && !$errors['captcha'])
            $errors['captcha']=__('Please re-enter the text again');
        ?>
<?php echo __('CAPTCHA Text');?>
            <span class="captcha"><img src="captcha.php" border="0" align="left"></span>
            &nbsp;&nbsp;
            <input id="captcha" type="text" name="captcha" size="6" autocomplete="off">
            <em><?php echo __('Enter the text shown on the image.');?></em>
            <font class="error">*&nbsp;<?php echo $errors['captcha']; ?></font>

    <?php
    } ?>
</div>
</div>

<hr>

<div class="row">
	<div class="col-lg-12" style="text-align: center;">
        <input class="btn btn-success" type="submit" value="<?php echo __('Create Ticket');?>">
        <input class="btn btn-warning" type="reset" name="reset" value="<?php echo __('Reset');?>">
        <input class="btn btn-danger" type="button" name="cancel" value="<?php echo __('Cancel'); ?>" onclick="javascript:
            $('.richtext').each(function() {
                var redactor = $(this).data('redactor');
                if (redactor && redactor.opts.draftDelete)
                    redactor.deleteDraft();
            });
            window.location.href='index.php';">
        </div>
</div>
</form>

