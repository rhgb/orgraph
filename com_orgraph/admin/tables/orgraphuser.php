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
		} else if (!empty($userId)) {
			$filter=' WHERE a.user_id='.$db->quote($userId);
		} else {
			$filter='';
		}
		$query="SELECT a.id,b.id,b.name,a.dept_id,a.position,c.name,a.employee_no,a.supervisor_id,d.name,a.tel,a.mobile,a.computer_id,a.location,a.birthday FROM "
			.$db->nameQuote('#__orgraph_user')
			." AS a LEFT JOIN "
			.$db->nameQuote('#__users')
			." AS b ON a.user_id=b.id LEFT JOIN "
			.$db->nameQuote('#__users')
			." AS d ON a.supervisor_id=d.id LEFT JOIN"
			.$db->nameQuote('#__orgraph_dept')
			." AS c ON a.dept_id=c.id"
			.$filter
			." ORDER BY a.user_id ASC;";
		$db->setQuery($query);
		$mapfunc = function($i){
			return (object)array(
				'record_id' => $i[0],
				'user_id' => $i[1],
				'name' => $i[2],
				'dept_id' => $i[3],
				'position' => $i[4],
				'dept' => $i[5],
				'employee_no' => $i[6],
				'supervisor_id' => $i[7],
				'supervisor' => $i[8],
				'tel' => $i[9],
				'mobile' => $i[10],
				'computer_id' => $i[11],
				'location' => $i[12],
				'birthday' => $i[13]
			);
		};
		return array_map($mapfunc, $db->loadRowList());
	}
}
?>