<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
if (!JFactory::getUser()->authorise('core.manage', 'com_orgraph')) {
        return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}
// import joomla controller library
jimport('joomla.application.component.controller');

// Get an instance of the controller prefixed by HelloWorld
$controller = JController::getInstance('Orgraph');
 
// Perform the Request task
$controller->execute(JRequest::getCmd('task'));
 
// Redirect if set by the controller
$controller->redirect();
?>