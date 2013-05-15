<div id="adduser" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>User Management</h3>
	</div>
	<div class="modal-body">
		<form class="form-horizontal">
			<div class="control-group">
				<label class="control-label">Username</label>
				<div class="controls">
					<input type="text" class="input-medium" placeholder="Username">
				</div>				
			</div>
			
			<div class="control-group">
				<label class="control-label">Status</label>
				<div class="controls">
					<label class="radio inline">
					<input type="radio" name="status" id="status1" value="1" checked>
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
					<input type="radio" name="status_api" id="status_api1" value="1" checked>
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
					<label><strong>asdfiusayf7687ewrkjweftsakkjjuuh</strong></label>
					<label class="inline"><a class="btn"><i class="icon-refresh"></i></a> Re-New</label>
				</div>				
			</div>
			<div class="control-group">
				<label class="control-label">IP Restriction</label>
				<div class="controls">
					<input type="text" class="input-medium" placeholder="127.0.0.1">
					<a class="btn" ><i class="icon-plus-sign"></i></a>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">New Password</label>
				<div class="controls">
					<input type="text" class="input-medium" placeholder="Password">
				</div>				
			</div>
			<div class="control-group">
				<label class="control-label">Repeat New Password</label>
				<div class="controls">
					<input type="text" class="input-medium" placeholder="Password">
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

		</form>
	</div>
	<div class="modal-footer">
			<div class="control-group" align="right">
				<button class="btn btn-primary">Save</button>
				<button class="btn btn-success">Enable</button>
				<button class="btn btn-warning">Disable</button>
				<button class="btn btn-danger">Delete</button>
				<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
			</div>
	</div>
</div>
