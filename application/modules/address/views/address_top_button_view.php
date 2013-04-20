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
	<li class="active">Address Book</li>
</ul>
