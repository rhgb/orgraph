<?php 
defined('_JEXEC') or die('Restricted access');
JHTML::stylesheet('main.css','components/com_orgraph/css/');
 ?>
<!--[if lte IE 7]>
<script type="text/javascript">
(function($){
	$(function(){
		function updateWidth($tn) {
			var $children = $tn.children('.children').children('.tree-node');
			var nwidth = 0;
			if ($children.length) {
				for (var i = 0; i < $children.length; i++) {
					nwidth += updateWidth($children.eq(i));
				}
			} else {
				nwidth = 102;
			}
			$tn.width(nwidth);
			return nwidth+10;
		}
		updateWidth($('#orgraph_tree_container>.tree-node'));
	});
})(jQuery);
</script>
<![endif]-->
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
			var $detail=$(this);
			$detail.addClass("selected");
			// display basic info
			var $tbody = $("#orgraph_users_container .user-table>tbody").empty();
			$('#orgraph_users_container .node-name').text($detail.find(".name").text());
			$('#orgraph_users_container .node-desc').text($detail.find(".desc").text());
			// get members
			var $node=$(this).parent();
			var did=$node.attr("id").match(/\d+/)[0];
			$.getJSON('index.php',{
				option:"com_orgraph",
				task:"listUsers",
				series:"<?php echo $this->series; ?>",
				id:did
			},function(users) {
				users.sort(function(a,b){
					if (a.level == b.level) {
						if (b.position > a.position)
							return 1;
						else if (b.position < a.position)
							return -1;
						else
							return 0;
					} else {
						return Number(b.level) - Number(a.level);
					}
				});
				var $rowtemp = $('<tr><td class="name"><a></a></td><td class="position"></td><td class="dept"></td></tr>');
				$itemid = document.location.search.match(/\bItemid=[0-9]+/);
				if($itemid == null)
					$itemid = "";
				else
					$itemid = "&" + $itemid[0];
				for(var i=0; i<users.length; i++) {
					var $i = users[i];
					var $row = $rowtemp.clone();
					$row.addClass('l'+$i.level);
					$row.find(".name>a").attr("href","index.php?option=com_orgraph&view=userdetail&id="+$i.user_id+$itemid).text($i.name);
					$row.children(".position").text($i.position);
					$row.children(".dept").text($i.dept);
					$tbody.append($row);
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
	<div id="orgraph_users_container" class="<?php echo $this->series; ?>">
		<h3 class="node-name"></h3>
		<div class="node-desc"></div>
		<table class="user-table">
			<col class="name" />
			<col class="position" />
			<col class="dept" />
			<tbody></tbody>
		</table>
	</div>
	<div style="clear:both"></div>
</div>