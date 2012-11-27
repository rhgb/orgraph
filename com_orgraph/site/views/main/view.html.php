<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');
class OrgraphViewMain extends JView
{
	function display($tpl = null)
	{
		$this->series = JRequest::getVar('series');
		if($this->series != 'proj')
			$this->series = 'dept';
		$this->tree = $this->get($this->series.'Tree');
		if(count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		parent::display($tpl);
	}
}
?>