<?php 
defined('_JEXEC') or die('Restricted access');
JHTML::_('behavior.tooltip');
JFormHelper::addFieldPath(JPATH_COMPONENT . '/models/fields');
$deptField = JFormHelper::loadFieldType('userdeptlist', false);
$depts = $deptField->getOptions();
?>
<form action="<?php echo JRoute::_('index.php?option=com_orgraph&view=users'); ?>" method="post" name="adminForm" id="adminForm">
	<fieldset id="filter-bar">
		<div class="filter-search fltlft">
			<label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
			<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>" title="<?php echo JText::_('COM_ORGRAPH_USER_FILTER_NAME'); ?>" />
			<button type="submit"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			<button type="button" onclick="document.id('filter_search').value='';this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
		</div>
		<div class="filter-select fltrt">
			<select name="filter_deptId" class="inputbox" onchange="this.form.submit()">
				<option value=""> - <?php echo JText::_('COM_ORGRAPH_USER_FILTER_DEPT') ?> - </option>
				<?php echo JHtml::_('select.options', $depts, 'value', 'text', $this->state->get('filter.deptId'));?>
			</select>

		</div>
		<div class="clr"></div>
	</fieldset>

	<table class="adminlist">
		<thead>
			<tr class="sortable">
				<th width="1%">
					<input type="checkbox" name="toggle" value="" onclick="checkAll(this);" />
				</th>
				<th width="1%">
					<?php echo JHTML::_('grid.sort', '&equiv;', 'level', $this->sortDirection, $this->sortColumn); ?>
				</th>
				<th class="left nowrap">
					<?php echo JHTML::_('grid.sort', 'COM_ORGRAPH_USER_LABEL_NAME', 'name', $this->sortDirection, $this->sortColumn); ?>
				</th>
				<th class="nowrap" width="10%">
					<?php echo JHTML::_('grid.sort', 'COM_ORGRAPH_USER_LABEL_POS', 'position', $this->sortDirection, $this->sortColumn); ?>
				</th>
				<th class="nowrap" width="10%">
					<?php echo JHTML::_('grid.sort', 'COM_ORGRAPH_USER_LABEL_DEPT', 'dept', $this->sortDirection, $this->sortColumn); ?>
				</th>
				<th class="nowrap" width="10%">
					<?php echo JHTML::_('grid.sort', 'COM_ORGRAPH_USER_LABEL_EMPLOYEE_NO', 'employee_no', $this->sortDirection, $this->sortColumn); ?>
				</th>
				<th class="nowrap" width="10%">
					<?php echo JHTML::_('grid.sort', 'COM_ORGRAPH_USER_LABEL_SUPERVISOR', 'supervisor', $this->sortDirection, $this->sortColumn); ?>
				</th>
				<th class="nowrap" width="10%">
					<?php echo JHTML::_('grid.sort', 'COM_ORGRAPH_USER_LABEL_TEL', 'tel', $this->sortDirection, $this->sortColumn); ?>
				</th>
				<th class="nowrap" width="10%">
					<?php echo JHTML::_('grid.sort', 'COM_ORGRAPH_USER_LABEL_MOBILE', 'mobile', $this->sortDirection, $this->sortColumn); ?>
				</th>
				<th class="nowrap" width="10%">
					<?php echo JHTML::_('grid.sort', 'COM_ORGRAPH_USER_LABEL_COMP_ID', 'computer_id', $this->sortDirection, $this->sortColumn); ?>
				</th>
				<th class="nowrap" width="5%">
					<?php echo JHTML::_('grid.sort', 'COM_ORGRAPH_USER_LABEL_LOCATION', 'location', $this->sortDirection, $this->sortColumn); ?>
				</th>
				<th class="nowrap" width="10%">
					<?php echo JHTML::_('grid.sort', 'COM_ORGRAPH_USER_LABEL_BIRTHDAY', 'birthday', $this->sortDirection, $this->sortColumn); ?>
				</th>
			</tr>
		</thead>
		<tfoot>
			<tr><td colspan="12">
				<?php echo $this->pagination->getListFooter(); ?>
			</td></tr>
		</tfoot>
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
		<input type="hidden" name="filter_order" value="<?php echo $this->sortColumn; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $this->sortDirection; ?>" />
	</div>
</form>