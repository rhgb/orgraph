<?php 
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
 ?>
 <form action="<?php echo JRoute::_('index.php?option=com_orgraph&layout=edit&id='.(int)$this->proj->id); ?>" method="post" name="adminForm" id="orgraph-proj-form">
 	<fieldset class="adminform">
 		<legend><?php echo JText::_('COM_ORGRAPH_PROJ_LEGEND_DETAIL'); ?></legend>
 		<ul class="adminformlist">
 		<?php foreach($this->form->getFieldset() as $field): ?>
 			<li><?php
 				echo $field->label;
 				echo $field->input;
 			?></li>
 		<?php endforeach; ?>
 		</ul>
 	</fieldset>
 		<div>
 			<input type="hidden" name="task" value="proj.edit">
 			<?php echo JHtml::_('form.token'); ?>
 		</div>
 </form>