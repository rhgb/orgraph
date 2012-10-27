<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');

class OrgraphControllerDepts extends JControllerAdmin
{
        public function getModel($name = 'Depts', $prefix = 'OrgraphModel') 
        {
                $model = parent::getModel($name, $prefix, array('ignore_request' => true));
                return $model;
        }
}
?>