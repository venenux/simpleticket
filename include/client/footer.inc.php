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
        </div> <!-- DMT EXTENDED Content End -->

        <!-- DMT EXTENDED Footer -->
        
        <div class="container footer">
        <footer class="branding-footer">

        			<!-- DMT EXTENDED Navbar for footer pages  -->
                    <?php $footerpages = Page::getActiveFooterPages(); 
						  if (count($footerpages) >= 1){?>
								<ul class="list-inline">
									<?php foreach ($footerpages as $footerpage) {?>
                                    <?php 
										$footerpageURL = $footerpage->getName();
										$footerpageURL = preg_replace('~[^\\pL\d]+~u', '-', $footerpageURL);
										$footerpageURL = trim($footerpageURL, '-');
										if (function_exists('iconv')){$footerpageURL = iconv('utf-8', 'us-ascii//TRANSLIT', $footerpageURL);}
										$footerpageURL = strtolower($footerpageURL);
										$footerpageURL = preg_replace('~[^-\w]+~', '', $footerpageURL);									
									?>
                                       <li><a class="btn btn-primary btn-xs" role="button" href="<?php echo ROOT_PATH; ?>pages/<?php echo $footerpageURL; ?>"><?php echo $footerpage->getName(); ?></a></li>
                                <?php } ?>
                        		</ul>
                    <?php } ?>
        			<p class="branding-footer-info">Copyright &copy; <?php echo date('Y'); ?> <?php echo (string) $ost->company ?: 'osTicket.com'; ?><br />
        			<a id="poweredBy" href="http://osticket.com" target="_blank"><?php echo 'Powered by simpleticket'; ?></a></p>

        </footer>
        </div>

</div> <!-- DMT EXTENDED Main Container End -->
    
        
<div id="overlay"></div>
<div id="loading">
    <?php echo __('Please Wait!');?>
    <p><?php echo __('Please wait... it will take a second!');?></p>
</div>
<?php
if (($lang = Internationalization::getCurrentLanguage()) && $lang != 'en_US') { ?>
    <script type="text/javascript" src="ajax.php/i18n/<?php
        echo $lang; ?>/js"></script>
<?php } ?>
<script type="text/javascript">
        $('input[type=text],input[type=password],input[type=search],input[type=email],input[type=tel],select').addClass('form-control');
</script> 
</body>
</html>

