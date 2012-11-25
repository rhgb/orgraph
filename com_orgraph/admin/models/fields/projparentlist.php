<?php
defined('JPATH_BASE') or die;

JFormHelper::loadFieldClass('list');

class JFormFieldProjParentList extends JFormFieldList
{
	protected $type = 'projparentlist';

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
				if($this->currentId != $d->id) {
					$list = array_merge($list, $this->expandTree($d, $level+1));
				}
			}
		}
		return $list;
	}

	protected function getProjTreeList() {
		$projTable = $this->getTable();
		$tree = $projTable->loadProjTree();
		$treelist=array( (object)array('id'=>0, 'name'=>JText::_('COM_ORGRAPH_PLACEHOLDER_NONE')) );
		foreach ($tree as $d) {
			if($this->currentId != $d->id) {
				$treelist = array_merge($treelist, $this->expandTree($d, 0));
			}
		}
		return $treelist;
	}

	protected function getOptions(){
		$this->currentId = $this->form->getValue('id');
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