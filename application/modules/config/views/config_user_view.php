<?php $role_id = $this->session->userdata('level');?>
<script type="text/javascript">
	
	$(document).ready(function(){
		
		$('#add_user').click(function(){
			$.get('<?php echo base_url();?>config/user/add_user_modal',function(data){
				$('#show_modal').html(data);
				$('#adduser').modal('show');
			});
		});
		
		$('#hapus_user').click(function(){
			var ulist =  $('.user_list:checkbox').map(function() {
				if(this.checked){
				   return this.value;
				  }
			}).get();
			
			if(ulist != '')
			{
				$.post('<?php echo base_url();?>config/user/hapus_user',{user_list:ulist},function(data){
					if(data == 'true')
					{
						window.location.href += "user";
						location.reload();
					}
				});
				
			}
			
		});
		
		$('#alert_hapus_user').click(function(){
			var ceklist =  $('.user_list:checkbox').map(function() {
				if(this.checked){
				   return this.value;
				  }
			}).get();
			if(ceklist != '')
			{
				$('#hapus_konfirm').modal('show');
			}
			
		});
	
	});
	
	function edit_user(id_user)
	{
		$.post('<?php echo base_url()?>config/user/edit_user_modal',{id_user:id_user},function(data){
				if(data != '')
				{
					$('#show_modal').html(data);
					$('#edituser').modal('show');
				}else
				{
					$('#noacc').modal('show');
				}
		});
	}
	
	function checkall()
	{
		var action = 'cek';
		if($('#checkall_user').attr('checked'))
		{
			action = 'uncek';
			$('#checkall_user').removeAttr('checked');
		}else{
			$('#checkall_user').attr('checked','checked');
		}
		
		$('.user_list:checkbox').map(function() {
			if(action == 'cek'){
				$("#"+this.id).prop('checked', true);
			}else{
				$("#"+this.id).prop("checked",false);
			}
		});
	}

</script>

<div id="user" class="tab-pane">
	<legend>User</legend>
	<?php if($role_id == '1'){?>
	<div class="btn-group">
		<a class="btn dropdown-toggle" rel="tooltip" data-original-title="Add User" id="add_user">+<i class="icon-user"></i></a>
		<a class="btn" id="alert_hapus_user" ><i class="icon-trash"></i></a>
	</div>
	<?php }?>
	<table class="table table-striped">
		<thead>
			<tr>
				<td><input type="checkbox" id="checkall_user" onclick="checkall()"></input></td>
				<td><strong>Username</strong></td>
				<td><strong>Role</strong></td>
				<td><strong>API Access</strong></td>
			</tr>
		</thead>
		<tbody>
		<?php if(isset($data)){?>
			<?php for($i=0;$i < count($data);$i++){?>
			
			<tr>
				<td><input class="user_list" type="checkbox"  value="<?php echo $data[$i]['id_user'];?>" id="user_id_<?php echo $data[$i]['id_user'];?>"></input></td>
				<td><a href="#" onclick="edit_user('<?php echo $data[$i]['id_user'];?>')" class="edit_user" data-value="<?php echo $data[$i]['id_user'];?>"><?php echo $data[$i]['username'];?></a></td>
				<td><?php echo $data[$i]['level'];?></td>
				<td>
					<?php if($data[$i]['api'] == '0'){?> 
					<?php echo 'No';?>
					<?php }else{?>
					<?php echo 'Yes' ;?>
					<?php }?>
				</td>
			</tr>
			
			<?php }?>
		<?php }?>
		</tbody>
	</table>
</div>

<div id="hapus_konfirm" class="modal hide fade">
	<div class="modal-body">
		<h6>Delete This User?</h6>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
		<a href="#" class="btn btn-danger" id="hapus_user"> Delete </a>
	</div>
</div>
