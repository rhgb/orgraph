<?php 
defined('_JEXEC') or die('Restricted access');
 ?>
<script type="text/javascript">
var deptTree=<?php echo json_encode($this->tree);?>;
console.debug(deptTree);
</script>
<div>
</div>