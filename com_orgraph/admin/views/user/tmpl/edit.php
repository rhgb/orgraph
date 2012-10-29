<?php 
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
 ?>
 <form action="<?php echo JRoute::_('index.php?option=com_orgraph&layout=edit&id='.(int)$this->user->id); ?>" method="post" name="adminForm" id="orgraph-user-form">
 	<fieldset class="adminform">
 		<legend><?php echo JText::_('COM_ORGRAPH_USER_LEGEND_DETAIL'); ?></legend>
 		<ul class="adminformlist">
			<li><?php echo $this->form->getLabel('id');
			echo $this->form->getInput('id'); ?></li>
			<li><?php echo $this->form->getLabel('user_id');
			echo $this->form->getInput('user_id'); ?></li>
			<li><?php echo $this->form->getLabel('position');
			echo $this->form->getInput('position'); ?></li>
 			<li>
 				<label id="jform_dept_id-lbl" for="jform_dept_id" class="required">
 					<?php echo JText::_('COM_ORGRAPH_USER_LABEL_DEPT'); ?>
 					<span class="star"> *</span>
 				</label>
 				<select name="jform[dept_id]" id="jform_dept_id" class="inputbox required" aria-required="true" required="true">
				<?php 
					$treelist = $this->get('DeptTreeList');
					$currdept = $this->get('CurrentDeptId');
					foreach ($treelist as $d) :
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
					endforeach;
				 ?>
 				</select>
 			</li>
 		</ul>
 	</fieldset>
 		<div>
 			<input type="hidden" name="task" value="user.edit">
 			<?php echo JHtml::_('form.token'); ?>
 		</div>
 </form>