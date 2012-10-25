<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.database.table');
class OrgraphTableUser extends JTable
{
	function __construct(&$db)
	{
		parent::__construct('#__orgraph_user', 'id', $db);
	}
	public function loadDeptUsers($deptId=null) {
		$db=&$this->_db;
		if(is_null($deptId)) {
			$query="SELECT b.id,b.name,a.dept_id,a.position FROM ".$db->nameQuote('#__orgraph_user')." AS a LEFT JOIN ".$db->nameQuote('#__users')." AS b ON a.user_id=b.id ORDER BY a.dept_id ASC;";
		} else {
			$query="SELECT b.id,b.name,a.dept_id,a.position FROM ".$db->nameQuote('#__orgraph_user')." AS a LEFT JOIN ".$db->nameQuote('#__users')." AS b ON a.user_id=b.id WHERE a.dept_id=".$db->quote($deptId)." ORDER BY a.user_id ASC;";
		}
		$db->setQuery($query);
		return $db->loadRowList();
	}
}
?>