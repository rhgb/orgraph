<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.modelitem');
class OrgraphModelMain extends JModelItem
{
	public function getTable($type='OrgraphDept', $prefix='Table', $config='') {
		return JTable::getInstance($type,$prefix,$config);
	}
	
	public function getDeptTree() {
		$deptTable = $this->getTable();
		return $deptTable->loadDeptTree();
	}
	
	public function getDeptUsers($deptId=null) {
		$userTable = $this->getTable('OrgraphUser');
		return $userTable->loadUsers($deptId);
	}
}
?>