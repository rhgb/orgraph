<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.database.table');
class TableOrgraphUser extends JTable
{
	function __construct(&$db)
	{
		parent::__construct('#__orgraph_user', 'id', $db);
	}
	public function loadUsers($deptId=null, $userId=null) {
		$db = & JFactory::getDBO();
		if (!empty($deptId)) {
			$filter=' WHERE a.dept_id='.$db->quote($deptId);
			$selector = 'b.id,b.name,a.position,c.name';
			$mapfunc = function($i){
				return (object)array(
					'user_id' => $i[0],
					'name' => $i[1],
					'position' => $i[2],
					'dept' => $i[3],
				);
			};
		} else if (!empty($userId)) {
			$filter=' WHERE a.user_id='.$db->quote($userId);
			$selector = 'b.name,a.dept_id,a.position,c.name,a.employee_no,a.supervisor_id,d.name,a.tel,a.mobile,a.computer_id,a.location,a.birthday';
			$mapfunc = function($i){
				return (object)array(
					'name' => $i[0],
					'dept_id' => $i[1],
					'position' => $i[2],
					'dept' => $i[3],
					'employee_no' => $i[4],
					'supervisor_id' => $i[5],
					'supervisor' => $i[6],
					'tel' => $i[7],
					'mobile' => $i[8],
					'computer_id' => $i[9],
					'location' => $i[10],
					'birthday' => $i[11]
				);
			};
		} else {
			$filter='';
			$selector = 'a.id,b.name,a.position,c.name,a.employee_no,d.name,a.tel,a.mobile,a.computer_id,a.location,a.birthday';
			$mapfunc = function($i){
				return (object)array(
					'record_id' => $i[0],
					'name' => $i[1],
					'position' => $i[2],
					'dept' => $i[3],
					'employee_no' => $i[4],
					'supervisor' => $i[5],
					'tel' => $i[6],
					'mobile' => $i[7],
					'computer_id' => $i[8],
					'location' => $i[9],
					'birthday' => $i[10]
				);
			};
		}
		$query="SELECT ".$selector." FROM "
		.$db->nameQuote('#__orgraph_user')
		." AS a LEFT JOIN "
		.$db->nameQuote('#__users')
		." AS b ON a.user_id=b.id LEFT JOIN "
		.$db->nameQuote('#__users')
		." AS d ON a.supervisor_id=d.id LEFT JOIN"
		.$db->nameQuote('#__orgraph_dept')
		." AS c ON a.dept_id=c.id"
		.$filter;
		$db->setQuery($query);

		return array_map($mapfunc, $db->loadRowList());
	}

	public function loadUserProj($userId) {
		if(empty($userId)) return false;
		$db = & JFactory::getDBO();
		$query = "SELECT b.id,b.name,b.description,c.id,c.name FROM "
		.$db->nameQuote('#__orgraph_proj_user')
		."AS a LEFT JOIN "
		.$db->nameQuote('#__orgraph_proj')
		."AS b ON a.proj_id=b.id LEFT JOIN "
		.$db->nameQuote('#__orgraph_proj')
		."AS c ON b.parent_id=c.id WHERE a.user_id="
		.$db->quote($userId);
		$db->setQuery($query);
		$mapfunc = function($i) {
			return (object)array(
				'id' => $i[0],
				'name' => $i[1],
				'description' => $i[2],
				'parent_id' => $i[3],
				'parent_name' => $i[4]
				);
		};
		return array_map($mapfunc, $db->loadRowList());
	}

	public function loadProjUsers($pid) {
		if(empty($pid)) return false;
		$db = & JFactory::getDBO();
		$query="SELECT c.id,c.name,b.position,d.name FROM "
		.$db->nameQuote('#__orgraph_proj_user')
		." AS a LEFT JOIN "
		.$db->nameQuote('#__orgraph_user')
		." AS b ON a.user_id=b.user_id LEFT JOIN "
		.$db->nameQuote('#__users')
		." AS c ON a.user_id=c.id LEFT JOIN "
		.$db->nameQuote('#__orgraph_dept')
		." AS d ON b.dept_id=d.id WHERE a.proj_id="
		.$db->quote($pid);
		$db->setQuery($query);
		$mapfunc = function($i) {
			return (object)array(
				'user_id' => $i[0],
				'name' => $i[1],
				'position' => $i[2],
				'dept' => $i[3]
				);
		};
		return array_map($mapfunc, $db->loadRowList());
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