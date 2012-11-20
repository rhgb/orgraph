<?php 
defined('_JEXEC') or die('Restricted access');
jimport('joomla.database.table');
class TableOrgraphProjUser extends JTable
{
	function __construct(&$db)
	{
		parent::__construct('#__orgraph_proj_user', 'id', $db);
	}
}
?>