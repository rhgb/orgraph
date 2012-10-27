<?php 
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
 ?>
 <form action="<?php echo JRoute::_('index.php?option=com_orgraph&layout=edit&id='.(int)$this->dept->id); ?>" method="post" name="adminForm" id="orgraph-dept-form">
 	<fieldset class="adminform">
 		<legend><?php echo JText::_('Detail'); ?></legend>
 		<ul class="adminformlist">
		<?php foreach($this->form->getFieldset() as $field) { ?>
			<li><?php echo $field->label; echo $field->input; ?></li>
		<?php } ?>
 		</ul>
 	</fieldset>
 		<div>
 			<input type="hidden" name="task" value="dept.edit">
 			<?php echo JHtml::_('form.token'); ?>
 		</div>
 </form>