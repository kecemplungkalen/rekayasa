
<script>
	$(document).ready(function(){
		
		$('#add_addr').validate({
			rules: {
			  number: {
				required: true,
				remote:{
					type:'post',	
					url:'<?php echo base_url();?>address/group/ceknumber'
				}
			  },
			  first_name: {
				required: true
			  },
			  last_name: {
				required: true
			  },
			  email: {
				required: true,
				email: true
			  },
			  group: {
				required: true
			  }
			},
	    
			messages: {
				number:{
					remote:'Nomer Telah dipakai..!!'
				}
			},
			highlight: function(element) {
					$(element).closest('.control-group').removeClass('success').addClass('error');
			},
			success: function(element) {
					element
					.text('OK!').addClass('valid')
					.closest('.control-group').removeClass('error').addClass('success');
			}
		});

		
		
		
		$('#add').click(function(){
			
			var valid = $('#add_addr').valid();
			
			if(valid == true)
			{
				$.post('<?php echo base_url(); ?>address/tambah_address',$('#add_addr').serialize(),function(data){
					
					if(data=='true')
					{
						location.reload();
					}
					else
					{
						$('#err').show();
					}
					
				});
			
			}else{
				
				return false;
			
			}
		});
		

		
	});

</script>
<div id="addaddress" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Add Address Book</h3>
	</div>
	<div class="modal-body">
	<div class="alert alert-error hide" id="err"> <strong>Galat..!</strong> Dalam Menambahkan Addess Baru</div>
		<form class="form-horizontal" id="add_addr" >
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
				
				<?php if($group){?>
					<?php foreach($group as $g) {?>
					<div class="controls">
						<label class="checkbox">
							<input type="checkbox" name="group[]" id="<?php echo $g->id_groupname; ?>" value="<?php echo $g->id_groupname; ?>"> <?php echo $g->nama_group; ?>
						</label>
					</div>					
					<?php }?>
				<?php }?>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
		<a href="#" class="btn btn-info">WHMCS Sync</a>
		<a href="#" id="add" class="btn btn-primary">Save changes</a>
	</div>
</div>
