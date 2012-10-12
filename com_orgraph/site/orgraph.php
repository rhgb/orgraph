<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controller');
$controller = JController::getInstance('Orgraph');
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));
$controller->redirect();
 ?>