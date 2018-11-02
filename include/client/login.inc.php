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
if(!defined('OSTCLIENTINC')) die('Access Denied');

$email=Format::input($_POST['luser']?:$_GET['e']);
$passwd=Format::input($_POST['lpasswd']?:$_GET['t']);

$content = Page::lookup(Page::getIdByType('banner-client'));

?>
<!-- DMT EXTENDED Header -->
<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header"><?php echo __('Sign In'); ?></h2>
    </div>
</div>

<!-- DMT EXTENDED Content -->
  
<div class="row row-grid loginSection">
            <form action="login.php" method="post" id="clientLogin"  ng-non-bindable>
			    <?php csrf_token(); ?>
                <div class="col-md-4 col-md-offset-4 col-xs-12 text-center">
	                <div class="form-group">
        	        	<label for="username"><?php echo __('Email or Username'); ?></label>
            	        <input type="text" name="luser" id="username" class="form-control" value="<?php echo $email; ?>" size="20"
                           tabindex="10"
                           placeholder="" autofocus="autofocus"/>
    	            </div>
                	<div class="form-group">
                        <label for="passwd"><?php echo __('Password'); ?></label>
                    	<input type="password" name="lpasswd" id="passwd" class="form-control" value="<?php echo $passwd; ?>" size="20"
                           tabindex="20"
                           placeholder=""/>
                	</div>
                	<div class="form-group">
                    	<input class="btn btn-success" type="submit" value="<?php echo __('Sign In'); ?>"
                           tabindex="100"/>
                	</div>
                </div>
                <?php

$ext_bks = array();
foreach (UserAuthenticationBackend::allRegistered() as $bk)
    if ($bk instanceof ExternalAuthentication)
        $ext_bks[] = $bk;

if (count($ext_bks)) {
    foreach ($ext_bks as $bk) { ?>
<div class="external-auth"><?php $bk->renderExternalLink(); ?></div><?php
    }
}?>
</div>
<div class="row row-grid">
<?php
if ($cfg && $cfg->isClientRegistrationEnabled()) {
    if (count($ext_bks))?>
    <div class="col-md-8 col-md-offset-2 col-xs-12 text-center">
    	<?php echo __('Not yet registered?'); ?> <a href="account.php?do=create"><?php echo __('Create an account'); ?></a>
    </div>
	<?php } ?>
    <div class="col-md-8 col-md-offset-2 col-xs-12 text-center">
		<?php if ($suggest_pwreset) { ?>
        	<a style="padding-top:4px;display:inline-block;" href="pwreset.php"><?php echo __('Forgot My Password'); ?></a>
		<?php } ?>
    </div>
    <div class="col-md-8 col-md-offset-2 col-xs-12 text-center">
    	<?php echo __("I'm an agent"); ?><a href="<?php echo ROOT_PATH; ?>scp/"> <?php echo __('sign in here'); ?></a>
    </div>

            </form>
<?php if ($cfg && !$cfg->isClientLoginRequired()) {?>
	<div class="col-md-8 col-md-offset-2 col-xs-12 text-center">
    <?php
    echo sprintf(__('If this is your first time contacting us or you\'ve lost the ticket number, please %s open a new ticket %s'),
        '<a href="open.php">', '</a>');?>
    </div> 
		
	<?php } ?>
</div>
