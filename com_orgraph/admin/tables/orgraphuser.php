<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.database.table');
class TableOrgraphUser extends JTable
{
	function __construct(&$db)
	{
		parent::__construct('#__orgraph_user', 'id', $db);
	}

	public function getUsersQuery($deptId=null, $userId=null) {
		$db = & JFactory::getDBO();
		if (!empty($deptId)) {
			$filter='a.dept_id='.$db->quote($deptId);
			$selector = array(
				$db->quoteName('b.id','user_id'),
				$db->quoteName('b.name','name'),
				$db->quoteName('a.avatar','avatar'),
				$db->quoteName('a.position','position'),
				$db->quoteName('c.name','dept'),
				$db->quoteName('a.level','level'),
				);

		} else if (!empty($userId)) {
			$filter='a.user_id='.$db->quote($userId);
			$selector = array(
				$db->quoteName('b.name','name'),
				$db->quoteName('a.avatar','avatar'),
				$db->quoteName('a.dept_id','dept_id'),
				$db->quoteName('a.position','position'),
				$db->quoteName('c.name','dept'),
				$db->quoteName('a.employee_no','employee_no'),
				$db->quoteName('a.supervisor_id','supervisor_id'),
				$db->quoteName('d.name','supervisor'),
				$db->quoteName('a.tel','tel'),
				$db->quoteName('a.mobile','mobile'),
				$db->quoteName('a.computer_id','computer_id'),
				$db->quoteName('a.location','location'),
				$db->quoteName('a.birthday','birthday'),
				);

		} else {
			$filter=null;
			$selector = array(
				$db->quoteName('a.id','record_id'),
				$db->quoteName('b.name','name'),
				$db->quoteName('a.position','position'),
				$db->quoteName('c.name','dept'),
				$db->quoteName('a.employee_no','employee_no'),
				$db->quoteName('d.name','supervisor'),
				$db->quoteName('a.tel','tel'),
				$db->quoteName('a.mobile','mobile'),
				$db->quoteName('a.computer_id','computer_id'),
				$db->quoteName('a.location','location'),
				$db->quoteName('a.birthday','birthday'),
				$db->quoteName('a.level','level')
				);
		}

		$query = $db->getQuery(true);
		$query->select($selector)
			  ->from($db->quoteName('#__orgraph_user', 'a'))
			  ->leftJoin($db->quoteName('#__users', 'b').' ON a.user_id=b.id')
			  ->leftJoin($db->quoteName('#__orgraph_dept', 'c').' ON a.dept_id=c.id')
			  ->leftJoin($db->quoteName('#__users', 'd').' ON a.supervisor_id=d.id');
		if ($filter != null) {
			$query->where($filter);
		}

		return $query;
	}

	public function loadUsers($deptId=null, $userId=null) {
		/*
		USED BY:
		loadUsers(null, null, $order, $dir):  admin->view->users
		loadUsers($deptId): site->main->list dept users
		loadUsers(null, $userId): site->user
		 */
		$db = & JFactory::getDBO();
		$query = $this->getUsersQuery($deptId, $userId);
		$db->setQuery($query);
		return $db->loadObjectList();
	}

	public function loadUserProj($userId) {
		if(empty($userId)) return false;
		$db = & JFactory::getDBO();

		$query = $db->getQuery(true);
		$query->select(array(
				$db->quoteName('b.id','id'),
				$db->quoteName('b.name','name'),
				$db->quoteName('b.description','description'),
				$db->quoteName('c.id','parent_id'),
				$db->quoteName('c.name','parent_name'),
			))
			->from($db->quoteName('#__orgraph_proj_user','a'))
			->leftJoin($db->quoteName('#__orgraph_proj','b').' ON a.proj_id=b.id')
			->leftJoin($db->quoteName('#__orgraph_proj','c').' ON b.parent_id=c.id')
			->where('a.user_id='.$db->quote($userId));

		$db->setQuery($query);
		return $db->loadObjectList();
	}

	public function loadProjUsers($pid) {
		/*
		USED BY:
			site->main->list proj users
		 */
		if(empty($pid)) return false;
		$db = & JFactory::getDBO();

		$query = $db->getQuery(true);
		$query->select(array(
				$db->quoteName('c.id','user_id'),
				$db->quoteName('c.name','name'),
				$db->quoteName('b.avatar','avatar'),
				$db->quoteName('b.position','position'),
				$db->quoteName('d.name','dept'),
				$db->quoteName('b.level','level')
			))
			->from($db->quoteName('#__orgraph_proj_user','a'))
			->leftJoin($db->quoteName('#__orgraph_user','b').' ON a.user_id=b.user_id')
			->leftJoin($db->quoteName('#__users','c').' ON a.user_id=c.id')
			->leftJoin($db->quoteName('#__orgraph_dept','d').' ON b.dept_id=d.id')
			->where('a.proj_id='.$db->quote($pid));

		$db->setQuery($query);
		return $db->loadObjectList();
	}

	public function getAvatar($uid) {
		if(empty($uid))
			return false;
		$db = & JFactory::getDBO();
		$query = & $db->getQuery(true);
		$query->select('avatar')
			  ->from('#__orgraph_user')
			  ->where('user_id='.$uid);
		$db->setQuery($query);
		return $db->loadResult();
	}

	public function setAvatar($uid, $avatar) {
		if(empty($uid))
			return false;
		if(empty($avatar))
			$avatar = '';
		$db = & JFactory::getDBO();
		$query = & $db->getQuery(true);
		$query->update('#__orgraph_user')
			  ->set('avatar='.$db->quote($avatar))
			  ->where('user_id='.$uid);
		$db->setQuery($query);
		return $db->query() != false;
	}
}
?>