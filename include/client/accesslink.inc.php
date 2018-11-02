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

$email=Format::input($_POST['lemail']?$_POST['lemail']:$_GET['e']);
$ticketid=Format::input($_POST['lticket']?$_POST['lticket']:$_GET['t']);

if ($cfg->isClientEmailVerificationRequired())
    $button = __("Email Access Link");
else
    $button = __("View Ticket");
?>

<!-- DMT EXTENDED Header -->
<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header"><?php echo __('Check Ticket Status'); ?><br />
        	<small class="page-header-meta">
            <?php
                            echo __('Please provide your email address and a ticket number.');
                            if ($cfg->isClientEmailVerificationRequired())
                                echo '<br />'.__('An access link will be emailed to you.');
                            else
                            echo '<br />'.__('This will sign you in to view your ticket.');
                        ?>
            </small>
         </h2>
    </div>
</div>

<!-- DMT EXTENDED Content -->
<form action="login.php" method="post" id="clientLogin"  ng-non-bindable>
	<?php csrf_token(); ?>
         <div class="row row-grid">


                <div class="col-md-4 col-md-offset-4 col-xs-12 text-center">
	                <div class="form-group">
        	        	<label for="email"><?php echo __('Email'); ?></label>
            	        <input type="text" name="lemail" id="email" class="form-control" value="<?php echo $email; ?>" size="20"
                           tabindex="10"
                           placeholder="" autofocus="autofocus"/>
    	            </div>
                	<div class="form-group">
                        <label for="ticketno"><?php echo __('Ticket Number'); ?></label>
                    	<input type="text" name="lticket" id="ticketno" class="form-control" value="<?php echo $ticketid; ?>" size="20"
                           tabindex="20"
                           placeholder=""/>
                	</div>
                	<div class="form-group">
                    	<input class="btn btn-success" type="submit" value="<?php echo __('Submit'); ?>"
                           tabindex="100"/>
                	</div>
                </div>


                <?php if ($cfg && $cfg->getClientRegistrationMode() !== 'disabled') { ?>
                    <div class="col-md-8 col-md-offset-2 col-xs-12 text-center">
		               <?php echo __('Have an account with us?'); ?> <a href="login.php"><?php echo __('sign in here'); ?></a>
                    </div>
				<?php	}?>

				<?php if ($cfg->isClientRegistrationEnabled()) { ?>
                    <div class="col-md-8 col-md-offset-2 col-xs-12 text-center">
						<?php echo sprintf(__('or %s register for an account %s to access all your tickets.'),
                            '<a href="account.php?do=create">','</a>');?>
                	</div>
                <?php	}?>		
                    <div class="col-md-8 col-md-offset-2 col-xs-12 text-center">
						<?php echo sprintf(__("If this is your first time contacting us or you've lost the ticket number, please %s open a new ticket %s"),
                            '<a href="open.php">','</a>'); 
                        ?> 
                	</div>
                    <div class="col-md-8 col-md-offset-2 col-xs-12 text-center">
                		<strong><?php echo Format::htmlchars($errors['login']); ?></strong>
                	</div>
      </div>
</form>


