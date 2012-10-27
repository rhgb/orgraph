<?php 
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
 ?>
 <form action="<?php echo JRoute::_('index.php?option=com_orgraph&layout=edit&id='.(int)$this->user->id); ?>" method="post" name="adminForm" id="orgraph-user-form">
 	<fieldset class="adminform">
 		<legend><?php echo JText::_('Detail'); ?></legend>
 		<ul class="adminformlist">
 			<li>
 				<label>Name</label>
 				<input type="text" class="readonly" readonly="readonly" value="<?php echo JFactory::getUser($this->user->user_id)->name;?>" />
 			</li>
		<?php foreach($this->form->getFieldset() as $field) { ?>
			<li><?php echo $field->label; echo $field->input; ?></li>
		<?php } ?>
 		</ul>
 	</fieldset>
 		<div>
 			<input type="hidden" name="task" value="user.edit">
 			<?php echo JHtml::_('form.token'); ?>
 		</div>
 </form>