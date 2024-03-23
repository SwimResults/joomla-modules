<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_iesc_files
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php

	$meeting = $params->get('meeting');
	$lang = $params->get('lang');

    Translate::init($lang);

    $fileJson = '{
  "dsv6": {
    "icon": "file",
    "color": "#0176bb"
  },
  "dsv7": {
    "icon": "file",
    "color": "#0176bb"
  },
  "pdf": {
    "icon": "file-pdf",
    "color": "#aa0a00"
  },
  "lxf": {
    "icon": "file",
    "color": "#5dc1f3"
  },
  "lef": {
    "icon": "file",
    "color": "#5dc1f3"
  },
  "zip": {
    "icon": "file-archive",
    "color": "#edc213"
  }
}';

    $fileIcons = json_decode($fileJson, true);
?>


<div class="file-list">
<?php

    $files = SrFiles::getFileListByMeeting($meeting);
    foreach ($files as $file) {
        if (isset($file["hidden"]) && $file["hidden"]) continue;
        if (!isset($file["url"]) && !isset($file["path"])) $file["path"] = "";
        if (!isset($file["existing"])) $file["existing"] = false;
        echo('<div class="file-tile');
        if (!$file["existing"]) echo(' file-inactive');
        echo('">');
        if (!isset($file["url"]) || $file["url"] == "") $file["url"] = "https://download.swimresults.de".$file["path"];
        if ($file["existing"]) echo('<a class="file-link" href="'.$file["url"].'" target="_blank">');

        echo('<span class="file-tile-icon">');
        
            echo('<i class="fas fa-'.$fileIcons[$file["extension"]]["icon"].'" style="color: '.$fileIcons[$file["extension"]]["color"].'"></i>');
            if ($fileIcons[$file["extension"]]["icon"] == "file") {
                echo('<span class="file-extension">');
                    echo($file["extension"]);
                echo('</span>');
            }
        echo('</span>');

        echo('<span class="file-tile-name">');
        echo(Translate::t("FILES.FILE_NAMES.".$file["name"]));
        echo('</span>');

        if ($file["existing"]) {
            if (isset($file["downloads"])) {
                echo('<span class="file-tile-badge badge">');
                echo($file["downloads"]);
                echo('</span>');
            }

            echo('<span class="btn-download">');
            echo('<i class="fas fa-download"></i>');
            echo('</span>');
        }

        if ($file["existing"]) echo('</a>');
        echo('</div>');
    }

?>
</div>
</form>
