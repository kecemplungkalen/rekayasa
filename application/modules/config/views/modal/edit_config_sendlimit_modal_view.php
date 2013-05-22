<script type="text/javascript">
		$(document).ready(function(){
			
			$('#update_datamodem').click(function(){
				var validasi = $('#form_send_limit').valid();
				if(validasi == true)
				{
					$.post('<?php echo base_url();?>config/send_limit/update_config_modem',$('#form_send_limit').serialize(),function(data){
					console.log(data);
						if(data == 'true')
						{
							window.location.href += "sendlimit";
							location.reload();
						}
					});
				}
			});
		});
		$('#form_send_limit').validate({
		rules: {
		  max_limit : {
			required: true,
			number : true,
		  },
		},
	
		messages: {
			max_limit :{
				number :'Please enter valid number Max SMS .'
			}
		},
		highlight: function(element) {
				$(element).closest('.control-group').removeClass('success').addClass('error');
		},
		success: function(element) {
				element
				.addClass('valid')
				.closest('.control-group').removeClass('error').addClass('success');
		}
	});
	
</script>

<div id="editsendlimit" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Sending Limit Management</h3>
	</div>
	<div class="modal-body">
		<form class="form-horizontal" id="form_send_limit">
			<?php if($data_modem){?>
			<div class="control-group">
				<label class="control-label"> Phone </label>
				<div class="controls">
					<input type="text" class="input-medium" value="<?php echo $data_modem->phoneID;?>" disabled>
					<input type="hidden" class="input-medium" value="<?php echo $data_modem->phoneID;?>" name="phoneID">
					<input type="hidden" class="input-medium" value="<?php echo $data_modem->id_config_modem;?>" name="id_config_modem">
				</div>				
			</div>
			
			<div class="control-group">
				<label class="control-label"> Time Limit </label>
				<div class="controls">
					<select id="time_limit" name="time_limit">
						<option value="0" <?php if($data_modem->time_sending_limit == '0'){ echo 'selected';}?>> No Limit </option>
						<option value="1800" <?php if($data_modem->time_sending_limit == '1800'){ echo 'selected';}?> > 30 Minute </option>
						<option value="3600" <?php if($data_modem->time_sending_limit == '3600'){ echo 'selected';}?> > 1 Hour </option>
						<option value="5400" <?php if($data_modem->time_sending_limit == '5400'){ echo 'selected';}?> > 1,5 Hour </option>
						<option value="7200" <?php if($data_modem->time_sending_limit == '7200'){ echo 'selected';}?> > 2 Hour </option>
					</select>
				</div>				
			</div> 	
			
			<div class="control-group">
				<label class="control-label">Sending Limit</label>
				<div class="controls">
					<input type="text" class="input-medium" id="max_limit" name="max_limit" placeholder="Number Maximum SMS" value="<?php echo $data_modem->sending_limit;?>">
				</div>				
			</div>
			<?php } ?>			
		</form>
	</div>
	<div class="modal-footer">
		<div class="control-group" align="right">
			<button class="btn" data-dismiss="modal"  aria-hidden="true">Batal</button>
			<button class="btn btn-primary" id="update_datamodem">Save</button>
		</div>
	</div>
</div>
