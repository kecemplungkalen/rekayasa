<?php if($user){?>
<script type="text/javascript">
	
	$(document).ready(function(){
		
		$('#add_usr').validate({
			rules: {
				first_name: {
					required: true,
					minlength :3,
				},
				last_name: {
					required: true,
					minlength :3,
				},
				username: {
					required: true,
					minlength :3,
					remote :
					{
						type: 'post',
						url : '<?php echo base_url()?>config/user/cek/<?php echo $user->id_user;?>'
					},
				},
				status : {
					required: true,
				},
				status_api : {
					required: true,
				},
				api_key : {
					required: true,
				},
				ip : {
					required: true,
				},
				password1 : {
					minlength : 6,				
				},
				password2 : {
					equalTo : '#password1',					
				},
				role : {
					required: true,					
				},
				
			},
			
			messages: {
				username :{
					remote:'Username Was Used By Other User'
				}
			},			
			highlight: function(element) {
					$(element).closest('.control-group').removeClass('success').addClass('error');
			},
			
			success: function(element) {
					element
					.addClass('valid')
					.closest('.control-group').removeClass('error').addClass('success');
			}
		});
		
	});
	
	function generate_rand()
	{
		$.post('<?php echo base_url()?>config/user/rand_key',function(data){
			if(data.length == 32)
			{
				$('#api_key').val(data);
				$('#api_key_show').html(data);
			}
			
		});
	}
	
	var initID = 0;
	function add_ip()
	{
		var num = initID++;
		$('#ip_acc').append('<div id="inp'+num+'"><input type="text" class="input-medium" name="ip[]" placeholder="127.0.0.1"><a class="btn" onclick="remove_id(\'inp'+num+'\')"><i class="icon-minus-sign"></i></a></div>');
	}
	
	function remove_id(item_id)
	{
		var remove = eval(item_id);
		$(remove).remove();
	}	

	function save()
	{
		var valid = $('#add_usr').valid();
		if(valid == true)
		{
			$.post('<?php echo base_url()?>config/user/edit_user',$('#add_usr').serialize(),function(data){
				if(data = 'true')
				{
					window.location.href += "user";
					location.reload();										
				}
			});
		}
	}
</script>
<div id="edituser" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>User Management</h3>
	</div>
	<div class="modal-body">
		
		<form class="form-horizontal" id="add_usr">
			<input type="hidden" name="id_user"  value="<?php if($user->id_user){ echo $user->id_user; }?>">
			<div class="control-group">
				<label class="control-label">First Name </label>
				<div class="controls ">
					<input type="text" class="input-medium" name="first_name" id="first_name" placeholder="First Name" value="<?php if($user->first_name){ echo $user->first_name; }?>">
				</div>				
			</div>

			<div class="control-group">
				<label class="control-label">Last Name</label>
				<div class="controls">
					<input type="text" class="input-medium" name="last_name" id="last_name" placeholder="Last Name" value="<?php if($user->last_name){ echo $user->last_name; }?>">
				</div>				
			</div>
			
			<div class="control-group">
				<label class="control-label">Username</label>
				<div class="controls">
					<input type="text" class="input-medium" name="username" id="username" placeholder="Username" value="<?php if($user->username){ echo $user->username; }?>">
				</div>				
			</div>

			<div class="control-group">
				<label class="control-label">New Password</label>
				<div class="controls">
					<input type="password" name="password1" id="password1" class="input-medium" placeholder="Password">
				</div>				
			</div>
			<div class="control-group">
				<label class="control-label">Repeat New Password</label>
				<div class="controls">
					<input type="password" name="password2" id="password2" class="input-medium" placeholder="Password">
				</div>				
			</div>

			<div class="control-group">
				<label class="control-label">Role</label>
				<div class="controls">
				<?php if(isset($role)){?>
					<?php foreach($role as $r){?>
						<label class="radio">
						<input type="radio" name="role" id="role_<?php echo $r->id_role?>" value="<?php echo $r->id_role?>" <?php if($user->level == $r->id_role){ echo 'checked'; }?> >
							<?php echo $r->level;?>
						</label>
					<?php } ?>
				
				<?php }?>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Status</label>
				<div class="controls">
					<label class="radio inline">
					<input type="radio" name="status" id="status1" value="1" <?php if($user->status == '1'){ echo 'checked';}?>>
						Active
					</label>
					<label class="radio inline">
					<input type="radio" name="status" id="status2" value="0" <?php if($user->status == '0'){ echo 'checked';}?>>
						Suspend
					</label>
				</div>
			</div>
			
			<?php //if(){?>
			<div class="control-group">
				<label class="control-label">API Access</label>
				<div class="controls">
					<label class="radio inline">
					<input type="radio" name="status_api" id="status_api1" value="1" <?php if($user->api == '1'){ echo 'checked';}?> >
						Enable
					</label>
					<label class="radio inline">
					<input type="radio" name="status_api" id="status_api2" value="0" <?php if($user->api == '0'){ echo 'checked';}?> >
						Disable
					</label>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">API Key</label>
				<div class="controls">
					<input class="input-large" type="hidden" name="api_key" id="api_key" value="<?php if($user->api_key){ echo $user->api_key; }?>">
					<label ><strong id="api_key_show"><?php if($user->api_key){ echo $user->api_key; }?></strong></label>
					<label class="inline"><a class="btn" onclick="generate_rand()"><i class="icon-refresh"></i></a> Re-New</label>
				</div>				
			</div>
			<div class="control-group">
				<label class="control-label">IP Restriction</label>
				<div class="controls">
					<div id="ip_acc">
					<?php if($ip){?>	
					<?php foreach($ip as $ipz){?>
						<br><input type="text" class="input-medium" name="ip[]" placeholder="127.0.0.1" value="<?php echo $ipz->ip_restriction; ?>">
					<?php  }?>
					<?php } ?>
					</div>
					<a class="btn" onclick="add_ip()"><i class="icon-plus-sign"></i></a>
				</div>
			</div>
		</form>
<?php } ?>
	</div>
	<div class="modal-footer">
			<div class="control-group" align="right">
				<button class="btn btn-primary" onclick="save()">Save</button>
			<!--	<button class="btn btn-success">Enable</button> 
				<button class="btn btn-warning">Disable</button>
				<button class="btn btn-danger">Delete</button>-->
				<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
			</div>
	</div>
</div>
