<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');
class OrgraphViewUsers extends JView
{
	protected $sortDirection;
	protected $sortColumn;
	function display($tpl = null) {
		$this->users = $this->get('UserList');
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
		JToolBarHelper::title( JText::_( 'Orgraph: Users' ));
		JToolBarHelper::addNew('user.add');
		JToolBarHelper::deleteList('', 'users.delete');
	}
}
?>