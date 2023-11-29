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
?>

<form action="<?php echo($download_url); ?>" method="get" target="_blank">
<div class="file-list">
<?php

    $files = mysqli_query($db, "SELECT e.extension, e.color, e.icon, f.id, f.name, f.path, f.downloads, f.active FROM files f JOIN file_extensions e ON e.id = f.fk_extension_id WHERE f.fk_meeting_edition_id = $current_meeting AND f.visible = 1 ORDER BY f.ordering");
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