<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');
class OrgraphViewUsers extends JView
{
	protected $sortDirection;
	protected $sortColumn;
	function display($tpl = null) {
		$this->users = $this->get('UserList');
		$this->state = $this->get('State');

		$this->sortDirection = $this->state->get('list.direction');
		$this->sortColumn = $this->state->get('list.ordering');
		assert($this->users != null);
		if(count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}

		parent::display($tpl);
		$this->_setToolbar();
	}
	function _setToolbar(){
		JToolBarHelper::title( JText::_( 'COM_ORGRAPH_USERS_TITLE' ));
		JToolBarHelper::addNew('user.add');
		JToolBarHelper::deleteList('', 'users.delete');
	}
}
?>