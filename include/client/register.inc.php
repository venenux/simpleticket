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
$info = $_POST;
if (!isset($info['timezone_id']))
    $info += array(
        'timezone_id' => $cfg->getDefaultTimezoneId(),
        'dst' => $cfg->observeDaylightSaving(),
        'backend' => null,
    );
if (isset($user) && $user instanceof ClientCreateRequest) {
    $bk = $user->getBackend();
    $info = array_merge($info, array(
        'backend' => $bk::$id,
        'username' => $user->getUsername(),
    ));
}
$info = Format::htmlchars(($errors && $_POST)?$_POST:$info);

?>

<!-- DMT EXTENDED Header -->
<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header"><?php echo __('Account Registration'); ?><br />
        <small class="page-header-meta"><?php echo __('Use the forms below to create or update the information we have on file for your account'); ?></small>
        </h2>
    </div>
</div>

<!-- DMT EXTENDED Content -->
<form action="account.php" method="post" enctype="multipart/form-data">
  <?php csrf_token(); ?>
  <input type="hidden" name="do" value="<?php echo Format::htmlchars($_REQUEST['do'] ?: ($info['backend'] ? 'import' :'create')); ?>" />

<div class="row">



<!-- DMT EXTENDED Left Column -->

<div class="col-md-4">


			  <?php
    $cf = $user_form ?: UserForm::getInstance();
    $cf->render(false);
				?>


</div>
            
   <!-- DMT EXTENDED Center Column -->

<div class="col-md-4"> 
        	<div class="panel panel-default">
   				<div class="panel-heading" style="background-color:#337AB7; color:#ffffff;">
    				<?php echo __('Date').' & '. __('Time');?>
    			</div>
   				<div class="panel-body">  
                  


                <fieldset>
                	   <div class="form-group">
            			  <label for="timezone_id"><?php echo __('Time Zone') ?>:</label><br />
                          <select class="form-control" name="timezone_id" id="timezone_id">
						  <?php
                          $sql='SELECT id, offset,timezone FROM '.TIMEZONE_TABLE.' ORDER BY id';
                          if(($res=db_query($sql)) && db_num_rows($res)){
                              while(list($id,$offset, $tz)=db_fetch_row($res)){
                                  $sel=($info['timezone_id']==$id)?'selected="selected"':'';
                                  echo sprintf('<option value="%d" %s>GMT %s - %s</option>',$id,$sel,$offset,$tz);
                              }
                          }
                          ?>
                      	  </select>
                      </div>
                	  <div class="form-group">
        				<label for="daylightsaving"><?php echo __('Daylight Saving') ?>:</label><br />
				        <input id="daylightsaving" type="checkbox" name="dst" value="1" <?php echo $info['dst']?'checked="checked"':''; ?>>
						  <?php echo __('Observe daylight saving'); ?><br />
 						  <?php echo __('Current Time'); ?>: <?php echo Format::date($cfg->getDateTimeFormat(),Misc::gmtime(),$info['tz_offset'],$info['dst']); ?>
                      </div>
                </fieldset>
            </div>
         </div>         
</div>

   <!-- DMT EXTENDED Right Column -->
<div class="col-md-4"> 

        	<div class="panel panel-default">
   				<div class="panel-heading" style="background-color:#337AB7; color:#ffffff;">
    				<?php echo __('Access Credentials'); ?>
    			</div>
   				<div class="panel-body">  
                <fieldset>
                		<?php if ($info['backend']) { ?>
        					<?php echo __('Login With'); ?>:
        						<input type="hidden" name="backend" value="<?php echo $info['backend']; ?>"/>
        						<input type="hidden" name="username" value="<?php echo $info['username']; ?>"/>
								<?php foreach (UserAuthenticationBackend::allRegistered() as $bk) {
    								if ($bk::$id == $info['backend']) {
        							echo $bk->getName();
        							break;
    								}
								} ?>
                        <?php } else { ?>
						<div class="form-group">
							<label for="passwd1"><?php echo __('Create a Password'); ?>:</label><br />
					        <input class="form-control" id="passwd1" type="password" size="18" name="passwd1" value="<?php echo $info['passwd1']; ?>">
        					&nbsp;<span class="error">&nbsp;<?php echo $errors['passwd1']; ?></span>
                       </div>
                       <div class="form-group">
							<label for="passwd2"><?php echo __('Confirm Password'); ?>:</label><br />
					        <input class="form-control" id="passwd2" type="password" size="18" name="passwd2" value="<?php echo $info['passwd2']; ?>">
        					&nbsp;<span class="error">&nbsp;<?php echo $errors['passwd2']; ?></span>
                       </div>
        			   <?php } ?>
               </fieldset>

			</div>
          </div>

</div>
</div>
<hr>
<div class="row">
	<div class="col-lg-12" style="text-align: center;">
    <input class="btn btn-success" type="submit" value="<?php echo __('Register'); ?>"/>
    <input class="btn btn-warning" type="reset" value="<?php echo __('Reset');?>"/>
    <input class="btn btn-danger" type="button" value="<?php echo __('Cancel'); ?>" onclick="javascript:
        window.location.href='index.php';"/>
	</div>
</div>
</form>

</div>




