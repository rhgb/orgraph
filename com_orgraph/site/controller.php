<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controller');
class OrgraphController extends JController
{
	function display($tpl=null){
		$document = &JFactory::getDocument();
		$document->addScript(JRoute::_('components/com_orgraph/js/jquery.min.js'));
		parent::display($tpl);
	}
	function listDeptTree(){
		$app = &JFactory::getApplication();
		$model=$this->getModel('main');
		$tree=$model->getDeptTree();
		echo json_encode($tree);
		$app->close();
	}
	function listDeptUsers(){
		$app = &JFactory::getApplication();
		$deptId=JRequest::getVar('dept_id');
		$model=$this->getModel('main');
		$users=$model->getDeptUsers($deptId);
		echo json_encode($users);
		$app->close();
	}
}
?>