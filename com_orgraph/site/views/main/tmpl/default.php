<?php 
defined('_JEXEC') or die('Restricted access');
JHTML::stylesheet('style.css','components/com_orgraph/css/');
 ?>
<script type="text/javascript">
jQuery(function(){
	var deptTree=<?php echo json_encode($this->tree);?>;
	function createTree(dept,$tree){
		var $node=jQuery('<div class="dept-tree-node"><div class="node-detail"><div class="name"></div><div class="desc"></div></div><div class="children"></div></div>');
		$node.find('.name').text(dept.name);
		$node.find('.desc').text(dept.desc);
		$node.attr('id',dept.id);
		$tree.append($node);
		if(dept.children.length>0){
			for(var i=0;i<dept.children.length;i++){
				createTree(dept.children[i],$node.children('.children'));
			}
		}
	}
	for(var i=0;i<deptTree.length;i++){
		createTree(deptTree[i],jQuery("#orgraph_deptTree"));
	}
});
</script>
<div id="orgraph_deptTree">
</div>