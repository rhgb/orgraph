<?php 
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
 ?>
 <form action="<?php echo JRoute::_('index.php?option=com_orgraph&layout=edit&id='.(int)$this->user->id); ?>" method="post" name="adminForm" id="orgraph-user-form" enctype="multipart/form-data">
 	<fieldset class="adminform">
 		<legend><?php echo JText::_('COM_ORGRAPH_USER_LEGEND_DETAIL'); ?></legend>
 		<ul class="adminformlist">
		<?php foreach($this->form->getFieldset() as $field): ?>
 			<li><?php
 				echo $field->label;
 				echo $field->input;
 				if($field->fieldname == 'avatar' && !empty($this->user->avatar)) {
					?>
					<img src="<?php echo JURI::root().'components/com_orgraph/files/'.$this->user->avatar; ?>" alt="<?php echo JText::_('COM_ORGRAPH_USER_LABEL_AVATAR'); ?>" style="max-width:300px;clear:left;margin-left:140px;" />
					<?php 					
 				}
 			?></li>
 		<?php endforeach; ?>
 		</ul>
 	</fieldset>
 		<div>
 			<input type="hidden" name="task" value="user.edit">
 			<?php echo JHtml::_('form.token'); ?>
 		</div>
 </form>