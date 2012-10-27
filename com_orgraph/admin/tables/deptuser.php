<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.database.table');
class OrgraphTableDeptUser extends JTable
{
	function __construct(&$db)
	{
		parent::__construct('#__orgraph_user', 'id', $db);
	}
	public function loadDeptUsers($deptId=null) {
		$db=&$this->_db;
		if(is_null($deptId)) {
			$query="SELECT a.id,b.id,b.name,a.dept_id,a.position,c.name FROM ".$db->nameQuote('#__orgraph_user')." AS a LEFT JOIN ".$db->nameQuote('#__users')." AS b ON a.user_id=b.id LEFT JOIN ".$db->nameQuote('#__orgraph_dept')." AS c ON a.dept_id=c.id ORDER BY a.dept_id ASC;";
		} else {
			$query="SELECT a.id,b.id,b.name,a.dept_id,a.position,c.name FROM ".$db->nameQuote('#__orgraph_user')." AS a LEFT JOIN ".$db->nameQuote('#__users')." AS b ON a.user_id=b.id LEFT JOIN ".$db->nameQuote('#__orgraph_dept')." AS c ON a.dept_id=c.id WHERE a.dept_id=".$db->quote($deptId)." ORDER BY a.user_id ASC;";
		}
		$db->setQuery($query);
		$mapfunc = function($i){
			return (object)array('record_id' => $i[0],'user_id' => $i[1], 'name' => $i[2], 'dept_id' => $i[3], 'position' => $i[4], 'dept' => $i[5]);
		};
		return array_map($mapfunc, $db->loadRowList());
	}
}
?>