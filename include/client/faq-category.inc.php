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
if(!defined('OSTCLIENTINC') || !$category || !$category->isPublic()) die('Access Denied');
?>
<!-- DMT EXTENDED Header -->
<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header"><?php echo __('Frequently Asked Questions');?></a>
		</h2> 
	</div>
</div>
<!-- DMT EXTENDED Content -->

<div class="row">

<!-- DMT EXTENDED Left Column -->

<div class="col-md-3">

            	<?php
                          
                         $sql='SELECT cat.category_id, cat.name, cat.description, cat.ispublic, count(faq.faq_id) as faqs '
                        .' FROM '.FAQ_CATEGORY_TABLE.' cat '
                        .' LEFT JOIN '.FAQ_TABLE.' faq ON(faq.category_id=cat.category_id AND faq.ispublished=1) '
                        .' WHERE cat.ispublic=1 '
                        .' GROUP BY cat.category_id '
                        .' HAVING faqs>0 '
                        .' ORDER BY cat.name';
                    if(($res=db_query($sql)) && db_num_rows($res)) {
                        echo '<ul class="list-group">';
						echo '<li class="list-group-item active">';
						echo ''.__('FAQ Categories').'';
						echo '</li>';
                        while($row=db_fetch_array($res)) {
                
                            echo sprintf('
							<li class="list-group-item">
								<a href="faq.php?cid=%d">%s [%d]</a>
							</li>',$row['category_id'],
							Format::htmlchars($row['name']),$row['faqs'],
							Format::safe_html($row['description']));

                        }
                        echo '</ul>';
                    } else {
                        echo __('NO FAQs found');
                    }
                ?>

</div>

<!-- DMT EXTENDED Right Column -->

<div class="col-md-9">
		<div class="panel panel-default">
   			<div class="panel-heading" style="background-color:#337AB7; color:#ffffff;">
    			
                	<?php echo $category->getName() ?>
                
    		</div>
   			<div class="panel-body">
            
			  <?php echo Format::safe_html($category->getDescription()); ?>
              <hr>
              <?php
              $sql='SELECT faq.faq_id, question, count(attach.file_id) as attachments '
                  .' FROM '.FAQ_TABLE.' faq '
                  .' LEFT JOIN '.ATTACHMENT_TABLE.' attach
                       ON(attach.object_id=faq.faq_id AND attach.type=\'F\' AND attach.inline = 0) '
                  .' WHERE faq.ispublished=1 AND faq.category_id='.db_input($category->getId())
                  .' GROUP BY faq.faq_id '
                  .' ORDER BY question';
              if(($res=db_query($sql)) && db_num_rows($res)) {
                  echo '
                          <ol class="rectangle-list">';
                  while($row=db_fetch_array($res)) {
                      $attachments=$row['attachments']?'<span class="Icon file"></span>':'';
                      echo sprintf('
                          <li><a href="faq.php?id=%d" >%s &nbsp;%s</a></li>',
                          $row['faq_id'],Format::htmlchars($row['question']), $attachments);
                  }
                  echo '  </ol>';
              }else {
                  echo '<strong>'.__('This category does not have any FAQs.').' <a href="index.php">'.__('Back To Index').'</a></strong>';
              }
              ?>
		   </div>
</div>
</div>
</div>