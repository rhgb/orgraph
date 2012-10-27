<?php 
defined('_JEXEC') or die('Restricted access');
JHTML::stylesheet('style.css','components/com_orgraph/css/');
 ?>
<script type="text/javascript">
(function($){
	$(function(){
		$.getJSON('index.php',{
			option:"com_orgraph",
			task:"listDeptTree"
		},function(deptTree){
			if(deptTree=="null"){
				console.debug("Error retrieving dept tree");
				return false;
			}

			function createTree(dept,$tree){	// recursively generate dept tree
				var $node=$('<div class="dept-tree-node"><div class="node-detail"><div class="name"></div><div class="desc"></div></div><div class="children"></div></div>');
				$node.find('.name').text(dept.name);
				$node.find('.desc').text(dept.desc);
				$node.attr('id',"dept_"+dept.id);
				$tree.append($node);
				if(dept.children.length>0){
					for(var i=0;i<dept.children.length;i++){
						createTree(dept.children[i],$node.children('.children'));
					}
				}
			}

			for(var i=0;i<deptTree.length;i++){
				createTree(deptTree[i],$("#orgraph_deptTree"));
			}

			$("#orgraph_deptTree .children:has(div)").each(function(){
				var $con=$('<div class="tree-connect-hr"></div><div class="tree-connect"></div>');
				var $chfirst=$(this).children().first();
				var $chlast=$(this).children().last();
				var chpadding=Number($chfirst.css("padding-left").match(/\d+/));
				$con.filter(".tree-connect").css("margin-left",$chfirst.width()/2+chpadding);
				$con.filter(".tree-connect").css("margin-right",$chlast.width()/2+chpadding-1);
				$(this).children(".dept-tree-node").each(function(){
					$(this).prepend('<div class="tree-connect-hr"></div>');
				});
				$(this).prepend($con);
			});
			$("#orgraph_deptUsers").css("min-height",$("#orgraph_deptTree").height());
		});

		$("#orgraph_deptTree").on("click",".dept-tree-node>.node-detail>.name",function(e){
			var $node=$(this).parent().parent();
			var did=$node.attr("id").match(/\d+/)[0];
			$.getJSON('index.php',{
				option:"com_orgraph",
				task:"listDeptUsers",
				dept_id:did
			},function(users){
				$("#orgraph_deptUsers").empty();
				for(var i=0; i<users.length; i++){
					var $usernode=$('<div class="dept-user-node"><div class="name"></div><div class="position"></div></div>');
					$usernode.children(".name").text(users[i].name);
					$usernode.children(".position").text(users[i].position);
					$("#orgraph_deptUsers").append($usernode);
				}
			});
		});
	});
})(jQuery);
</script>
<div class="container">
	<div id="orgraph_deptTree"></div>
	<div id="orgraph_deptUsers"></div>
	<div style="clear:both"></div>
</div>