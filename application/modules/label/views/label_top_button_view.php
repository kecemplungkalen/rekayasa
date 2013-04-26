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
		
		$('#hapus_label').click(function(){
			var id =  $('.label_list:checkbox').map(function() {
				if(this.checked){
				   return this.value;
				  }
			}).get();
		
			$.post('<?php echo base_url();?>label/hapus_label',{id:id},function(){
				
					//	location.reload();
					console.log(id);
				
			});
			
		});
		
		
		$('#checkall_label').click(function(){
			
			var action = 'cek';
			if($('#checkall_label').attr('checked'))
			{
				action = 'uncek';
				$('#checkall_label').removeAttr('checked');

			}else{
				$('#checkall_label').attr('checked','checked');
			}
			
			$('.label_list:checkbox').map(function() {
				if(action == 'cek'){
					//$("#"+this.id).removeAttr("checked");
					//$("#"+this.id).attr("checked","checked");
					//$('.checkbox input[type="checkbox"]').prop('checked', true);
					$("#"+this.id).prop('checked', true);
				}else{
					$("#"+this.id).removeAttr("checked");
				}
			});
		});

		
	});
	

</script>

<div class="btn-group">
	<a class="btn" id="label_add">+ <i class="icon-tags"></i></a>
	<a class="btn" id="hapus_label"><i class="icon-trash"></i></a>
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
