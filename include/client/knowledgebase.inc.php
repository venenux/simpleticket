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
		<div class="panel panel-default">
   			<div class="panel-heading" style="background-color:#337AB7; color:#ffffff;">
    			<?php echo __('Search');?>
    		</div>
   			<div class="panel-body">
                <form action="index.php" method="get" id="kb-search">
                	<fieldset>
                    	<div class="form-group">
                  			<input type="hidden" name="a" value="search">
                  			<input class="form-control" id="query" type="text" size="20" name="q" value="<?php echo Format::htmlchars($_REQUEST['q']); ?>">
                      	</div>
                    	<div class="form-group">
                        	<select class="form-control"name="cid" id="cid">
                          		<option value=""><?php echo __('All Categories');?></option>
									<?php
                                    $sql='SELECT category_id, name, count(faq.category_id) as faqs '
                                        .' FROM '.FAQ_CATEGORY_TABLE.' cat '
                                        .' LEFT JOIN '.FAQ_TABLE.' faq USING(category_id) '
                                        .' WHERE cat.ispublic=1 AND faq.ispublished=1 '
                                        .' GROUP BY cat.category_id '
                                        .' HAVING faqs>0 '
                                        .' ORDER BY cat.name DESC ';
                                    if(($res=db_query($sql)) && db_num_rows($res)) {
                                        while($row=db_fetch_array($res))
                                            echo sprintf('<option value="%d" %s>%s (%d)</option>',
                                                    $row['category_id'],
                                                    ($_REQUEST['cid'] && $row['category_id']==$_REQUEST['cid']?'selected="selected"':''),
                                                    $row['name'],
                                                    $row['faqs']);
                                    }
                                    ?>
                      		</select>
                      	</div>
                    	<div class="form-group">    						
                        	<select class="form-control" name="topicId" id="topic-id">
                          		<option value=""><?php echo __('All Help Topics');?></option>
									<?php
                                    $sql='SELECT ht.topic_id, CONCAT_WS(" / ", pht.topic, ht.topic) as helptopic, count(faq.topic_id) as faqs '
                                        .' FROM '.TOPIC_TABLE.' ht '
                                        .' LEFT JOIN '.TOPIC_TABLE.' pht ON (pht.topic_id=ht.topic_pid) '
                                        .' LEFT JOIN '.FAQ_TOPIC_TABLE.' faq ON(faq.topic_id=ht.topic_id) '
                                        .' WHERE ht.ispublic=1 '
                                        .' GROUP BY ht.topic_id '
                                        .' HAVING faqs>0 '
                                        .' ORDER BY helptopic ';
                                    if(($res=db_query($sql)) && db_num_rows($res)) {
                                        while($row=db_fetch_array($res))
                                            echo sprintf('<option value="%d" %s>%s (%d)</option>',
                                                    $row['topic_id'],
                                                    ($_REQUEST['topicId'] && $row['topic_id']==$_REQUEST['topicId']?'selected="selected"':''),
                                                    $row['helptopic'], $row['faqs']);
                                    }
                                    ?>
                           	</select>
                      	</div>
                    	<div class="form-group">                       		
                        	<input class="btn btn-success btn-block" id="searchSubmit" type="submit" value="<?php echo __('Search');?>">
                  		</div>
                   </fieldset>
              </form>
			</div>
	  </div>
</div>    

<!-- DMT EXTENDED Right Column -->

<div class="col-md-9">
		<div class="panel panel-default">
   			<div class="panel-heading" style="background-color:#337AB7; color:#ffffff;">
    			<?php if($_REQUEST['q'] || $_REQUEST['cid'] || $_REQUEST['topicId']) {
					echo __('Search Results');
					} else {
					echo __('Knowledgebase');
					} ?>
                    
    		</div>
   			<div class="panel-body">
				<?php
                if($_REQUEST['q'] || $_REQUEST['cid'] || $_REQUEST['topicId']) { //Search.
                    $sql='SELECT faq.faq_id, question '
                        .' FROM '.FAQ_TABLE.' faq '
                        .' LEFT JOIN '.FAQ_CATEGORY_TABLE.' cat ON(cat.category_id=faq.category_id) '
                        .' LEFT JOIN '.FAQ_TOPIC_TABLE.' ft ON(ft.faq_id=faq.faq_id) '
                        .' WHERE faq.ispublished=1 AND cat.ispublic=1';
                
                    if($_REQUEST['cid'])
                        $sql.=' AND faq.category_id='.db_input($_REQUEST['cid']);
                
                    if($_REQUEST['topicId'])
                        $sql.=' AND ft.topic_id='.db_input($_REQUEST['topicId']);
                
                
                    if($_REQUEST['q']) {
                        $sql.=" AND (question LIKE ('%".db_input($_REQUEST['q'],false)."%')
                                 OR answer LIKE ('%".db_input($_REQUEST['q'],false)."%')
                                 OR keywords LIKE ('%".db_input($_REQUEST['q'],false)."%')
                                 OR cat.name LIKE ('%".db_input($_REQUEST['q'],false)."%')
                                 OR cat.description LIKE ('%".db_input($_REQUEST['q'],false)."%')
                                 )";
                    }
                
                    $sql.=' GROUP BY faq.faq_id ORDER BY question';
                
                    if(($res=db_query($sql)) && ($num=db_num_rows($res))) {
                        echo ''.sprintf(__('%d FAQs matched your search criteria.'),$num).'
							  <div>
                                <ol class="rectangle-list">';
                        while($row=db_fetch_array($res)) {
                            echo sprintf('
                                <li><a href="faq.php?id=%d" class="previewfaq">%s</a></li>',
                                $row['faq_id'],$row['question'],$row['ispublished']?__('Published'):__('Internal'));
                        }
                        echo '  </ol>
							 </div>';
                    } else {
                        echo '<strong class="faded">'.__('The search did not match any FAQs.').'</strong>';
                    }
                } else { //Category Listing.
                    $sql='SELECT cat.category_id, cat.name, cat.description, cat.ispublic, count(faq.faq_id) as faqs '
                        .' FROM '.FAQ_CATEGORY_TABLE.' cat '
                        .' LEFT JOIN '.FAQ_TABLE.' faq ON(faq.category_id=cat.category_id AND faq.ispublished=1) '
                        .' WHERE cat.ispublic=1 '
                        .' GROUP BY cat.category_id '
                        .' HAVING faqs>0 '
                        .' ORDER BY cat.name';
                    if(($res=db_query($sql)) && db_num_rows($res)) {
                        echo ''.__('Click on the category to browse FAQs.').'
                                <ol class="rectangle-list">';
                        while($row=db_fetch_array($res)) {
                
                            echo sprintf('
							<li>
								<a href="faq.php?cid=%d">%s | '.__('Thread Count').': %d</a>
							</li>',$row['category_id'],
							Format::htmlchars($row['name']),$row['faqs'],
							Format::safe_html($row['description']));

                        }
                        echo '</ol>';
                    } else {
                        echo __('NO FAQs found');
                    }
                }
                ?>
			</div>
		</div>
	</div>
</div>
