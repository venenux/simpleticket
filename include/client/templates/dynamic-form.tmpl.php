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
    // Form headline and deck with a horizontal divider above and an extra
    // space below.
    // XXX: Would be nice to handle the decoration with a CSS class
    ?>
    <div class="panel panel-default">
   			<div class="panel-heading" style="background-color:#337AB7; color:#ffffff;">
    			<?php echo Format::htmlchars($form->getTitle()); ?>
    		</div>
   			<div class="panel-body">
   				<blockquote><?php echo Format::htmlchars($form->getInstructions()); ?></blockquote>

    <?php
    // Form fields, each with corresponding errors follows. Fields marked
    // 'private' are not included in the output for clients
    global $thisclient;
    foreach ($form->getFields() as $field) {
        if (!$field->isVisibleToUsers())
            continue;
        ?>
       	<fieldset>

            <?php if ($field->isBlockLevel()) { ?>
            <?php
            }
            else { ?>
                <label for="<?php echo $field->getFormName(); ?>" class="<?php
                    if ($field->get('required')) echo 'required'; ?>">
                <?php echo Format::htmlchars($field->get('label')); ?>:</label><br />
            <?php
            }
            $field->render('client'); ?>
            <?php if ($field->get('required')) { ?>
                <br /><span class="bg-danger small">* <?php echo __('Required'); ?></span>
            <?php
            }
            if ($field->get('hint') && !$field->isBlockLevel()) { ?>
                <br /><span class="bg-info small"><?php
                    echo Format::htmlchars($field->get('hint')); ?></span>
            <?php
            }
            foreach ($field->errors() as $e) { ?>
                <br />
                <font class="error"><?php echo $e; ?></font>
            <?php }
            $field->renderExtras('client');
            ?>
         </fieldset>
        <?php
    }
?>
</div>
</div>
