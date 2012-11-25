<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.database.table');
class TableOrgraphDept extends JTable
{
	function __construct(&$db)
	{
		parent::__construct('#__orgraph_dept', 'id', $db);
	}
	public function loadDeptList() {
		$db = & JFactory::getDBO();
		$query="SELECT a.id,a.name,a.description,p.id,p.name FROM ".$db->nameQuote('#__orgraph_dept')
			." AS a LEFT JOIN ".$db->nameQuote('#__orgraph_dept')
			." AS p ON a.parent_id=p.id;";
		$db->setQuery($query);
		$mapfunc = function($i){
			return (object)array('id' => $i[0], 'name' => $i[1], 'description' => $i[2], 'parent_id' => $i[3], 'parent_name' => $i[4]);
		};
		return array_map($mapfunc, $db->loadRowList());
	}

	protected function buildTree(&$list, &$d) { // build tree recursively
		$dept=(object)array('id'=>$d[0], 'name'=>$d[1], 'desc'=>$d[2], 'parentId'=>$d[3], 'children'=>array());
		if(array_key_exists(4, $d) && !empty($d[4])){
			foreach($d[4] as $i){
				$dept->children[] = $this->buildTree($list,$list[$i]);
			}
		}
		return $dept;
	}

	public function loadDeptTree() {
		$db = & JFactory::getDBO();
		$query="SELECT id,name,description,parent_id FROM ".$db->nameQuote('#__orgraph_dept').";";
		$db->setQuery($query);
		foreach($db->loadRowList() as $d){
			$list[$d[0]]=$d;
		}
		foreach ($list as $d) { // find root; assign children to $d[4]
			if (empty($d[3])) {
				$rootlist[]=$d[0];
			}
			else {
				$list[$d[3]][4][]=$d[0];
			}
		}
		foreach ($rootlist as $i) { // build tree
			$treelist[] = $this->buildTree($list, $list[$i]);
		}
		return $treelist;
	}
}
?>