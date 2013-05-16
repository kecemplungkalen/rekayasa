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
						url : '<?php echo base_url()?>config/user/cek'
					}					
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
				password : {
					required: true,
					minlength : 6,				
				},
				password2 : {
					required: true,
					equalTo : '#password',					
				},
				role : {
					required: true,					
				},
				
			},
			
			messages: {
				username :{
					remote:'Usrname Was Used By Other User',
				},
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
				$('#api_key_show').val(data);
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
			$.post('<?php echo base_url()?>config/user/add_user',$('#add_usr').serialize(),function(data){
				console.log(data);
			});
		}
	}
</script>
<div id="adduser" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>User Management</h3>
	</div>
	<div class="modal-body">
		<form class="form-horizontal" id="add_usr">
			<div class="control-group">
				<label class="control-label">First Name </label>
				<div class="controls ">
					<input type="text" class="input-medium" name="first_name" id="first_name" placeholder="First Name">
				</div>				
			</div>

			<div class="control-group">
				<label class="control-label">Last Name</label>
				<div class="controls">
					<input type="text" class="input-medium" name="last_name" id="last_name" placeholder="Last Name">
				</div>				
			</div>
			
			<div class="control-group">
				<label class="control-label">Username</label>
				<div class="controls">
					<input type="text" class="input-medium" name="username" id="username" placeholder="Username">
				</div>				
			</div>
			
			<div class="control-group">
				<label class="control-label">Password</label>
				<div class="controls">
					<input type="password" name="password" id="password" class="input-medium" placeholder="Password">
				</div>				
			</div>
			<div class="control-group">
				<label class="control-label">Repeat Password</label>
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
						<input type="radio" name="role" id="role_<?php echo $r->id_role?>" value="<?php echo $r->id_role?>">
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
					<input type="radio" name="status" id="status1" value="1" >>
						Active
					</label>
					<label class="radio inline">
					<input type="radio" name="status" id="status2" value="0">
						Suspend
					</label>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">API Access</label>
				<div class="controls">
					<label class="radio inline">
					<input type="radio" name="status_api" id="status_api1" value="1">
						Enable
					</label>
					<label class="radio inline">
					<input type="radio" name="status_api" id="status_api2" value="0">
						Disable
					</label>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">API Key</label>
				<div class="controls">
					<input class="input-large" type="hidden" name="api_key" id="api_key">
					<input class="input-large" type="text" name="api_key_show" id="api_key_show" disabled>
					<label class="inline"><a class="btn" onclick="generate_rand()"><i class="icon-refresh"></i></a> Re-New</label>
				</div>				
			</div>
			<div class="control-group">
				<label class="control-label">IP Restriction</label>
				<div class="controls">
					<div id="ip_acc">
					<input type="text" class="input-medium" name="ip[]" placeholder="127.0.0.1">
					</div>
					<a class="btn" onclick="add_ip()"><i class="icon-plus-sign"></i></a>
				</div>
			</div>


		</form>
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
