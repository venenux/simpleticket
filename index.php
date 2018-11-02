<?php
/*********************************************************************
    index.php

    Helpdesk landing page. Please customize it to fit your needs.

    Peter Rotich <peter@osticket.com>
    Copyright (c)  2006-2013 osTicket
    http://www.osticket.com

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
    See LICENSE.TXT for details.

    vim: expandtab sw=4 ts=4 sts=4:
	
**********************************************************************/

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


require('client.inc.php');
$section = 'home';
require(CLIENTINC_DIR.'header.inc.php');
?>
<!-- OS Ticket Landing Page -->    
<div id="landing_page">
    <!-- OS Ticket Sections -->
        <div class="row">
            <div class="container">
            	<div class="panel panel-default banner hidden-xs">
                	<div class="panel-body text-center">
                        <?php
    					if($cfg && ($page = $cfg->getLandingPage()))
        				echo $page->getBodyWithImages();
    					else
        				echo  '<h1 class="page-header">'.__('Welcome to the Support Center').'</h1>';
   						 ?>
                   </div>
                </div>
                <div class="panel panel-default banner visible-xs">
                	<div class="panel-body">
                        <?php echo '<h2>'.__('Welcome to the Support Center').'</h2>'; ?>
                   </div>
                </div>
            </div>
         <!-- /.row -->
        </div>
            
<!-- DMT EXTENDED HOMEPAGE IF KNOWLEDGEBASE ENABLED -->
            <?php
			if($cfg && $cfg->isKnowledgebaseEnabled()){ //FIXME: provide ability to feature or select random FAQs ??
			?>
			<div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <div class="center-block"><i class="fa fa-fw fa-4x fa-cog" style="color:#337AB7"></i></div>
						<h4><?php echo __('Open a New Ticket');?></h4>
                        <p style="min-height: 80px;"><?php echo __('Please provide as much detail as possible so we can best assist you. To update a previously submitted ticket, please login.');?></p>
                        <a href="open.php" class="btn btn-primary"><?php echo __('Open a New Ticket');?></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                    	<div class="center-block"><i class="fa fa-fw fa-4x fa-refresh" style="color:#337AB7"></i></div>
                    	<h4><?php echo __('Check Ticket Status');?></h4>
                        <p style="min-height: 80px;"><?php echo __('We provide archives and history of all your current and past support requests complete with responses.');?></p>
                        <a href="<?php if(is_object($thisclient)){ echo 'tickets.php';} else {echo 'view.php';}?>" class="btn btn-primary"><?php echo __('Check Ticket Status');?></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <div class="center-block"><i class="fa fa-fw fa-4x fa-question-circle" style="color:#337AB7"></i></div>
						<h4><?php echo __('Frequently Asked Questions'); ?></h4>
                        <p style="min-height: 80px;"><?php echo sprintf(
    __('Be sure to browse our %s before opening a ticket'),
    sprintf(__('Frequently Asked Questions')
    )); ?></p>
                        <a href="kb/index.php" class="btn btn-primary"><?php echo __('Search');?></a>
                    </div>
                </div>
            </div>
        <!-- /.row -->
        </div>
<?php
} else {?>

<!-- DMT EXTENDED HOMEPAGE IF KNOWLEDGEBASE DISABLED -->

			<div class="row">
			<div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <div class="center-block"><i class="fa fa-fw fa-4x fa-check" style="color:#337AB7"></i></div>
						<h4><?php echo __('Open a New Ticket');?></h4>
                        <p style="min-height: 80px;"><?php echo __('Please provide as much detail as possible so we can best assist you. To update a previously submitted ticket, please login.');?></p>
                        <a href="open.php" class="btn btn-primary"><?php echo __('Open a New Ticket');?></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                    	<div class="center-block"><i class="fa fa-fw fa-4x fa-gift" style="color:#337AB7"></i></div>
                    	<h4><?php echo __('Check Ticket Status');?></h4>
                        <p style="min-height: 80px;"><?php echo __('We provide archives and history of all your current and past support requests complete with responses.');?></p>
                        <a href="<?php if(is_object($thisclient)){ echo 'tickets.php';} else {echo 'view.php';}?>" class="btn btn-primary"><?php echo __('Check Ticket Status');?></a>
                    </div>
                </div>
            </div>
        <!-- /.row -->
            </div>
           <?php
}?>
<!-- DMT EXTENDED -->

</div>

<?php require(CLIENTINC_DIR.'footer.inc.php'); ?>
