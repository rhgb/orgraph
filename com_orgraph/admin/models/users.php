<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.modellist');
class OrgraphModelUsers extends JModelList {

	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'a.level',
				'b.name',
				'a.position',
				'c.name',
				'a.employee_no',
				'd.name',
				'a.tel',
				'a.mobile',
				'a.computer_id',
				'a.location',
				'a.birthday'
				);
		}

		parent::__construct($config);
	}

	protected function getListQuery() {
		$userTable = $this->getTable();
		return $userTable->getUsersQuery(null, null, $this->getState('list.ordering', 'b.name'), $this->getState('list.direction', 'ASC'));
	}

	public function getMappingFunction() {
		return $this->mapfunc;
	}

	public function getTable($type = 'OrgraphUser', $prefix = 'Table', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}
}
 ?>