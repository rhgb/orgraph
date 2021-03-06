<?php
defined('JPATH_BASE') or die;

JFormHelper::loadFieldClass('list');

class JFormFieldUserDeptList extends JFormFieldList
{
	protected $type = 'userdeptlist';

	public function getTable($type = 'OrgraphDept', $prefix = 'Table', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	function expandTree($node, $level) {
		$node->level=$level;
		$chlist=$node->children;
		unset($node->children);
		$list=array($node);
		if(!empty($chlist)){
			foreach ($chlist as $d) {
				$list = array_merge($list, $this->expandTree($d, $level+1));
			}
		}
		return $list;
	}

	protected function getDeptTreeList() {
		$deptTable = $this->getTable();
		$tree = $deptTable->loadDeptTree();

		$treelist=array();
		foreach ($tree as $d) {
			$treelist = array_merge($treelist, $this->expandTree($d, 0));
		}
		return $treelist;
	}
	public function getOptions(){
		$options = array();
		$treelist = $this->getDeptTreeList();
		foreach ($treelist as $d) {
			$value = '';
			for ($i=0; $i<$d->level; $i++) {
				$value = $value.'- ';
			}
			$value = $value.$d->name;
			$options[] = JHtml::_('select.option', $d->id, $value);
		}
		reset($options);
		return $options;
	}
}
?>