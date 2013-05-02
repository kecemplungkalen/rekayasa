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
	
	//		$('#checkall_address').click(function(){
	function checkall()
		{
			var action = 'cek';
			if($('#checkall_address').attr('checked'))
			{
				action = 'uncek';
				$('#checkall_address').removeAttr('checked');
				$('.centang_group').hide();	
			}else{
				$('#checkall_address').attr('checked','checked');
				$('.centang_group').show();	
			}
			
			$('.address_list:checkbox').map(function() {
				if(action == 'cek'){
					$("#"+this.id).prop('checked', true);
				}else{
					$("#"+this.id).removeAttr("checked");
				}
			});
		}
		//});
	
	
	$(document).ready(function(){
		
		$('#hapus_address').click(function(){
			var id =  $('.address_list:checkbox').map(function() {
				if(this.checked){
				   return this.value;
				  }
			}).get();
		
			$.post('<?php echo base_url();?>address/hapus_address',{id:id},function(){
				
						location.reload();
					//console.log(id);
				
			});
			
		});
		
		$('form#search_address').submit(function(event){
			event.preventDefault();
			$.post('<?php echo base_url();?>address',$('#search_address').serialize()+"&reload=1",function(data) {
				$("#tampil_data").html(data);
				applyPagination();
			});
		});
		
		
		$('#nama_group').click(function() {
			var ini = $(this);   
			if (ini.is(':checked')) {
				alert('ceked');
			} else {
				alert('uncek');
			}
		});
		
		$('.address_list').click(function() {
			var ini = $(this);

			var value =  $('.address_list:checkbox').map(function() {
					if(this.checked){
					   return this.value;
					  }
				}).get();   
			if (ini.is(':checked')) {
				console.log(value);
				$('.centang_group').show();				
			} else {
				console.log(value);
				$('.centang_group').hide();
			}
		});
		
		$('.dropdown-menu a#cebox').click(function(e) {
		  e.stopPropagation();
		});
		

		
	});

	
</script>

<div class="btn-group">
	<a class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> <span class="caret"></span></a>
	<ul class="dropdown-menu">
		<?php if(isset($data)) {?>
		<?php foreach($data as $dt) {?>
		<li id="centang_group_<?php echo $dt->id_groupname; ?>" class="centang_group hide">
			<a id="cebox"><input id="nama_group" type="checkbox" id="<?php echo $dt->id_groupname; ?>" value="<?php echo $dt->id_groupname; ?>" >&nbsp;&nbsp;<span class="label badge-<?php echo $dt->color ;?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <?php echo $dt->nama_group; ?></a>
		</li>
		<?php } ?>
		<?php } ?>
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
<form class="form-search pull-right" id="search_address" method="post">
  <input name="keyword" id="keyword" type="text" class="input-medium search-query" placeholder="Search keyword ...	">
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
