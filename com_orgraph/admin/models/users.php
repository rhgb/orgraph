<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.modellist');
class OrgraphModelUsers extends JModelList {

	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'level',
				'name',
				'position',
				'dept',
				'employee_no',
				'supervisor',
				'tel',
				'mobile',
				'computer_id',
				'location',
				'birthday'
				);
		}

		parent::__construct($config);
	}

	protected function populateState($ordering = null, $direction = null) {
		$app = JFactory::getApplication();
		$context = $this->context;
		$search = $this->getUserStateFromRequest($context.'.search', 'filter_search');
		$this->setState('filter.search', $search);
		$deptId = $this->getUserStateFromRequest($context.'.deptId', 'filter_deptId');
		$this->setState('filter.deptId', $deptId);

		parent::populateState($ordering, $direction);
	}

	protected function getListQuery() {
		$db = & JFactory::getDBO();
		$userTable = $this->getTable();
		$query = $userTable->getUsersQuery();
		// search filter
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			$search = $db->quote('%'.$db->escape($search, true).'%');
			$query->where('b.name LIKE '.$search);
		}
		// department filter
		$deptId = $db->escape($this->getState('filter.deptId'));
		if (is_numeric($deptId)) {
			$query->where('a.dept_id='.(int)$deptId);
		}
		// ordering
		$query->order($db->escape($this->getState('list.ordering', 'name')).' '.$db->escape($this->getState('list.direction', 'ASC')));

		return $query;
	}

	public function getTable($type = 'OrgraphUser', $prefix = 'Table', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}
}
 ?>