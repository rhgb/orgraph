<?php 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelform library
jimport('joomla.application.component.modeladmin');

class OrgraphModelProj extends JModelAdmin {
	public function getTable($type = 'OrgraphProj', $prefix = 'Table', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	public function getForm($data = array(), $loadData = true) {
		$form = $this->loadForm('com_orgraph.proj', 'proj',
			array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form))
		{
			return false;
		}
		return $form;
	}
	protected function loadFormData() 
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_orgraph.edit.proj.data', array());
		if (empty($data)) 
		{
			$data = $this->getItem();
		}
		return $data;
	}
	public function getProjTreeList() {
		$projTable=$this->getTable();
		$tree = $projTable->loadProjTree();
		function expandTree($node, $level) {
			$node->level=$level;
			$chlist=$node->children;
			unset($node->children);
			$list=array($node);
			if(!empty($chlist)){
				foreach ($chlist as $d) {
					$list = array_merge($list, expandTree($d, $level+1));
				}
			}
			return $list;
		}
		$treelist=array();
		foreach ($tree as $d) {
			$treelist = array_merge($treelist, expandTree($d, 0));
		}
		return $treelist;
	}
	public function getCurrentParentId() {
		return $this->loadFormData()->parent_id;
	}
	public function getCurrentId() {
		return $this->loadFormData()->id;
	}
}
 ?>