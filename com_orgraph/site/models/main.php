<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.modelitem');
class OrgraphModelMain extends JModelItem
{
	public function getTable($type='OrgraphDept', $prefix='Table', $config='') {
		return JTable::getInstance($type,$prefix,$config);
	}
	
	public function getDeptTree() {
		$table = $this->getTable();
		return $table->loadDeptTree();
	}

	public function getProjTree() {
		$table = $this->getTable('OrgraphProj');
		return $table->loadProjTree();
	}
	
	public function getDeptUsers($id=null) {
		$table = $this->getTable('OrgraphUser');
		return $table->loadUsers($id);
	}

	public function getProjUsers($id=null) {
		$table = $this->getTable('OrgraphUser');
		return $table->loadProjUsers($id);
	}
}
?>