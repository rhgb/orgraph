<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');
class OrgraphViewUserDetail extends JView
{
	function display($tpl = null)
	{
		$userId = JRequest::getVar('id');
		$model = $this->getModel();
		$this->user = $model->getUser($userId);
		if(is_null($this->user)) throw new InvalidArgumentException('Invalid user id');
		if(count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		parent::display($tpl);
	}
}
?>