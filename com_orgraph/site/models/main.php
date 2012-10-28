<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.modelitem');
class OrgraphModelMain extends JModelItem
{
	public function getTable($type='Dept', $prefix='orgraphTable', $config='') {
		return JTable::getInstance($type,$prefix,$config);
	}
	
	public function getDeptTree() {
		$deptTable = $this->getTable();
		$deptList = $deptTable->loadAll();
		foreach($deptList as $i=>$d){
			if(empty($d[3])){
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
			$deptTree[]=buildTree($deptList, $deptList[$rid]);
		}
		return $deptTree;
	}
	
	public function getDeptUsers($deptId=null) {
		$userTable = $this->getTable('DeptUser');
		return $userTable->loadDeptUsers($deptId);
	}
}
?>