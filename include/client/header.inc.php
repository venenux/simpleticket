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
$title=($cfg && is_object($cfg) && $cfg->getTitle())
    ? $cfg->getTitle() : 'osTicket :: '.__('Support Ticket System');
$signin_url = ROOT_PATH . "login.php"
    . ($thisclient ? "?e=".urlencode($thisclient->getEmail()) : "");
$signout_url = ROOT_PATH . "logout.php?auth=".$ost->getLinkToken();

header("Content-Type: text/html; charset=UTF-8");
?>
<!DOCTYPE html>
<html <?php
if (($lang = Internationalization::getCurrentLanguage())
        && ($info = Internationalization::getLanguageInfo($lang))
        && (@$info['direction'] == 'rtl'))
    echo 'dir="rtl" class="rtl"';
	$language = Internationalization::getCurrentLanguage();
?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo Format::htmlchars($title); ?></title>
    <meta name="description" content="customer support platform">
    <meta name="keywords" content="osTicket, Customer support system, support ticket system">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<!-- DMT REMOVED 

    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/flags.css?19292ad"/>
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/font-awesome.min.css?19292ad"/>
     <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>css/theme.css?19292ad" media="screen"/>
    -->
    
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/filedrop.css?19292ad" media="screen"/>
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/osticket.css?19292ad" media="screen"/>
    <link rel="stylesheet" href="<?php echo ASSETS_PATH; ?>css/print.css?19292ad" media="print"/>
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>scp/css/typeahead.css?19292ad" media="screen" />
    <link type="text/css" href="<?php echo ROOT_PATH; ?>css/ui-lightness/jquery-ui-1.10.3.custom.min.css?19292ad" rel="stylesheet" media="screen" />
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/thread.css?19292ad" media="screen"/>
    <link type="text/css" rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/rtl.css?19292ad"/>
    <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>css/redactor.css?19292ad" media="screen"/>



    <!-- DMT EXTENDED CSS Start -->
    <link href="<?php echo ROOT_PATH; ?>ext_css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ROOT_PATH; ?>ext_css/bootstrap-dialog.css" rel="stylesheet">
    <link href="<?php echo ROOT_PATH; ?>ext_css/ext_base.css" rel="stylesheet">
    <link href="<?php echo ROOT_PATH; ?>ext_font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- DMT EXTENDED CSS End -->
    
    <!-- DMT EXTENDED JS Start -->
    <script src="<?php echo ROOT_PATH; ?>ext_js/jquery.js"></script>
    <script src="<?php echo ROOT_PATH; ?>ext_js/bootstrap.min.js"></script>
    <script src="<?php echo ROOT_PATH; ?>ext_js/bootstrap-dialog.js"></script>
    <!-- DMT EXTENDED JS Start -->
    
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery-1.8.3.min.js?19292ad"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery-ui-1.10.3.custom.min.js?19292ad"></script>
    <script src="<?php echo ROOT_PATH; ?>scp/js/bootstrap-typeahead.js?19292ad"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/jquery.multiselect.min.js?19292ad"></script>
    <script src="<?php echo ROOT_PATH; ?>js/osticket.js?19292ad"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/filedrop.field.js?19292ad"></script>  
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor.min.js?19292ad"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor-osticket.js?19292ad"></script>
    <script type="text/javascript" src="<?php echo ROOT_PATH; ?>js/redactor-fonts.js?19292ad"></script>
    <?php
    if($ost && ($headers=$ost->getExtraHeaders())) {
        echo "\n\t".implode("\n\t", $headers)."\n";
    }
    ?>
</head>

<body>
         
