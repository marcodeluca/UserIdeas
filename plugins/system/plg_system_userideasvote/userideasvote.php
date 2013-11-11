<?php
/**
 * @package      UserIdeas
 * @subpackage   Plugins
 * @author       Todor Iliev
 * @copyright    Copyright (C) 2013 Todor Iliev <todor@itprism.com>. All rights reserved.
 * @license      http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.helper');
jimport('joomla.plugin.plugin');

/**
* This plugin initializes the job of the button
* which is used for voting.
*
* @package 		UserIdeas
* @subpackage	Plugins
*/
class plgSystemUserIdeasVote extends JPlugin {
	
	/**
	 * Put tags into the HEAD tag
	 */
	public function onBeforeCompileHead() {
	    
	    $app = JFactory::getApplication();
        /** @var $app JSite **/

        if($app->isAdmin()) {
            return;
        }
        
        $document = JFactory::getDocument();
        /** @var $document JDocumentHTML **/
        
        $type = $document->getType();
        if(strcmp("html",$type) != 0) {
             return;   
        }
        
        // Check component enabled
	    if (!JComponentHelper::isEnabled('com_userideas', true)) {
            return;
        }

        // Check for view. The extensions will work only on view "items"
        $allowedViews = array("items", "details", "category");
        $view         = $app->input->getCmd("view");
        if(!in_array($view, $allowedViews)) {
            return;
        }
        
        JHtml::_('itprism.ui.joomla_helper');
        
        $document->addScript('plugins/system/userideasvote/votebutton.js');
        
	}
	
}