<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.modellist');
class OrgraphModelUsers extends JModelList {
	public function getTable($type = 'OrgraphUser', $prefix = 'Table', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	public function getUserList(){
		$userTable=$this->getTable();
		return $userTable->loadUsers();
	}
}
 ?>