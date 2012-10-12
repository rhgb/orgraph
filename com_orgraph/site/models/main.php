<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.modelitem');
class OrgraphModelMain extends JModelItem
{
	protected $msg;
	public function getTable($type=null, $prefix='orgraphTable', $config='')
	{
		if(is_null($type)) return null;
		return JTable::getInstance($type,$prefix,$config);
	}
	public function getDeptTree()
	{
		$this->deptTree = array();
		$deptTable = $this->getTable('dept');
		$this->deptTree = $deptTable->loadAll();
		return $this->deptTree;
	}
	public function getMsg($id = 1)
	{
		if(!is_array($this->msg)) {
			$this->msg = array();
		}

		if(!isset($this->msg[$id]))
		{
			$input = JFactory::getApplication()->input;
			$id = $input->getInt('id');
			$table = $this->getTable();
			$table->load($id);
			$this->msg[$id] = $table->greeting;
		}
		return $this->msg[$id];
	}
}
?>