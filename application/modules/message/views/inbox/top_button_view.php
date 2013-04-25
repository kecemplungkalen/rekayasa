<script type="text/javascript">
	
	$(document).ready(function(){
		
		$('form#search').submit(function(event){
			event.preventDefault();
			$.post('<?php echo base_url();?>message/<?php if($label){ echo $label; } ?>/',$('#search').serialize()+"&reload=1",function(data) {
				$("#tampil_data").html(data);
				applyPagination();
			});
		});
	
	});
		
</script>

<div class="btn-group">
	<a class="btn"><i class="icon-hdd" ></i></a>
	<a class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-tags"></i> <span class="caret"></span></a>
	<ul class="dropdown-menu">
		<?php if(isset($list_label)){?>
		<?php foreach($list_label as $ll){?>
			<li>
				<a href="#"><input type="checkbox" value="<?php echo $ll->id_labelname;?>" >&nbsp;&nbsp;<span class="label badge-<?php echo $ll->color;?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <?php echo $ll->name;?></a>
			</li>
		
		<?php }?>
		<?php }?>
		<li class="divider"></li>
		<li>
			<a href="">Manage Labels</a>
		</li>
	</ul>
	<a class="btn"><i class="icon-trash"></i></a>
</div>
<form class="form-search pull-right" id="search">
  <input type="hidden" name="label" value="<?php if($label){ echo $label; } ?>">
  <input type="text" name="keyword" class="input-medium search-query" placeholder="Search keyword ...	">
  <button type="submit" class="btn">Search</button>
</form>
<hr>
<ul class="breadcrumb">
	<li>
		<a href="#">Dashboard</a>
		<span class="divider">/</span> 
	</li>
	<li class="active"><?php if($label){ echo $label; } ?></li>
</ul> 
