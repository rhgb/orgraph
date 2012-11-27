<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.modelitem');
class OrgraphModelUserDetail extends JModelItem
{
	public function getTable($type='OrgraphUser', $prefix='Table', $config='') {
		return JTable::getInstance($type,$prefix,$config);
	}
	
	public function getUser($userId) {
		if(!is_numeric($userId) || empty($userId)) return false;	// must define user id
		$userTable = $this->getTable();
		$list = $userTable->loadUsers(null, $userId);
		if(count($list)) {
			$list[0]->projlist = $userTable->loadUserProj($userId);
			return $list[0];
		}
		else return null;
	}
}
?>