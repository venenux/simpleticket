<?php
/*********************************************************************
    pages/index.php

    Custom pages servlet

    Peter Rotich <peter@osticket.com>
    Jared Hancock <jared@osticket.com>
    Copyright (c)  2006-2013 osTicket
    http://www.osticket.com

    Released under the GNU General Public License WITHOUT ANY WARRANTY.
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

@chdir(dirname(__file__).'/../');

require_once('client.inc.php');
require_once(INCLUDE_DIR.'class.format.php');
require_once(INCLUDE_DIR.'class.page.php');

// Determine the requested page
// - Strip extension
$slug = Format::slugify($ost->get_path_info());

// Get the part before the first dash
$first_word = explode('-', $slug);
$first_word = $first_word[0];

$sql = 'SELECT id, name FROM '.PAGE_TABLE
    .' WHERE name LIKE '.db_input("$first_word%");
$page_id = null;

$res = db_query($sql);
while (list($id, $name) = db_fetch_row($res)) {
    if (Format::slugify($name) == $slug) {
        $page_id = $id;
        break;
    }
}

if (!$page_id || !($page = Page::lookup($page_id)))
    Http::response(404, __('Page Not Found'));



require(CLIENTINC_DIR.'header.inc.php');
?>

<!-- DMT EXTENDED Header -->
<div class="row">
	<div class="col-lg-12">
		<h2 class="page-header"><?php echo $page->getName() ?></h2> 
  		<?php print $page->getBodyWithImages(); ?>
	</div>
</div>

<?php
require(CLIENTINC_DIR.'footer.inc.php');
?>
