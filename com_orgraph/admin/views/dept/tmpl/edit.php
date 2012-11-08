<?php 
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
 ?>
 <form action="<?php echo JRoute::_('index.php?option=com_orgraph&layout=edit&id='.(int)$this->dept->id); ?>" method="post" name="adminForm" id="orgraph-dept-form">
 	<fieldset class="adminform">
 		<legend><?php echo JText::_('COM_ORGRAPH_DEPT_LEGEND_DETAIL'); ?></legend>
 		<ul class="adminformlist">
 		<?php foreach($this->form->getFieldset() as $field): ?>
 			<li><?php
	 			if($field->name != 'parent_id') {
	 				echo $field->label;
	 				echo $field->input;
	 			}
 			?></li>
 		<?php endforeach; ?>
			 <li>
 				<label id="jform_parent_id-lbl" for="jform_parent_id" class="required">
 					<?php echo JText::_('COM_ORGRAPH_DEPT_LABEL_PARENT'); ?>
 					<span class="star"> *</span>
 				</label>
 				<select name="jform[parent_id]" id="jform_parent_id" class="inputbox required" aria-required="true" required="true">
				<?php 
					$treelist = $this->get('DeptTreeList');
					$currdept = $this->get('CurrentParentId');
					$currid = $this->get('CurrentId');
					if(empty($currdept)) $currdept=0;
				?>
					<option value="0"<?php if(empty($currdept)) echo ' selected="selected"'; ?>><?php echo JText::_('COM_ORGRAPH_PLACEHOLDER_NONE'); ?></option>
				<?php
					foreach ($treelist as $d) :
						if($d->id != (int)$currid) :
				?>
					<option value="<?php echo $d->id ?>"<?php if($d->id == (int)$currdept) echo ' selected="selected"'; ?>>
						<?php 
						for ($i=0; $i<$d->level; $i++) {
							echo '- ';
						}
						echo $d->name;
						 ?>
					</option>
				<?php
						endif;
					endforeach;
				 ?>
 				</select>
 			</li>
 		</ul>
 	</fieldset>
 		<div>
 			<input type="hidden" name="task" value="dept.edit">
 			<?php echo JHtml::_('form.token'); ?>
 		</div>
 </form>