<script type="text/javascript">
	
	$(document).ready(function(){
		
		$('#add_user').click(function(){
			$.get('<?php echo base_url();?>config/user/add_user_modal',function(data){
				$('#show_modal').html(data);
				$('#adduser').modal('show');
			});
		});

	
	});
	function edit_user(id_user)
	{
		$.post('<?php echo base_url()?>config/user/edit_user_modal',{id_user:id_user},function(data){
				$('#show_modal').html(data);
				$('#edituser').modal('show');
		});
	}

</script>

<div id="user" class="tab-pane">
	<legend>User</legend>
	<div class="btn-group">
		<a class="btn dropdown-toggle" rel="tooltip" data-original-title="Add User" id="add_user">+<i class="icon-user"></i></a>
		<a class="btn"><i class="icon-trash"></i></a>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<td><input type="checkbox" id="c"></input></td>
				<td><strong>Username</strong></td>
				<td><strong>Role</strong></td>
				<td><strong>API Access</strong></td>
			</tr>
		</thead>
		<tbody>
		<?php if(isset($data)){?>
			<?php for($i=0;$i < count($data);$i++){?>
			
			<tr>
				<td><input type="checkbox" value="<?php echo $data[$i]['id_user'];?>"></input></td>
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
