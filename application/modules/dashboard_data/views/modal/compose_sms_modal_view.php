<div id="compose" class="modal hide fade " data-backdrop="static" >
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" onclick="reloadz()" aria-hidden="true">&times;</button>
		<h6>Kirim SMS</h6>
	</div>
	
	
	<div class="modal-body" >
		<!-- start modal body -->
		
		<div class="row-fluid">
			<div class="span12">
				<form>
				<label class="control-label">Text Pesan</label>
					<div class="well">
						<textarea class="input" placeholder="Isi Pesan Text.."></textarea>
					</div>

				<label class="control-label">Phone Book</label>
					<div class="controls">
						<select>
							<option value=""> Test </option>
						</select>
					</div>

				</form>
			
			</div>
		</div>
	
	</div>
	
	<div class="modal-footer">
		<a class="btn btn-success">Send</a>
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true" onclick="reloadz()">Close</a>
	</div>
</div>
