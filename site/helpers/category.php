<?php
/**
 * @package      UserIdeas
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2013 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * UserIdeas is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

defined('_JEXEC') or die;
jimport('joomla.application.categories');

class UserIdeasCategories extends JCategories {
    
	public function __construct($options = array()) {
		$options['table']     = '#__uideas_items';
		$options['extension'] = 'com_userideas';
		parent::__construct($options);
	}
	
}