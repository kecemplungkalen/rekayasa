<div id="addmodem" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Modem Port Management</h3>
	</div>
	<div class="modal-body">
		<form class="form-horizontal">
			<div class="control-group">
				<label class="control-label">Modem Name</label>
				<div class="controls">
					<input type="text" class="input-small" placeholder="Modem Name">
				</div>				
			</div>
			<div class="control-group">
				<label class="control-label">Port</label>
				<div class="controls">
					<select>
						<option>USB01</option>
						<option>USB02</option>
						<option>USB03</option>
					</select>
				</div>				
			</div>
			<div class="control-group">
				<label class="control-label">Phone Number</label>
				<div class="controls">
					<input type="text" class="input-medium" placeholder="Phone Number">
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
						<input type="checkbox"> Make this modem as default modem
					</label>
				</div>				
			</div>
			<div class="control-group" align="right">
				<button class="btn btn-primary">Save</button>
				<button class="btn btn-success">Enable</button>
				<button class="btn btn-warning">Disable</button>
				<button class="btn btn-danger">Delete</button>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
	</div>
</div>
