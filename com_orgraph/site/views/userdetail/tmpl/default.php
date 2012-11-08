<?php 
defined('_JEXEC') or die('Restricted access');
JHTML::stylesheet('userdetail.css','components/com_orgraph/css/');
?>
	<h1><?php echo $this->user->name; ?></h1>
<table class="user-detail">
	<col class="desc" />
	<col class="content" />
	<tbody>
		<tr>
			<td><?php echo JText::_('COM_ORGRAPH_USER_EMPLOYEE_NO'); ?></td>
			<td><?php echo $this->user->employee_no; ?></td>
		</tr>
		<tr>
			<td><?php echo JText::_('COM_ORGRAPH_USER_DEPT'); ?></td>
			<td><?php echo $this->user->dept; ?></td>
		</tr>
		<tr>
			<td><?php echo JText::_('COM_ORGRAPH_USER_POS'); ?></td>
			<td><?php echo $this->user->position; ?></td>
		</tr>
		<?php if (!empty($this->user->supervisor_id) && (int)$this->user->supervisor_id != 0) : ?>
		<tr>
			<td><?php echo JText::_('COM_ORGRAPH_USER_SUPERVISOR') ?></td>
			<td><a href="<?php echo JRoute::_('index.php?option=com_orgraph&view=UserDetail&id='.$this->user->supervisor_id); ?>"><?php echo $this->user->supervisor; ?></a></td>
		</tr>
		<?php endif; ?>
		<tr>
			<td><?php echo JText::_('COM_ORGRAPH_USER_BIRTHDAY'); ?></td>
			<td><?php echo $this->user->birthday; ?></td>
		</tr>
		<tr>
			<td><?php echo JText::_('COM_ORGRAPH_USER_TEL'); ?></td>
			<td><?php echo $this->user->tel; ?></td>
		</tr>
		<tr>
			<td><?php echo JText::_('COM_ORGRAPH_USER_MOBILE'); ?></td>
			<td><?php echo $this->user->mobile; ?></td>
		</tr>
		<tr>
			<td><?php echo JText::_('COM_ORGRAPH_USER_LOCATION'); ?></td>
			<td><?php echo $this->user->location; ?></td>
		</tr>
		<tr>
			<td><?php echo JText::_('COM_ORGRAPH_USER_COMP_ID'); ?></td>
			<td><?php echo $this->user->computer_id; ?></td>
		</tr>
	</tbody>
</table>