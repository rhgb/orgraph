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
	function listUsers(){
		$app = &JFactory::getApplication();
		$id = JRequest::getVar('id');
		$series = JRequest::getVar('series');
		$model=$this->getModel('main');
		switch ($series) {
			case 'proj':
				$users = $model->getProjUsers($id);
				break;
			case 'dept':
			default:
				$users = $model->getDeptUsers($id);
				break;
		}
		echo json_encode($users);
		$app->close();
	}
}
?>