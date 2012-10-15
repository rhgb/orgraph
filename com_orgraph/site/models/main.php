<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.modelitem');
class OrgraphModelMain extends JModelItem
{
	protected $msg;
	protected $deptTree;
	
	public function getTable($type=null, $prefix='orgraphTable', $config='') {
		if(is_null($type)) return null;
		return JTable::getInstance($type,$prefix,$config);
	}
	
	public function getDeptTree() {
		$deptTable = $this->getTable('dept');
		$deptList = $deptTable->loadAll();
		foreach($deptList as $i=>$d){
			if(is_null($d[3])){
				$rootList[]=$i;
			}
			else {
				$deptList[$d[3]][4][]=$d[0];
			}
		}
		function buildTree(&$list,&$d){
			$dept=array('id'=>$d[0], 'name'=>$d[1], 'desc'=>$d[2], 'parentId'=>$d[3], 'children'=>array());
			if(array_key_exists(4, $d)){
				foreach($d[4] as $i){
					$dept['children'][]=buildTree($list,$list[$i]);
				}
			}
			return $dept;
		}
		foreach($rootList as $rid){
			$this->deptTree[]=buildTree($deptList, $deptList[$rid]);
		}
		return $this->deptTree;
	}
	
	public function getDeptUsers($deptId=null) {
		$userTable = $this->getTable('user');
		$userList = $userTable->loadDeptUsers($deptId);
	}
	/*
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
	*/
}
?>