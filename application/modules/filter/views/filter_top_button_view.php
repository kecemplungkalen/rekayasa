<script>
	function add_filter()
	{
		$.get('<?php echo base_url();?>filter/add_filter_modal',function(data){
			
			$('#show_modal').html(data);
			$('#addfilter').modal('show');
		});
	}

</script>
<div class="btn-group">
	<a class="btn dropdown-toggle" onclick="add_filter()" >+ <i class="icon-th"></i></a>
	<a class="btn"><i class="icon-trash"></i></a>
</div>
<form class="form-search pull-right">
  <input type="text" class="input-medium search-query" placeholder="Search keyword ...	">
  <button type="submit" class="btn">Search</button>
</form>
<hr>
<ul class="breadcrumb">
	<li>
		<a href="#">Dashboard</a>
		<span class="divider">/</span> 
	</li>
	<li class="active">Filter</li>
</ul>
