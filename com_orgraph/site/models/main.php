<?php 
defined('_JEXEC') or die('Restricted access');
//assert(jimport('joomla.database.table.user'));
include_once(__DIR__.'../../../../libraries/joomla/database/table/user.php');
jimport('joomla.application.component.modelitem');
class OrgraphModelMain extends JModelItem
{
	protected $msg;
	protected $deptTree;
	
	public function getDeptTable($type=null, $prefix='orgraphTable', $config='') {
		if(is_null($type)) return null;
		return JTable::getInstance($type,$prefix,$config);
	}
	
	public function getDeptTree() {
		$deptTable = $this->getDeptTable('dept');
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
			$deptTree[]=buildTree($deptList, $deptList[$rid]);
		}
		return $deptTree;
	}
	
	public function getDeptUsers($deptId=null) {
		$userTable = $this->getDeptTable('user');
		$userList = $userTable->loadDeptUsers($deptId);
		foreach($userList as &$user){
			$j_user = & JFactory::getUser((int)$user[0]);
			assert($j_user->id > 0);
			$user = array('id'=>(int)$user[0],'position'=>$user[1],'name'=>$j_user->name);
		}
		return $userList;
	}
}
?>