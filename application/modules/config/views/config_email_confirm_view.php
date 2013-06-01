<script type="text/javascript">
	
	$(document).ready(function(){
		
		$('#email_konf_form').submit(function(event){
			event.preventDefault();
			$.post('<?php echo base_url();?>config/email_konf/save',$('#email_konf_form').serialize(),function(data){
				if(data == '1')
				{
					$('#saveStatus').html('<div class="alert alert-success"> Configuration Saved <strong> OK.!</strong><a class="close" data-dismiss="alert" href="#">&times;</a></div>');
				}
				else
				{
					$('#saveStatus').html('<div class="alert alert-error"> Configuration Saved <strong> Failed.!</strong><a class="close" data-dismiss="alert" href="#">&times;</a></div>');					
				}
			});
			
		});		
		
	});

//method="post" action="<?php echo base_url();?>config/email_konf/save"	
</script>

<div id="emailConf" class="tab-pane">
<div id="saveStatus"> </div>

	<form class="form-horizontal" id="email_konf_form" >

		<div class="control-group">
			<label class="control-label">Enable Confirmation </label>
			<div class="controls">
				<label class="radio inline">
				<input type="radio" name="notification" id="notification1" value="1" <?php if(isset($data['enable_mail_notification'])){if($data['enable_mail_notification'] == '1'){ echo 'checked';}}?>>
					Enable
				</label>
				<label class="radio inline">
				<input type="radio" name="notification" id="notification2" value="0" <?php if(isset($data['enable_mail_notification'])){if($data['enable_mail_notification'] == '0'){ echo 'checked';}}?>>
					Disable
				</label>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">Send mail to </label>
			<div class="controls ">
				<input type="text" class="input-medium" name="mail" id="mail" autocomplete="off" placeholder="Email Address" value="<?php if(isset($data['mailaddr'])){ echo $data['mailaddr']; }?>">
			</div>				
		</div>
        <div class="text-center">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>        
	</form>
</div>

