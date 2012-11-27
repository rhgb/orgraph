<?php 
defined('_JEXEC') or die('Restricted access');
JHTML::stylesheet('main.css','components/com_orgraph/css/');
 ?>
<script type="text/javascript">
(function($){
	$(function(){
		$("#orgraph_tree_container .children:has(div)").each(function(){
			var $con=$(this).children(".tree-connect");
			var $chfirst=$(this).children(".tree-node").first();
			var $chlast=$(this).children(".tree-node").last();
			var chpadding=Number($chfirst.css("padding-left").match(/\d+/));
			$con.css("margin-left",$chfirst.width()/2+chpadding);
			$con.css("margin-right",$chlast.width()/2+chpadding-1);
		});
		$("#orgraph_users_container").css("min-height",$("#orgraph_tree_container").height());

		$("#orgraph_tree_container").on("click",".tree-node>.node-detail:not(.selected)",function(e){
			// highlight selected
			$(".node-detail.selected").removeClass("selected");
			$detail=$(this);
			$detail.addClass("selected");
			// display basic info
			$rpanel=$("#orgraph_users_container").empty();
			$title=$('<h3 class="node-name"></h3>');
			$title.text($detail.find(".name").text());
			$desc=$('<div class="node-desc"></div>');
			$desc.text($detail.find(".desc").text());
			$rpanel.append($title).append($desc);
			// get members
			var $node=$(this).parent();
			var did=$node.attr("id").match(/\d+/)[0];
			$.getJSON('index.php',{
				option:"com_orgraph",
				task:"listUsers",
				series:"<?php echo $this->series; ?>",
				id:did
			},function(users){
				for(var i=0; i<users.length; i++){
					var $usernode=$('<div class="user-node"><div class="name"><a></a></div><div class="position"></div><div class="dept"></div></div>');
					$usernode.children(".name").children().attr("href","index.php?option=com_orgraph&view=userdetail&id="+users[i].user_id).text(users[i].name);
					$usernode.children(".position").text(users[i].position);
					$usernode.children(".dept").text(users[i].dept);
					$("#orgraph_users_container").append($usernode);
				}
			});
		});
	});
})(jQuery);
</script>
<div class="container">
	<h1><?php echo JText::_('COM_ORGRAPH_GRAPH'); ?></h1>
	<div id="orgraph_tree_container" class="<?php echo $this->series; ?>">
		<?php function createTree($node, $ischild = true) { ?>
			<div class="tree-node" id="node_<?php echo $node->id; ?>">
				<?php if($ischild) : ?>
					<div class="tree-connect-hr"></div>
				<?php endif; ?>
				<div class="node-detail">
					<div class="name"><?php echo $node->name; ?></div>
					<div class="desc"><?php echo $node->desc; ?></div>
				</div>
				<div class="children">
					<?php if(!empty($node->children)) : ?>
						<div class="tree-connect-hr"></div>
						<div class="tree-connect"></div>
					<?php
						foreach ($node->children as $d) {
							createTree($d);
						}
					endif;
					?>
				</div>
			</div>
		<?
		}
		foreach ($this->tree as $node) {
			createTree($node, false);
		}
		?>
	</div>
	<div id="orgraph_users_container" class="<?php echo $this->series; ?>"></div>
	<div style="clear:both"></div>
</div>