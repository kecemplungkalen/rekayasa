<div id="addmodem" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Modem Management</h3>
	</div>
	<div class="modal-body">
		<form class="form-horizontal">
			<div class="control-group">
				<label class="control-label">Modem Name</label>
				<div class="controls">
					<input type="text" class="input-medium" name="nama_modem" placeholder="Modem Name">
				</div>				
			</div>
			<div class="control-group">
				<label class="control-label">Phone ID</label>
				<div class="controls">
					<select name="phoneID">
						<?php if($id_phone){?>
							<?php for($i=0;$i < count($id_phone);$i++){?>
							<option value="<?php echo $id_phone[$i]['imei'];?>"><?php echo $id_phone[$i]['modem'];?></option>
							<?php }?>
						<?php }?>
					</select>
				</div>				
			</div>
			<div class="control-group">
				<label class="control-label">Phone Number</label>
				<div class="controls">
					<input type="text" class="input-medium" name="number" placeholder="Phone Number">
				</div>				
			</div>
			<div class="control-group">
				<label class="control-label">SMS Center</label>
				<div class="controls">
					<input type="text" class="input-medium" placeholder="SMS Center">
				</div>				
			</div>
			<div class="control-group">
				<label class="control-label">Default Modem</label>
				<div class="controls">
					<label class="checkbox">
						<input type="checkbox" value="1" name="default"> Make this modem as default modem
					</label>
				</div>				
			</div>

		</form>
			<div class="control-group" align="right">
				<button class="btn" data-dismiss="modal" >Batal</button>
				<button class="btn btn-primary">Save</button>
			</div>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
	</div>
</div>
