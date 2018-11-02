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
if(!defined('OSTCLIENTINC') || !$faq  || !$faq->isPublished()) die('Access Denied');

$category=$faq->getCategory();

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
    			
                	<a href="index.php"><?php echo __('All Categories');?></a>
                  	> <a href="faq.php?cid=<?php echo $category->getId(); ?>"><?php echo $category->getName(); ?></a>
                    > <?php echo $faq->getQuestion() ?>
                
    		</div>
   			<div class="panel-body">
              <?php echo Format::safe_html($faq->getAnswerWithImages()); ?>
              <?php
              if($faq->getNumAttachments()) { ?>
               <hr>
               <div><span class="faded"><b><?php echo __('Attachments');?>:</b></span>  <?php echo $faq->getAttachmentsLinks(); ?></div>
              <?php
              } ?>
              <hr />
              <div class="article-meta"><span class="faded"><b><?php echo __('Help Topics');?>:</b></span>
                  <?php echo ($topics=$faq->getHelpTopics())?implode(', ',$topics):' '; ?>
              </div>
              <hr>
              <div class="faded">&nbsp;<?php echo __('Last updated').' '.Format::db_daydatetime($category->getUpdateDate()); ?></div>
		   </div>
</div>
</div>
</div>