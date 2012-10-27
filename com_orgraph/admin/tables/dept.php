<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.database.table');
class OrgraphTableDept extends JTable
{
	function __construct(&$db)
	{
		parent::__construct('#__orgraph_dept', 'id', $db);
	}
	public function loadAll() {
		$db=&$this->_db;
		$query="SELECT id,name,description,parent_id FROM ".$db->nameQuote('#__orgraph_dept').";";
		$db->setQuery($query);
		foreach($db->loadRowList() as $d){
			$list[$d[0]]=$d;
		}
		return $list;
	}
	public function loadDeptList() {
		$db=&$this->_db;
		$query="SELECT a.id,a.name,a.description,p.id,p.name FROM ".$db->nameQuote('#__orgraph_dept')." AS a LEFT JOIN ".$db->nameQuote('#__orgraph_dept')." AS p ON a.parent_id=p.id;";
		$db->setQuery($query);
		$mapfunc = function($i){
			return array('id' => $i[0], 'name' => $i[1], 'description' => $i[2], 'parent_id' => $i[3], 'parent_name' => $i[4]);
		};
		return array_map($mapfunc, $db->loadRowList());
	}
}
?>