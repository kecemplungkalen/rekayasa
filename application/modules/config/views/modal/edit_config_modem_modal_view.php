<script  type="text/javascript">
	$(document).ready(function(){
		
		$('#edit').click(function(){
			var valid = $('#data_modem').valid();
			if(valid == true)
			{
				$.post('<?php echo base_url();?>config/modem/add_modem',$('#data_modem').serialize(),function(balik){
					if(balik == 'true')
					{
						window.location.href += "modem";
						location.reload();
					}
				});
			}
			else
			{
				return false;
			}

		});
		
		//validasi form 
		$('#data_modem').validate({
			rules: {
			  nama_modem : {
				required: true,
				remote:{
					type:'post',	
					url:'<?php echo base_url();?>config/modem/cek_nama_modem'
				}
			  },
			  number : {
				required: true,
			  }
			},
		
			messages: {
				nama_modem :{
					remote:'Nama Modem Telah dipakai..!!'
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
	
		
	});
	
	

</script>


<div id="editmodem" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Modem Management</h3>
	</div>
	<div class="modal-body">
		<?php if(isset($config)){?>
		<form class="form-horizontal" id="data_modem">
			<input type="hidden" name="id_config_modem" value="<?php echo $config->id_config_modem; ?>" >
			<div class="control-group">
				<label class="control-label">Modem Name</label>
				<div class="controls">
					<input type="text" class="input-medium" name="nama_modem" placeholder="Modem Name" value="<?php echo $config->nama_modem;?>" >
				</div>				
			</div>
			<div class="control-group">
				<label class="control-label">Phone ID</label>
				<div class="controls">
					<select name="phoneID">
						<?php if($id_phone){?>
							<?php $ceked = false;?>
							<?php for($i=0;$i < count($id_phone);$i++){?>
							<?php if($id_phone[$i]['modem'] == $config->phoneID){?>
							<?php $ceked=true;?>
							<?php }?>
							<option value="<?php echo $id_phone[$i]['modem'];?>" <?php if($ceked){ echo 'selected';}?>><?php echo $id_phone[$i]['modem'];?></option>
							<?php }?>
						<?php }?>
					</select>
				</div>				
			</div>
			<div class="control-group">
				<label class="control-label">Phone Number</label>
				<div class="controls">
					<input type="text" class="input-medium" name="number" placeholder="+62" value="<?php echo $config->number;?>">
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
		<?php } ?>
			<div class="control-group" align="right">
				<button class="btn" data-dismiss="modal" >Batal</button>
				<button class="btn btn-primary" id="add_modem">Save</button>
			</div>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
	</div>
</div>
