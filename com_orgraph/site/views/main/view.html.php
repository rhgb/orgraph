<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');
class OrgraphViewMain extends JView
{
	function display($tpl = null)
	{
		$this->tree = $this->get('DeptTree');
		if(count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		parent::display($tpl);
	}
}
 ?>