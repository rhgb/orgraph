<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.modelitem');
class OrgraphModelUsers extends JModelItem {
	public function getTable($type = 'DeptUser', $prefix = 'OrgraphTable', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	public function getUserList(){
		$userTable=$this->getTable();
		return $userTable->loadDeptUsers();
	}
}
 ?>