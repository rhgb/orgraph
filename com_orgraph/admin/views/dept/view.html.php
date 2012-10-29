<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');
class OrgraphViewDept extends JView
{
	function display($tpl = null) {
		$this->dept = $this->get('Item');
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
		$isNew = ($this->dept->id == 0);
		JToolBarHelper::title($isNew ? JText::_( 'COM_ORGRAPH_DEPT_TITLE_NEW' ) : JText::_('COM_ORGRAPH_DEPT_TITLE_EDIT'));
		JToolBarHelper::save('dept.save');
		JToolBarHelper::cancel('dept.cancel', $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
	}
}
?>