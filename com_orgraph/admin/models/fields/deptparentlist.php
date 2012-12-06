<?php
defined('JPATH_BASE') or die;

JFormHelper::loadFieldClass('list');

class JFormFieldDeptParentList extends JFormFieldList
{
	protected $type = 'deptparentlist';

	public function getTable($type = 'OrgraphDept', $prefix = 'Table', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	protected function expandTree($node, $level) {
		$node->level=$level;
		$chlist=$node->children;
		unset($node->children);
		$list=array($node);
		if(!empty($chlist)){
			foreach ($chlist as $d) {
				if($this->currentId != $d->id) {
					$list = array_merge($list, $this->expandTree($d, $level+1));
				}
			}
		}
		return $list;
	}

	protected function getDeptTreeList() {
		$deptTable = $this->getTable();
		$tree = $deptTable->loadDeptTree();
		$treelist=array( (object)array('id'=>0, 'name'=>JText::_('COM_ORGRAPH_PLACEHOLDER_NONE'), 'level'=>0) );
		foreach ($tree as $d) {
			if($this->currentId != $d->id) {
				$treelist = array_merge($treelist, $this->expandTree($d, 0));
			}
		}
		return $treelist;
	}
	
	protected function getOptions() {
		$this->currentId = $this->form->getValue('id');
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