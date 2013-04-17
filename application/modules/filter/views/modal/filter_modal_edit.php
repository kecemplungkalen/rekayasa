<div id="editfilter" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Edit Filter</h3>
	</div>
	<div class="modal-body">
		<form>
			<div class="control-group">
				<label class="control-label">Filter Name</label>
				<div class="controls">
					<input type="text" class="input-small" placeholder="Filter Name">
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
					</select>
					<input type="text" class="input-large">
				</div>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
	</div>
</div>
