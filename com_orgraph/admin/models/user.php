<?php 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelform library
jimport('joomla.application.component.modeladmin');

class OrgraphModelUser extends JModelAdmin {

	public function getTable($type = 'OrgraphUser', $prefix = 'Table', $config = array()) 
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	public function getForm($data = array(), $loadData = true) {
		$form = $this->loadForm('com_orgraph.user', 'user',
			array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form))
		{
			return false;
		}
		return $form;
	}

	protected function loadFormData() 
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_orgraph.edit.user.data', array());
		if (empty($data)) 
		{
			$data = $this->getItem();
		}
		return $data;
	}

	public function getDeptTreeList() {
		$deptTable=$this->getTable('OrgraphDept');
		$tree = $deptTable->loadDeptTree();
		function expandTree($node, $level) {
			$node->level=$level;
			$chlist=$node->children;
			unset($node->children);
			$list=array($node);
			if(!empty($chlist)){
				foreach ($chlist as $d) {
					$list = array_merge($list, expandTree($d, $level+1));
				}
			}
			return $list;
		}
		$treelist=array();
		foreach ($tree as $d) {
			$treelist = array_merge($treelist, expandTree($d, 0));
		}
		return $treelist;
	}

	public function getCurrentDeptId() {
		return $this->loadFormData()->dept_id;
	}

	public function save($data) {
		$savestate = parent::save($data);
		if($savestate) {
			$relationTable = $this->getTable('OrgraphProjUser');
			$savestate = $relationTable->updateRelation($data['user_id'], $data['proj_ids']);
			if($savestate) {
				jimport('joomla.filesystem.file');
				$avatarPath = JPATH_COMPONENT_SITE . DS . 'files' . DS;
				$mapfunc = function($i) { return $i['avatar']; };
				$file = array_map($mapfunc, JRequest::getVar('jform', null, 'files', 'array'));
				$filename = JFile::makeSafe($file['name']);
				$src = $file['tmp_name'];
				$srcext = strtolower(JFile::getExt($filename));
				if( ($srcext == 'png' || $srcext == 'jpg' || $srcext == 'jpeg') && $file['size'] <= 1048576 ) {
					$userTable = $this->getTable('OrgraphUser');
					$origin = $userTable->getAvatar($data['user_id']);
					if(!empty($origin)) {
						JFile::delete($avatarPath.$origin);
					}
					if (JFile::upload($src, $avatarPath.$filename)) {
						$userTable->setAvatar($data['user_id'], $filename);
						$savestate = true;
					} else {
						$savestate = false;
					}
				} else {
					$savestate = false;
				}
			}
		}
		return $savestate;
	}

	public function getItem($pk = null) {
		$item = parent::getItem($pk);
		if(!empty($item->id)) {
			$relationTable = $this->getTable('OrgraphProjUser');
			$item->proj_ids = $relationTable->getRelation($item->user_id);
		}
		return $item;
	}
}
 ?>