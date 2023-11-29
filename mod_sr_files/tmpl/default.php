<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_iesc_files
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<?php
	$meeting = $params->get('meeting');
	$lang = $params->get('lang');

    T::init($lang);

    T::e("TEST.EXAMPLE");
?>


<div class="file-list">
<?php

    $files = SrFiles::getFileListByMeeting($meeting);
    foreach ($files as $file) {
        echo('<div class="file-tile');
        if (!$file["active"]) echo(' file-inactive');
        echo('">');
        if ($file["active"]) echo('<a class="file-link" href="'.$download_url.'?f='.$file["id"].'" target="_blank">');

        echo('<span class="file-tile-icon">');
        
            echo('<i class="fas fa-'.$file["icon"].'" style="color: #'.$file["color"].'"></i>');
            if ($file["icon"] == "file") {
                echo('<span class="file-extension">');
                    echo($file["extension"]);
                echo('</span>');
            }
        echo('</span>');

        echo('<span class="file-tile-name">');
        echo($file["name"]);
        echo('</span>');

        if ($file["active"]) {
            echo('<span class="file-tile-badge badge">');
            echo($file["downloads"]);
            echo('</span>');

            echo('<span class="btn-download" name="f" value="'.$file["id"].'">');
            echo('<i class="fas fa-download"></i>');
            echo('</span>');
        }

        if ($file["active"]) echo('</a>');
        echo('</div>');
    }

?>
</div>
</form>