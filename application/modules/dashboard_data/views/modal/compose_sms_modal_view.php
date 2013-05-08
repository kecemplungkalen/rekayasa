<div id="compose" class="modal hide fade " data-backdrop="static" >
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" onclick="reloadz()" aria-hidden="true">&times;</button>
		<h6>Kirim SMS</h6>
	</div>

	<script type="text/javascript">
		
		$(document).ready(function(){
		
			$('.combobox').combobox();
			
			
		});
		
		function countChar(val) 
		{
			var len = val.value.length;
			if (len >= 160) 
			{
				$('#charNum').html('<p class="text-error"> '+ len +'  character(s) <p>');
			} 
			else 
			{
			  $('#charNum').html('<p id="jumchar">'+len+'  character(s) <p>');
			}     
		}
      
		function send()
		{
			$.post('<?php echo base_url();?>dashboard/insert',$('#form_send').serialize(),function(data){
				//console.log(data);
				if(data=='true')
				{
					location.reload();
				}
				else
				{
					$('#warning').show();
				}
			});
		}
	</script>
	<div class="modal-body" >
		<div id="warning" class="alert-error hide">
		<strong> Warning Modem Galau..!!</strong>
		</div>
		<!-- start modal body -->
	<form id="form_send">  
		<div class="row-fluid">
			<div class="span12">
				<label class="control-label">Nomor</label>
				<div class="controls">
					<input type="text" class="input-block-level input-medium" name="number" placeholder="Must start with +62">
				</div>

				<label class="checkbox">
				<input type="checkbox" value="true" name="checkbox">Pilih Dari Phone Book 
				</label>
				<div class="controls">
				  <select class="combobox" name="number_box" id="number_box">
					  <?php if($data){?>
						<?php foreach($data as $d){?>
							<option value="<?php echo $d->number?>"><?php echo $d->first_name.' '.$d->last_name ;?></option>
						<?php }?>
					<?php }?>
				  </select>
				</div>
				
				<label class="control-label">Text Pesan</label>
					<textarea name="text" id="text" rows="3" style="width:97%;" onkeyup="countChar(this)"></textarea>
					<span class="help-inline" id="charNum"> </span>
	</form>
			</div>
		</div>
	
	</div>
	
	<div class="modal-footer">
		<a class="btn btn-success" onclick="send()">Send</a>
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true" onclick="reloadz()">Close</a>
	</div>
</div>