<!-- DMT EXTENDED Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    	<div class="branding">
        	<div class="container branding-logo">
        		<a id="logo" href="<?php echo ROOT_PATH; ?>index.php" title="<?php echo __('Support Center'); ?>">
           			<img src="<?php echo ROOT_PATH; ?>logo.php" border=0 alt="<?php echo $ost->getConfig()->getTitle(); ?>">
        		</a>
        	</div>
        </div>
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                    <span class="sr-only">Navigation ON|OFF</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand hidden-sm" href="index.php"><?php echo $ost->getConfig()->getTitle(); ?></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <?php
            			if($nav && ($navs=$nav->getNavLinks()) && is_array($navs)){
                		foreach($navs as $name =>$nav) {
                    	echo sprintf('<li><a class="%s %s" href="%s">%s</a></li>%s',$nav['active']?'active':'',$name,(ROOT_PATH.$nav['href']),$nav['desc'],"\n");
                		}
            		} ?>
                    
                    <?php $links = Page::getActiveOtherPages(); 
						  if (count($links) >= 1){?>
                        <li class="dropdown">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo __('Info'); ?><b class="caret"></b></a>
                         	<ul class="dropdown-menu">
								<?php  foreach ($links as $link) {?>
                                    <?php 
										$linkURL = $link->getName();
										$linkURL = preg_replace('~[^\\pL\d]+~u', '-', $linkURL);
										$linkURL = trim($linkURL, '-');
										if (function_exists('iconv')){$linkURL = iconv('utf-8', 'us-ascii//TRANSLIT', $linkURL);}
										$linkURL = strtolower($linkURL);
										$linkURL = preg_replace('~[^-\w]+~', '', $linkURL);									
									?>
									<li>							    		
                                       <a href="<?php echo ROOT_PATH; ?>pages/<?php echo $linkURL; ?>"><?php echo $link->getName(); ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    
                    <?php
					if (($all_langs = Internationalization::availableLanguages())
   						 && (count($all_langs) > 1)
						) {?>
                            <li class="dropdown">
                 				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo __('Language')?><b class="caret"></b></a>
                         			<ul class="dropdown-menu dropdown-menu-language">
                                        <li class="text-center"><a href="<?php echo ROOT_PATH; ?>/ext_languages.php"><?php echo __('Important')?> <?php echo __('Info')?></a></li>
                                        <li role="separator" class="divider"></li>
                                        <ul class="list-inline">
                            			<?php foreach ($all_langs as $code=>$info) {
       						 			list($lang, $locale) = explode('_', $code); ?>
                              				<li>
        										<a href="?<?php echo urlencode($_GET['QUERY_STRING']); ?>&amp;lang=<?php echo $code;?>" style="text-transform: uppercase;" title="<?php echo Internationalization::getLanguageDescription($code); ?>"><img width="24px" height="24px" src="<?php echo ROOT_PATH; ?>ext_images/flags/<?php echo Internationalization::getLanguageDescription($locale); ?>.png"></a>
                    						</li>
										<?php }?>
                                        </ul>
                                    </ul>
                           </li>
					<?php } ?>
                                
                    <?php
                	if ($thisclient && is_object($thisclient) && $thisclient->isValid()&& !$thisclient->isGuest()) {?>
                 	<li class="dropdown">
                 		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo Format::htmlchars($thisclient->getName());?><b class="caret"></b></a>
                         	<ul class="dropdown-menu">
                            	<li>
               						 <a href="<?php echo ROOT_PATH; ?>profile.php"><?php echo __('Profile'); ?></a>
                                </li>
                            	<li>
                					<a href="<?php echo ROOT_PATH; ?>tickets.php"><?php echo sprintf(__('Tickets <b>(%d)</b>'), $thisclient->getNumTickets()); ?></a>
                                </li>
                            	<li>
 					                <a href="<?php echo $signout_url; ?>"><?php echo __('Sign Out'); ?></a>
                                </li>
                        	</ul>
                  	</li>
            		<?php
            		} elseif($nav) {
                		if ($thisclient && $thisclient->isValid() && $thisclient->isGuest()) { ?>
                    	<li><a href="<?php echo $signout_url; ?>"><?php echo __('Sign Out'); ?></a></li><?php
                		}
                		elseif ($cfg->getClientRegistrationMode() != 'disabled') { ?>
                    	<li><a href="<?php echo $signin_url; ?>"><?php echo __('Sign In'); ?></li></a>
					<?php
                		}
            		} ?>
                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

 <!-- DMT EXTENDED Main Container Start -->    
    <div class="page-wrapper"> 


 <!-- DMT EXTENDED Content Start -->    
    <div class="container content">     

         <?php if($errors['err']) { ?>
            <div class="alert alert-danger alert-dismissible text-center spacer-top" role="alert" id="msg_error"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><?php echo $errors['err']; ?></h4></div>
         <?php }elseif($msg) { ?>
            <div class="alert alert-info alert-dismissible text-center spacer-top" role="alert" id="msg_notice"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><?php echo $msg; ?></h4></div>
         <?php }elseif($warn) { ?>
            <div class="alert alert-warning alert-dismissible text-center spacer-top" role="alert" id="msg_warning"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4><?php echo $warn; ?></h4></div>
         <?php } ?>