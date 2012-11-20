<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.modellist');
class OrgraphModelProjs extends JModelList {
	public function getTable($type = 'OrgraphProj', $prefix = 'Table', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	public function getProjList(){
		$projTable=$this->getTable();
		return $projTable->loadProjList();
	}
}
 ?>