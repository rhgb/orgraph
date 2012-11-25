<?php
defined('JPATH_BASE') or die;

JFormHelper::loadFieldClass('checkboxes');

class JFormFieldUserProjList extends JFormFieldCheckboxes
{
	protected $type = 'userprojlist';

	public function getTable($type = 'OrgraphProj', $prefix = 'Table', $config = array())
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

	protected function getProjTreeList() {
		$projTable = $this->getTable();
		$tree = $projTable->loadProjTree();

		$treelist=array();
		foreach ($tree as $d) {
			$treelist = array_merge($treelist, $this->expandTree($d, 0));
		}
		return $treelist;
	}
	protected function getOptions(){
		$options = array();
		$treelist = $this->getProjTreeList();
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