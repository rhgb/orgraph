<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.modellist');
class OrgraphModelDepts extends JModelList {
	public function getTable($type = 'dept', $prefix = 'OrgraphTable', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	public function getDeptList(){
		$deptTable=$this->getTable();
		return $deptTable->loadDeptList();
	}
}
 ?>