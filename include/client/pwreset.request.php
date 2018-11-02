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

$userid=Format::input($_POST['userid']);
?>
<!-- DMT EXTENDED Header -->
<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header"><?php echo __('Forgot My Password'); ?></h2>
    </div>
</div>

<!-- DMT EXTENDED Content -->
  
<div class="row row-grid loginSection">
		<form action="pwreset.php" method="post" id="clientLogin">
            <?php csrf_token(); ?>
			<input type="hidden" name="do" value="sendmail"/>
                <div class="col-md-8 col-md-offset-2 col-xs-12 text-center">
				<?php echo __('Enter your username or email address in the form below and press the <strong>Send Email</strong> button to have a password reset link sent to your email account on file.'); ?>
                </div>
                <div class="col-md-4 col-md-offset-4 col-xs-12 text-center">
	                <div class="form-group">
        	        	<label for="username"><?php echo __('Email or Username'); ?></label>
                    	<input type="text" name="userid" id="username" class="form-control" value="<?php echo $userid; ?>" size="20"
                           tabindex="10"
                           placeholder="" autofocus="autofocus"/>
					</div>
	                <div class="form-group">
                    <input class="btn btn-success" type="submit" value="<?php echo __('Send Email'); ?>"
                           tabindex="100"/>
                    </div>
               </div>
		</form>
</div>

