<script type="text/javascript">
	$(document).ready(function(){
		$('#smtp').submit(function(event){
			event.preventDefault();
			$.post('<?php echo base_url();?>config/smtp_config/save',$('#smtp_form').serialize(),function(data){
				if(data == 'true')
				{
					$('#status_smtp').html('<div class="alert alert-success"> <strong> Save OK..!!!</strong> <a class="close" data-dismiss="alert" href="#">&times;</a></div>');
				}
				else
				{
					$('#status_smtp').html('<div class="alert alert-danger"><strong> Save Failed..!!!</strong> <a class="close" data-dismiss="alert" href="#">&times;</a></div>');					
				}				});
		});		
		
		$('#test_smtp').click(function(){
			$.post('<?php echo base_url();?>config/smtp_config/test',$('#smtp_form').serialize(),function(data){
				if(data == '1')
				{
					$('#status_smtp').html('<div class="alert alert-success"> Smtp Status : <strong> OK..!!!</strong> <a class="close" data-dismiss="alert" href="#">&times;</a></div>');
				}
				else
				{
					$('#status_smtp').html('<div class="alert alert-danger"> Smtp Status : <strong> Failed..!!!</strong> <a class="close" data-dismiss="alert" href="#">&times;</a></div>');					
				}				
			});
			
		});
	});
	


</script>
<div id="smtp" class="tab-pane">
	<div id="status_smtp">
	
	</div>
	<?php if(isset($smtp)){ ?>
	<form class="form-horizontal" id="smtp_form" method="post" action="<?php echo base_url();?>config/smtp/save">
		<input type="hidden" name="id_config_smtp" id="id_config_smtp" value="<?php if(isset($smtp->id_config_smtp)){ echo $smtp->id_config_smtp;}?>"> 
		<div class="control-group">
			<label class="control-label">SMTP Host</label>
			<div class="controls ">
				<input type="text" class="input-medium" name="host" id="host" autocomplete="off" placeholder="host SMTP" value="<?php if(isset($smtp->host)){ echo $smtp->host; }?>">
			</div>				
		</div>

		<div class="control-group">
			<label class="control-label">Username</label>
			<div class="controls">
				<input type="text" class="input-medium" name="username" id="username" autocomplete="off" placeholder="Username SMTP" value="<?php if(isset($smtp->username)){ echo $smtp->username;}?>">
			</div>				
		</div>
		
		<div class="control-group">
			<label class="control-label">Password</label>
			<div class="controls">
				<input type="password" class="input-medium" name="password" id="password" autocomplete="off" placeholder="Password SMTP" value="<?php if(isset($smtp->password)){ echo $smtp->password;}?>">
			</div>				
		</div>
		
		<div class="control-group">
			<label class="control-label">Port</label>
			<div class="controls">
				<input type="text" name="port" id="port" class="input-medium" autocomplete="off" placeholder="Port SMTP" value="<?php if(isset($smtp->port)){ echo $smtp->port;}?>">
			</div>				
		</div>
		<div class="control-group">
			<label class="control-label">SSL</label>
			<div class="controls">
				<label class="radio inline">
				<input type="radio" name="ssl" id="ssl1" value="1" <?php if(isset($smtp->ssl)){if($smtp->ssl == '1'){ echo 'checked';}}?>>
					Enable
				</label>
				<label class="radio inline">
				<input type="radio" name="ssl" id="ssl2" value="0" <?php if(isset($smtp->ssl)){if($smtp->ssl == '0'){ echo 'checked';}}?>>
					Disable
				</label>
			</div>
		</div>
        <div class="text-center">
          <a class="btn btn-success" id="test_smtp">Test</a>
          <button type="submit" class="btn btn-primary">Save</button>
          <input type="reset" class="btn" value="Reset"> 
        </div>	
	</form>
	<?php } ?>
</div>
