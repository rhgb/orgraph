<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');
class OrgraphViewUser extends JView
{
	function display($tpl = null) {
		$this->user = $this->get('Item');
		$this->form = $this->get('Form');
		if(count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		parent::display($tpl);
		$this->_setToolbar();
	}
	function _setToolbar(){
		$input = JFactory::getApplication()->input;
		$input->set('hidemainmenu', true);
		$isNew = ($this->user->id == 0);
		JToolBarHelper::title($isNew ? JText::_( 'COM_ORGRAPH_USER_TITLE_NEW' ) : JText::_('COM_ORGRAPH_USER_TITLE_EDIT'));
		JToolBarHelper::save('user.save');
		JToolBarHelper::cancel('user.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
	}
}
?>