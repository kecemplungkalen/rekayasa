<script>
	
	function add_user()
	{
		$.post('<?php echo base_url();?>address/add_address',function(data){
			
			$('#show_modal').html(data);
			$('#addaddress').modal('show');
			});
	}
	
	function group_manage()
	{
		$.post('<?php echo base_url();?>address/group_manage',function(data){
			
			$('#show_modal').html(data);
			$('#groupmgmt').modal('show');
			});
	}
	
	
	function edit_address(id_address_book)
	{
		$.post('<?php echo base_url();?>address/edit_address/'+id_address_book,function(data){
			
			$('#show_modal').html(data);
			$('#editaddress').modal('show');
		});
	}
	
	
	$(document).ready(function(){
		
		$('#hapus_address').click(function(){
			var id =  $('.address_list:checkbox').map(function() {
				if(this.checked){
				   return this.value;
				  }
			}).get();
		
		$.post('<?php echo base_url();?>address/hapus_address',{id:id},function(){
			
					location.reload();
			
		});
			
		});
		
		$('form#search_address').submit(function(){
			//$('#search_address').serialize();
			$.post('<?php echo base_url();?>address/address_search',$('#search_address').serialize(),function(data) {
				
				console.log($('#search_address').serialize());
			}); 
							return false;

		});
		
	});

	
</script>

<div class="btn-group">
	<a class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> <span class="caret"></span></a>
	<ul class="dropdown-menu">
		<li>
			<a href=""><input type="checkbox" >&nbsp;&nbsp;<span class="label badge-b6cff5">&nbsp;&nbsp;&nbsp;&nbsp;</span> User Ngawur</a>
		</li>
		<li>
			<a href=""><input type="checkbox">&nbsp;&nbsp;<span class="label badge-e3d7ff">&nbsp;&nbsp;&nbsp;&nbsp;</span> User Ra Genah</a>
		</li>
		<li class="divider"></li>
		<li>
			<a href="#" onclick="add_user()">Add User</a>
		</li>
		<li>
			<a href="#" onclick="group_manage()">Manage Groups</a>
		</li>
	</ul>
	<a class="btn" id="hapus_address"><i class="icon-trash"></i></a>
</div>
<form class="form-search pull-right" id="search_address">
  <input name="keyword" type="text" class="input-medium search-query" placeholder="Search keyword ...	">
  <button type="submit" class="btn">Search</button>
</form>
<hr>
<ul class="breadcrumb">
	<li>
		<a href="<?php echo base_url();?>">Dashboard</a>
		<span class="divider">/</span> 
	</li>
	<li class="active">Address Book</li>
</ul>
