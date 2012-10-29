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

		$("#orgraph_deptTree").on("click",".dept-tree-node>.node-detail:not(.selected)",function(e){
			// highlight selected
			$(".node-detail.selected").removeClass("selected");
			$detail=$(this);
			$detail.addClass("selected");
			// display basic info
			$rpanel=$("#orgraph_deptUsers").empty();
			$title=$('<h3 class="dept-name"></h3>');
			$title.text($detail.find(".name").text());
			$desc=$('<div class="dept-desc"></div>');
			$desc.text($detail.find(".desc").text());
			$rpanel.append($title).append($desc);
			// get members
			var $node=$(this).parent();
			var did=$node.attr("id").match(/\d+/)[0];
			$.getJSON('index.php',{
				option:"com_orgraph",
				task:"listDeptUsers",
				dept_id:did
			},function(users){
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
	<h2><?php echo JText::_('COM_ORGRAPH_GRAPH'); ?></h2>
	<div id="orgraph_deptTree"></div>
	<div id="orgraph_deptUsers"></div>
	<div style="clear:both"></div>
</div>