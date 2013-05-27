<div id="atcommands" class="tab-pane">
<script type="text/javascript">
	
	$(document).ready(function(){
		
		$('#post_command').submit(function(event){
			
			event.preventDefault();
			$.post('<?php echo base_url();?>config/atcommand/getcommand',$('#post_command').serialize(),function(data){
				if(data != undefined)
				{
					$('#show_data').html(data);
				}
			});
			
		});
		
		
	});
	
	
</script>

<form method="post" id="post_command" action="<?php echo base_url();?>config/atcommand/getcommand">
  <fieldset>
    <label>Command Available</label>
    <label class="help-inline"> Cek Pulsa </label>
    <select name="port">
		<option value="0"> Slot 1 </option>
		<option value="1"> Slot 2 </option>
		<option value="2"> Slot 3 </option>
		<option value="3"> Slot 4 </option>
		<option value="4"> Slot 5 </option>
		<option value="5"> Slot 6 </option>
		<option value="6"> Slot 7 </option>
		<option value="7"> Slot 8 </option>
	</select>

	<br>
    <label class="help-inline" >Parameter</label>
    <input type="text" placeholder="Parameters" name="param">
    <span class="help-block"><p class="text-error">Warning run command will temporarily turn off SMSD </p></span>
    <button type="submit" class="btn">Run</button>
  </fieldset>
</form>
	<div id="show_data">
	
	
	</div>
</div>
