<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_sr_files
 *
 * @copyright   Copyright (C) 2005 - 2023 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JLoader::register('SrFiles', __DIR__ . '/helper.php');
JLoader::register('Translate', __DIR__ . '/translate.php');
JLoader::register('Api', __DIR__ . '/api.php');

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

require JModuleHelper::getLayoutPath('mod_sr_files', $params->get('layout', 'default'));
