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
				<th class="nowrap" width="5%">
					<?php echo JHtml::_('grid.sort', 'Title', 'd.name', $this->sortDirection, $this->sortColumn); ?>
				</th>
				<th class="nowrap" width="">
					<?php echo JHtml::_('grid.sort', 'Description', 'd.description', $this->sortDirection, $this->sortColumn); ?>
				</th>
				<th class="nowrap" width="5%">
					<?php echo JHtml::_('grid.sort', 'Parent', 'p.name', $this->sortDirection, $this->sortColumn); ?>
				</th>
				<th class="nowrap" width="5%">
					<?php echo JHtml::_('grid.sort', 'Id', 'd.id', $this->sortDirection, $this->sortColumn); ?>
				</th>
			</tr>
		</thead>
	</table>
</form>