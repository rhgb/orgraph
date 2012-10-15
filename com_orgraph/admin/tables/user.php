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
			$query="SELECT user_id,dept_id,position FROM ".$db->nameQuote('#__orgraph_user')." ORDER BY ".$db->nameQuote('dept_id')." ASC;";
		} else {
			$query="SELECT user_id,position FROM ".$db->nameQuote('#__orgraph_user')." WHERE ".$db->nameQuote('dept_id')."=".$db->quote($deptId)." ORDER BY ".$db->nameQuote('user_id')." ASC;";
		}
		$db->setQuery($query);
		return $db->loadRowList();
	}
}
?>