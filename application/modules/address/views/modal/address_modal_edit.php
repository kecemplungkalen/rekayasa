<?php $role_id = $this->session->userdata('level');?>
<script>

	$(document).ready(function(){

		$('#edit').click(function(){
			$.post('<?php echo base_url();?>address/update_address',$('#editaddr').serialize(),function(data){
				if(data=='true')
				{
					location.reload();
				}else
				{
					$('#err').show();
				}
			});
			
		});


	});

</script>
<div id="editaddress" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><span id="top_first"> <?php echo $address['first_name'];?> </span>  <span id="top_last"> <?php echo $address['last_name'];?></span></h3>
	</div>
	<div class="modal-body">
			<div class="alert alert-error hide" id="err"> <strong>Galat..!</strong> Dalam Merubah Addess</div>
		<form class="form-horizontal" id="editaddr">
		<input type="hidden" id="id_address_book" name="id_address_book" value="<?php echo $address['id_address_book']?>">

			<div class="control-group">
				<label class="control-label">Phone Number</label>
				<div class="controls">
 					<input type="text" class="input-large" placeholder="Phone number" id="phone" name="phone" value="<?php echo $address['number'];?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">First Name</label>
				<div class="controls">
					<input type="text" class="input-large" placeholder="First Name" id="firstname" name="firstname" value="<?php echo $address['first_name'];?>">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Last Name</label>
				<div class="controls">
					<input type="text" class="input-large" placeholder="Last Name" id="lastname" name="lastname" value="<?php echo $address['last_name'];?>">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Email</label>
				<div class="controls">
					<input type="text" class="input-large" placeholder="Email Address" id="email" name="email" value="<?php echo $address['email'];?>">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Groups</label>
<!-- 				<div id="data_group"> </div> -->
				<?php if($group){?>
					<?php foreach($group as $row){?>
					<div class="controls">
						<label class="checkbox">
							<?php $statusgroup = false; ?>
							<?php for($i=0;$i< count($address['group']);$i++){ ?>
								<?php if($address['group'][$i]['id_groupname'] == $row->id_groupname) { ?> 
									<?php $statusgroup = true; ?>
								<?php } ?>
							<?php }?>
							<input value="<?php echo $row->id_groupname; ?>" name="group[]" type="checkbox" <?php if($statusgroup){ echo 'checked="checked"'; } ?> ><?php echo $row->nama_group; ?>
						</label>
					</div>
					<?php }?>
				<?php }?>
				
				
				</label>
			   	
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
		<a href="#" class="btn btn-info">WHMCS Sync</a>
		<?php if($role_id == '1' || $role_id == '2'){?>
		<a href="#" id="edit" class="btn btn-primary">Save changes</a>
		<?php }?>
	</div>
</div>
