<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_sr_files
 *
 * @copyright   Copyright (C) 2005 - 2023 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once("api.php");
require_once("translate.php");

/**
 * Helper for mod_sr_files
 *
 * @since  1.0
 */
class SrFiles
{
    private static string $API_URL = "https://api.swimresults.de/meeting/v1/";
    public static function getFileListByMeeting($meeting) {
        if (!self::$API_URL) return array();
        $data = Api::get(self::$API_URL, "/file/meeting/list/".$meeting);
        if ($data) {
            return $data;
        }
        return array();
    }
}
