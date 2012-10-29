<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controller');

JSubMenuHelper::addEntry(JText::_('COM_ORGRAPH_MANAGE_DEPARTMENTS'), 'index.php?option=com_orgraph');
JSubMenuHelper::addEntry(JText::_('COM_ORGRAPH_MANAGE_MEMBERS'), 'index.php?option=com_orgraph&view=users');

class OrgraphController extends JController
{
	function display($cachable = false) 
	{
		JRequest::setVar('view', JRequest::getCmd('view', 'Depts'));
		parent::display($cachable);
	}
}
?>