<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controller');

JSubMenuHelper::addEntry(JText::_('Manage Departments'), 'index.php?option=com_orgraph');
JSubMenuHelper::addEntry(JText::_('Manage Users'), 'index.php?option=com_orgraph&view=users');

class OrgraphController extends JController
{
	function display($cachable = false) 
	{
		JRequest::setVar('view', JRequest::getCmd('view', 'Depts'));
		parent::display($cachable);
	}
}
?>