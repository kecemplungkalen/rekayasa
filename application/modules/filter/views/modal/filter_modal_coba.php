<div id="addfilter" class="container modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Create Filter</h3>
	</div>
			<!-- test jquery -->
			<script>
				
				var intId = $("#filter_rule").length;
				
				$(document).ready(function(){
					
					$("#label option[value='1']").remove();
					$("#label option[value='2']").remove();
					$("#label option[value='3']").remove();
					$("#label option[value='4']").remove();
					

					$('#save').click(function(){
						
						$.post('<?php echo base_url()?>filter/add_filter',$('#form_rule').serialize(),function(data){
							//console.log(data);
							location.reload();
						});
					});					
				});
				
				
				//add parameter 
				var num = intId;
				function add_param()
				{
					num = intId++;
					var fieldWrapper = $("<div class=\"control-group\" id=\"parameter" + num + "\"/>");
					var paramtype = $('<div class=\"controls\" id=\"param\"> <select name="type_filter[]" class=\"input-medium\" id=\"rule'+num+'\"><option value="number" >Number</option><option value="messages">Messages</option></select> <select name="word[]"class=\"input-medium hide\" id=\"word'+num+'\"><option value="1">1st word</option><option value="2">2nd word</option><option value="3">3rd word</option><option value="4">4th word</option><option value="5">5th word</option></select> <select name="type_regex[]"class=\"input-small\" id=\"rule_type'+num+'\"><option value="regex">Regex</option><option value="=">=(Equal)</option><option value="start_with">Start With</option><option value="type">Type</option></select> <select name="filter_regex[]"class=\"input-medium hide\" id=\"cumatype'+num+'\"><?php if(isset($filter_regex)){?><?php foreach($filter_regex as $fr){?> <option value="<?php echo $fr->id_filter_regex;?>"> <?php echo $fr->regex;?></option><?php } ?> <?php } ?></select> <input name="regex_data[]" id="value'+num+'"type=\"text\" class=\"input-large\"> Additional rule: <select name="add_rule[]" class="input-medium " id="join'+num+'"> <option value="none">NONE</option><option value="and">AND</option><option value="or">OR</option></select> <a class=\"btn hide\" id="plus'+num+'" onclick=\"add_param()\"><i class=\"icon-plus-sign\"></i></a> <a class=\"btn\" onclick="remove_id(\'parameter'+num+'\')"><i class=\"icon-minus-sign\"></i></a></div>');
					fieldWrapper.append(paramtype);
					$('#filter_rule').append(fieldWrapper);

					$('#rule_type'+num).change(function(){

						var rule_type = $('#rule_type'+num+' :selected').val();
						var rule = $('#rule'+num+' :selected').val();

						if(rule_type == 'type' && rule != 'number')
						{
							$('#cumatype'+num).show();
							$('#value'+num).hide();
						}else
						{
							$('#cumatype'+num).hide();
							$('#value'+num).show();
						}
					});
					
					$('#rule'+num).change(function(){
						var rule = $('#rule'+num+' :selected').text();
						if(rule == 'Messages')
						{
							$('#word'+num).show();
						}else
						{
							$('#word'+num).hide();
						}
						
						
					});
					
					$('#join'+num).change(function(){
						var tambah = $('#join'+num+' :selected').val();
						if(tambah != 'none')
						{
							$('#plus'+num).show();
						}else
						{
							$('#plus'+num).hide();
						}
					});
				}
			
			//==========================
			
			
				//add action 
				var id_action = $('#action_filter').length;
				var plus = id_action;
				function add_action()
				{
					var plus = id_action++;
					var actionDiv = $("<div class=\"control-group\" id=\"act" + plus + "\"/>");
					var action = $('<select id="filter_action_type'+plus+'"name=\"filter_action_type[]\" class=\"input-medium\"><?php if(isset($filter_action_type)){?><?php foreach($filter_action_type as $fat){?><option value=\"<?php echo $fat->id_filter_action_type ;?>\"><?php echo $fat->action_type_text;?></option><?php } ?><?php } ?></select><select name=\"label[]\" id=\"label'+plus+'\" class="input-medium\"><?php if(isset($label)){?><?php foreach($label as $lb){?><option value=\"<?php echo $lb->id_labelname;?>\"> <?php echo $lb->name;?> </option><?php } ?><?php } ?></select><div id="api'+plus+'"class=\"controls hide\"><textarea name=\"api_post[]\" rows=\"3\"></textarea><input name=\"api_error_email[]\" type=\"text\" placeholder=\"API Failure report email\"></div><a onclick="remove_id(\'act'+plus+'\')" class="btn"><i class="icon-minus-sign"></i></a><a class="btn" onclick="add_action()" ><i class="icon-plus-sign"></i></a>');
					actionDiv.append(action);
					$('#action_filter').append(actionDiv);
					$("#label"+plus+" option[value='1']").remove();
					$("#label"+plus+" option[value='2']").remove();
					$("#label"+plus+" option[value='3']").remove();
					$("#label"+plus+" option[value='4']").remove();
					
					$('#filter_action_type'+plus).change(function(){
						var act_type = $('#filter_action_type'+plus+' :selected').val();
						if(act_type == '2')
						{
							$('#api'+plus).show();
						}else if(act_type == '1')
						{
							$('#api'+plus).hide();
							$('#label'+plus).show();
						}else
						{
							$('#api'+plus).hide();
							$('#label'+plus).hide();
						}
						
					});
				}
				
				
				
				
				$('#rule').change(function(){
					var rule = $('#rule :selected').val();
					if(rule == 'messages')
					{
						$('#word').show();
					}else
					{
						$('#cumatype').hide();
						$('#word').hide();
					}
					
					
				});
							
				$('#rule_type').change(function(){

					var rule_type = $('#rule_type :selected').val();
					rule = $('#rule :selected').val();

					if(rule_type == 'type' && rule != 'number')
					{
						$('#cumatype').show();
						$('#value').hide();
					}else
					{
						$('#cumatype').hide();
						$('#value').show();
					}
				});
				

				$('#filter_action_type').change(function(){

					var act_type = $('#filter_action_type :selected').val();
					if(act_type == '2')
					{
						$('#api').show();
						$('#label').hide();
					}else if(act_type == '1')
					{
						$('#api').hide();
						$('#label').show();
					}
					else
					{
						$('#api').hide();
						$('#label').hide();
					}
				});
				


				$('#join').change(function(){
					var tambah = $('#join :selected').val();
					if(tambah != 'none')
					{
						$('#plus').show();
					}else
					{
						$('#plus').hide();
					}
				});
				
				
				
				
			function remove_id(item_id)
			{
				var remove = eval(item_id);
				$(remove).remove();
			}
				
				


			</script>


	<div class="modal-body">
		<form id="form_rule">
			<div class="control-group">
				<label class="control-label">Filter Name</label>
				<div class="controls">
					<input name="nama_filter" type="text" class="input-large" placeholder="Filter Name">
				</div>
				<label class="control-label">Delimiter</label>
				<div class="controls">
					<select name="delimiter" class="input-medium" id="delimiter">
						<?php if(isset($delimiter)){?>
						<?php foreach($delimiter as $delim){?>
						<option value="<?php echo $delim->id_delimiter; ?>"> <?php echo $delim->name_delimiter ;?> </option>
						<?php } ?>
						<?php } ?>
					</select>
				</div>
			</div>
			
					<legend>Rule</legend>
					<div id="filter_rule">
						<select name="type_filter[]" class="input-medium" id="rule">
							<option value="number">Number</option>
							<option value="messages">Messages</option>
						</select>
						<select name="word[]" class="input-medium hide" id="word">
							<option value="1">1st word</option>
							<option value="2">2nd word</option>
							<option value="3">3rd word</option>
							<option value="4">4th word</option>
							<option value="5">5th word</option>
						</select>
						<select name="type_regex[]"  class="input-small" id="rule_type">
							<option value="regex">Regex</option>
							<option value="=">= (Equal) </option>
							<option value="start_with">Start With</option>
							<option value="type">Type</option>
						</select>
						<select name="filter_regex[]" class="input-medium hide" id="cumatype">
							<?php if(isset($filter_regex)){?>
							<?php foreach($filter_regex as $fr){?>
							<option value="<?php echo $fr->id_filter_regex;?>"><?php echo $fr->regex;?></option>
							<?php }?>
							<?php }?>
						</select>
						<input name="regex_data[]" id="value" type="text" class="input-large">
						Additional rule:
						<select name="add_rule[]" class="input-medium " id="join">
							<option value="none">NONE</option>
							<option value="and">AND</option>
							<option value="or">OR</option>
						</select>
						<a class="btn hide" id="plus" onclick="add_param()" ><i class="icon-plus-sign"></i></a> 				
					</div>
			
			
			<legend>Action</legend>
			<div id="action_filter"> 
			
			<div class="control-group">
				
				<div class="controls">
					
						<select name="filter_action_type[]" class="input-medium" id="filter_action_type">
								<?php if(isset($filter_action_type)){?>
									<?php foreach($filter_action_type as $fat){?>
										<option value="<?php echo $fat->id_filter_action_type ;?>"><?php echo $fat->action_type_text;?></option>
									<?php } ?>
								<?php } ?>
						</select>
							
						<select name="label[]" id="label" class="input-medium ">
							<?php if(isset($label)){?>
								<?php foreach($label as $lb){?>
									<option value="<?php echo $lb->id_labelname;?>"> <?php echo $lb->name;?> </option>
								<?php } ?>
							<?php } ?>
						</select>
							<div id="api" class="controls hide">
								<textarea name="api_post[]" rows="3"></textarea>
								<input name="api_error_email[]" type="text" placeholder="API Failure report email">
							</div>
							<a class="btn hide"  ><i class="icon-minus-sign"></i></a>
							<a class="btn" onclick="add_action()" ><i class="icon-plus-sign"></i></a>
					
				</div>
			</div>
			</div>
		
			
		</form>
			<div class="row">
				<button class="btn btn-primary pull-right" id="save" type="button">Save</button>
			</div>
	</div>
	
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
	</div>
	
</div>
