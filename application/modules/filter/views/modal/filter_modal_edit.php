<div id="editfilter" class="container modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Edit Filter</h3>
	</div>
	<div class="modal-body">
		<form>
			<div class="control-group">
				<label class="control-label">Filter Name</label>
				<div class="controls">
					<input type="text" class="input-large" placeholder="Filter Name">
				</div>
			</div>
			<legend>Rule</legend>
			<div class="control-group">
				<div class="controls">
					<select class="input-medium">
						<option>Number</option>
						<option>Messages</option>
						<option>1st word</option>
						<option>2nd word</option>
						<option>3rd word</option>
						<option>4th word</option>
						<option>5th word</option>
					</select>
					<select class="input-small">
						<option>Regex</option>
						<option>=</option>
						<option>Start with</option>
						<option>Type</option>
					</select>
					<select class="input-medium">
						<option>Cuma kalau type</option>
						<option>numeric only</option>
						<option>alphabet only</option>
						<option>alphanumeric</option>
					</select>
					<input type="text" class="input-large">
					Additional rule: <input type="radio" name="radio2"checked> AND <input type="radio" name="radio2"> OR <input type="radio" name="radio2"> none
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<select class="input-medium">
						<option>Number</option>
						<option>Messages</option>
						<option>1st word</option>
						<option>2nd word</option>
						<option>3rd word</option>
						<option>4th word</option>
						<option>5th word</option>
					</select>
					<select class="input-small">
						<option>Regex</option>
						<option>=</option>
						<option>Start with</option>
						<option>Type</option>
					</select>
					<select class="input-medium">
						<option>Cuma kalau type</option>
						<option>numeric only</option>
						<option>alphabet only</option>
						<option>alphanumeric</option>
					</select>
					<input type="text" class="input-large">
					Additional rule: <input type="radio" name="radio3"> AND <input type="radio" name="radio3"> OR <input type="radio" name="radio3" checked> none
				</div>
			</div>
			<legend>Action</legend>
			<div class="control-group">
				<div class="controls">
					<select class="input-medium">
						<option>Add Label</option>
					</select>
					<select class="input-medium">
						<option>Konfirmasi</option>
						<option>TekonTekon</option>
					</select>
					<i class="icon-minus-sign"></i>
				</div>
				<hr>
				<div class="controls">
					<select class="input-medium">
						<option>API</option>
					</select>
					<textarea rows="3"></textarea>
					<input type="text" placeholder="API Failure report email">
					<i class="icon-minus-sign"></i>
				</div>
				<hr>
				<div class="controls">
					<select class="input-medium">
						<option>Mark as read</option>
					</select>
					<i class="icon-minus-sign"></i>
				</div>
				<hr>
				<div class="controls">
					<select class="input-medium">
						<option>Archive</option>
					</select>
					<i class="icon-minus-sign"></i>
				</div>
			</div>
			<div class="row">
				<button class="btn btn-primary pull-right" type="button">Save</button>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
	</div>
</div>
