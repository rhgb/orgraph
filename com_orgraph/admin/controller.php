<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controller');

class OrgraphController extends JController
{
	function display($cachable = false) 
	{
		JRequest::setVar('view', JRequest::getCmd('view', 'Depts'));
		parent::display($cachable);
	}
}
?>