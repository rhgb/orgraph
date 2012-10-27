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
					Name
				</th>
				<th class="nowrap" width="10%">
					Position
				</th>
				<th class="left nowrap" width="">
					Department
				</th>
				<th class="nowrap" width="5%">
					id
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
				<td>
					<a href="<?php echo $link; ?>"><?php echo $user->name; ?></a>
				</td>
				<td class="center">
					<?php echo $user->position; ?>
				</td>
				<td>
					<?php echo $user->dept; ?>
				</td>
				<td class="center"><?php echo $user->record_id; ?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
	<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
	</div>
</form>