<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');
class OrgraphViewProjs extends JView
{
	protected $sortDirection;
	protected $sortColumn;
	function display($tpl = null) {
		$this->projs = $this->get('ProjList');
		assert($this->projs != null);
		if(count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}

		parent::display($tpl);
		$this->_setToolbar();
	}
	function _setToolbar(){
		JToolBarHelper::title( JText::_( 'COM_ORGRAPH_PROJS_TITLE' ));
		JToolBarHelper::addNew('proj.add');
		JToolBarHelper::deleteList('', 'projs.delete');
	}
}
?>