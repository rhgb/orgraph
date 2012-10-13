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
}
?>