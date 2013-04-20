<script>
	$(document).ready(function(){
		
		$.post('<?php echo base_url();?>address/group/get_group',function(data){
			
			$('#data_group').html(data);
			
			});
		
		
		});

</script>
<div id="addaddress" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Add Address Book</h3>
	</div>
	<div class="modal-body">
		<form class="form-horizontal" id="" >
			<div class="control-group">
				<label class="control-label">Phone Number</label>
				<div class="controls">
					<input type="text" name="number" class="input-large" placeholder="Phone number" >
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">First Name</label>
				<div class="controls">
					<input type="text" name="first_name"  class="input-large" placeholder="First Name" >
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Last Name</label>
				<div class="controls">
					<input type="text"  name="last_name" class="input-large" placeholder="Last Name" >
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Email</label>
				<div class="controls">
					<input type="text" name="email" class="input-large" placeholder="Email Address">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Groups</label>
				<div id="data_group">
				
				</div>
			
			</div>
			
			<!--
			<div class="control-group">
				<label class="control-label">Groups</label>
				<div class="controls">
					<label class="checkbox">
						<input type="checkbox" checked disabled="yes"> Telkomsel
					</label>
				</div>
				<div class="controls">
					<label class="checkbox">
						<input type="checkbox"> Pelanggan
					</label>
			   	</div>
				<div class="controls">
					<label class="checkbox">
						<input type="checkbox"> Teroris
					</label>
				</div>
				<div class="controls">
					<label class="checkbox">
						<input type="checkbox"> Smurf
					</label>
			   	</div>
			</div>
			-->
		</form>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
		<a href="#" class="btn btn-info">WHMCS Sync</a>
		<a href="#" class="btn btn-primary">Save changes</a>
	</div>
</div>
