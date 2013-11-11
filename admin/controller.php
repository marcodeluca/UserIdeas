<?php
/**
 * @package      UserIdeas
 * @subpackage   Component
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2013 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die;

jimport( 'joomla.application.component.controller' );

/**
 * Default controller
 *
 * @package		UserIdeas
 * @subpackage	Component
  */
class UserIdeasController extends JControllerLegacy {
    
	public function display( ) {

        $viewName      = $this->input->getCmd('view', 'dashboard');
        $this->input->set("view", $viewName);

        parent::display();
        return $this;
        
	}

}