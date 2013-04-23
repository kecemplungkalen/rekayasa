<script>
	
	$(document).ready(function(){
		
		$('form#search_label').submit(function(){
			$.get('<?php echo base_url();?>label',$('#search_label').serialize(),function(data) {
				return data;
			}); 

		});
		
		$('#label_add').click(function(){
			
			$.get('<?php echo base_url();?>label/add_additional_label',function(data){
				
				$('#modal_show').html(data);
				$('#addlabel').modal('show');
			});
			
		});
		
	});
	

</script>

<div class="btn-group">
	<a class="btn" id="label_add">+ <i class="icon-tags"></i></a>
	<a class="btn"><i class="icon-trash"></i></a>
</div>
<form class="form-search pull-right" id="search_label">
  <input type="text" class="input-medium search-query" name="keyword" placeholder="Search keyword ...	">
  <button type="submit" class="btn">Search</button>
</form>
<hr>
<ul class="breadcrumb">
	<li>
		<a href="<?php echo base_url();?>">Dashboard</a>
		<span class="divider">/</span> 
	</li>
	<li class="active">Label<span class="divider">/</span></li>
	<li class="active">Additional Label</li>
</ul>
<a class="btn btn-primary pull-right" href="<?php echo base_url();?>label/system">Go to System Label</a>
