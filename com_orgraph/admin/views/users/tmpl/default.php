<?php 
defined('_JEXEC') or die('Restricted access');
JHTML::_('behavior.tooltip');
?>
<form action="<?php echo JRoute::_('index.php?option=com_orgraph'); ?>" method="post" name="adminForm" id="adminForm">
	<table class="adminlist">
		<thead>
			<tr>
				<th width="1%">
					<input type="checkbox" name="toggle" value="" onclick="checkAll(this);" />
				</th>
				<th width="1%">
					&equiv;
				</th>
				<th class="left nowrap">
					<?php echo JText::_('COM_ORGRAPH_USER_LABEL_NAME'); ?>
				</th>
				<th class="nowrap" width="10%">
					<?php echo JText::_('COM_ORGRAPH_USER_LABEL_POS'); ?>
				</th>
				<th class="nowrap" width="10%">
					<?php echo JText::_('COM_ORGRAPH_USER_LABEL_DEPT'); ?>
				</th>
				<th class="nowrap" width="10%">
					<?php echo JText::_('COM_ORGRAPH_USER_LABEL_EMPLOYEE_NO'); ?>
				</th>
				<th class="nowrap" width="10%">
					<?php echo JText::_('COM_ORGRAPH_USER_LABEL_SUPERVISOR'); ?>
				</th>
				<th class="nowrap" width="10%">
					<?php echo JText::_('COM_ORGRAPH_USER_LABEL_TEL'); ?>
				</th>
				<th class="nowrap" width="10%">
					<?php echo JText::_('COM_ORGRAPH_USER_LABEL_MOBILE'); ?>
				</th>
				<th class="nowrap" width="10%">
					<?php echo JText::_('COM_ORGRAPH_USER_LABEL_COMP_ID'); ?>
				</th>
				<th class="nowrap" width="5%">
					<?php echo JText::_('COM_ORGRAPH_USER_LABEL_LOCATION'); ?>
				</th>
				<th class="nowrap" width="10%">
					<?php echo JText::_('COM_ORGRAPH_USER_LABEL_BIRTHDAY'); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		foreach ($this->users as $i => $user) {
			$link=JRoute::_('index.php?option=com_orgraph&task=user.edit&id='.$user->record_id);
		?>
			<tr class="row<?php echo $i % 2; ?>">
				<td class="center">
					<?php echo JHtml::_('grid.id', $i, $user->record_id); ?>
				</td>
				<td class="center">
					<?php echo $user->level; ?>
				</td>
				<td>
					<a href="<?php echo $link; ?>"><?php echo $user->name; ?></a>
				</td>
				<td class="center">
					<?php echo $user->position; ?>
				</td>
				<td>
					<?php echo $user->dept; ?>
				</td>
				<td class="center">
					<?php echo $user->employee_no; ?>
				</td>
				<td class="center">
					<?php echo $user->supervisor; ?>
				</td>
				<td>
					<?php echo $user->tel; ?>
				</td>
				<td class="center">
					<?php echo $user->mobile; ?>
				</td>
				<td class="center">
					<?php echo $user->computer_id; ?>
				</td>
				<td class="center">
					<?php echo $user->location; ?>
				</td>
				<td class="center">
					<?php echo $user->birthday; ?>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
	<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>