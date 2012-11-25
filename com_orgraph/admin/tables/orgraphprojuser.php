<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.database.table');
class TableOrgraphProjUser extends JTable
{
	function __construct(&$db)
	{
		parent::__construct('#__orgraph_proj_user', 'id', $db);
	}

	public function updateRelation($uid, $pids) {
		$db = & JFactory::getDBO();
		$query = & $db->getQuery(true);
		$query->select('id,proj_id')
			->from('#__orgraph_proj_user')
			->where('user_id='.$uid);
		$db->setQuery($query);
		$list = array();
		foreach ($db->loadRowList() as $i) {
			$list[$i[0]] = $i[1];
		}
		$addlist = array_diff($pids, $list);
		$dellist = array_diff($list, $pids);
		$success = true;
		// del records
		if(count($dellist) > 0) {
			$query = & $db->getQuery(true);
			$query->delete('#__orgraph_proj_user')
				->where('id IN ('.implode(',', array_keys($dellist)).')');
			$db->setQuery($query);
			$success = $success && ($db->query() != false);
		}
		// add records
		if(count($addlist) > 0) {
			$query = & $db->getQuery(true);
			$query->insert('#__orgraph_proj_user')
				->columns('user_id,proj_id');
			foreach ($addlist as $pid) {
				$query->values($uid.','.$pid);
			}
			$db->setQuery($query);
			$success = $success && ($db->query() != false);
		}
		return $success;
	}

	public function getRelation($uid) {
		$db = & JFactory::getDBO();
		$query = & $db->getQuery(true);
		$query->select('proj_id')
			->from('#__orgraph_proj_user')
			->where('user_id='.$uid);
		$db->setQuery($query);
		$list = array();
		foreach ($db->loadRowList() as $i) {
			$list[] = $i[0];
		}
		return $list;
	}
}
?>