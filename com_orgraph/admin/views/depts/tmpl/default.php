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
				<th class="left nowrap" width="10%">
					<?php echo JText::_('COM_ORGRAPH_DEPT_LABEL_NAME') ?>
				</th>
				<th class="left nowrap" width="">
					<?php echo JText::_('COM_ORGRAPH_DEPT_LABEL_DESC'); ?>
				</th>
				<th class="nowrap" width="10%">
					<?php echo JText::_('COM_ORGRAPH_DEPT_LABEL_PARENT'); ?>
				</th>
				<th class="nowrap" width="5%">
					<?php echo JText::_('COM_ORGRAPH_DEPT_LABEL_ID'); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		foreach ($this->depts as $i => $dept) {
			$link=JRoute::_('index.php?option=com_orgraph&task=dept.edit&id='.$dept->id);
		?>
			<tr class="row<?php echo $i % 2; ?>">
				<td class="center">
					<?php echo JHtml::_('grid.id', $i, $dept->id); ?>
				</td>
				<td>
					<a href="<?php echo $link; ?>"><?php echo $dept->name; ?></a>
				</td>
				<td>
					<?php echo $dept->description; ?>
				</td>
				<td class="center">
					<?php echo $dept->parent_name; ?>
				</td>
				<td class="center"><?php echo $dept->id; ?></td>
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