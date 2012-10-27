<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');
class OrgraphViewDepts extends JView
{
	protected $sortDirection;
	protected $sortColumn;
	function display($tpl = null) {
		$this->depts = $this->get('DeptList');
		assert($this->depts != null);
		if(count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}

		parent::display($tpl);
		$this->_setToolbar();
	}
	function _setToolbar(){
		JToolBarHelper::title( JText::_( 'Orgraph: Departments' ));
		JToolBarHelper::addNew('dept.add');
		JToolBarHelper::deleteList('', 'depts.delete');
	}
}
?>