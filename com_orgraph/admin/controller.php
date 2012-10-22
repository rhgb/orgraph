<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controller');

JSubMenuHelper::addEntry(JText::_('Control Panel'), 'index.php?option=com_orgraph');
JSubMenuHelper::addEntry(JText::_('Departments'), 'index.php?option=com_orgraph&view=depts');
JSubMenuHelper::addEntry(JText::_('Users'), 'index.php?option=com_orgraph&view=users');

class OrgraphController extends JController
{
	function display() 
	{
		parent::display();
	}
}
?>