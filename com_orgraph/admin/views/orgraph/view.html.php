<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');
class OrgraphViewOrgraph extends JView
{
	function display($tpl = null) {
		if(count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		parent::display($tpl);
		$this->_setToolbar();
	}
	function _setToolbar(){
		JToolBarHelper::title( JText::_( 'Orgraph: Control Panel' ));
		JToolBarHelper::addNew('orgraph.add');
		JToolBarHelper::editList('orgraph.edit');
		JToolBarHelper::deleteList('orgraph.delete');
	}
}
?>