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

<!-- DMT EXTENDED Header -->
<div class="row">
	<div class="col-lg-12">
		<?php if ($content) {
    				list($title, $body) = $ost->replaceTemplateVariables(
        			array($content->getName(), $content->getBody())); 
				?>
					<h2 class="page-header">
						<?php echo Format::display($title); ?>
                    </h2>
		
		<?php } else { ?>
        
					<h2 class="page-header">
						<?php echo __('Account Registration'); ?>
                    </h2>
		<?php } ?>
   </div>
</div>

<!-- DMT EXTENDED Content -->
  
<div class="row row-grid loginSection">

	<?php if ($content) {
    				list($title, $body) = $ost->replaceTemplateVariables(
        			array($content->getName(), $content->getBody())); 
			?>
			<form>
    		        <div class="col-md-8 col-md-offset-2 col-xs-12 text-center">
						<?php
							echo Format::display($body); 
						?>
					</div>
			</form>
            
	<?php } else { ?>
	
    		<form>
    		        <div class="col-md-8 col-md-offset-2 col-xs-12 text-center">
						<?php 
							echo __('Thanks for registering for an account.'); 
						?>
					</div>
    		        <div class="col-md-8 col-md-offset-2 col-xs-12 text-center">
						<?php 
							echo __("We've just sent you an email to the address you entered. Please follow the link in the email to confirm your account and gain access to your tickets."); 
						?>
					</div>
		</form>
	<?php } ?>
</div>
