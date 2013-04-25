<div id="addfilter" class="container modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Create Filter</h3>
	</div>
			<!-- test jquery -->
			<script>
				
				var intId = $("#filter_rule").length;
				
				$(document).ready(function(){
					

					
			
					$('#remove').click(function(){
						//$(this).remove();
						console.log($(this));
						
					});

					$('#save').click(function(){
						
						$.post('<?php echo base_url()?>filter/add_filter',$('#form_rule').serialize(),function(data){
							console.log(data);
						});
					});
					
					//add_param();
					
				});
				var num = intId;
				function add_param()
				{
					num = intId++;
					var fieldWrapper = $("<div class=\"control-group\" id=\"parameter" + num + "\"/>");
					var paramtype = $('<div class=\"controls\" id=\"param\"> <select name="rule[]" class=\"input-medium\" id=\"rule'+num+'\"><option value="number" >Number</option><option value="messages">Messages</option></select> <select name="word[]"class=\"input-medium hide\" id=\"word'+num+'\"><option value="1">1st word</option><option value="2">2nd word</option><option value="3">3rd word</option><option value="4">4th word</option><option value="5">5th word</option></select> <select name="regex[]"class=\"input-small\" id=\"rule_type'+num+'\"><option value="=">=</option><option value="start_with">Start with</option><option>Type</option></select> <select name="type_param[]"class=\"input-medium hide\" id=\"cumatype'+num+'\"><option value="numeric">numeric only</option><option value="alphabet">alphabet only</option><option value="alphanumeric">alphanumeric</option> </select> <input name="value[]" id="value'+num+'"type=\"text\" class=\"input-large\"> Additional rule: <select name="join[]" class="input-medium " id="join'+num+'"> <option value="none">NONE</option><option value="and">AND</option><option value="or">OR</option></select> <a class=\"btn hide\" id="plus'+num+'" onclick=\"add_param()\"><i class=\"icon-plus-sign\"></i></a> <a class=\"btn\" onclick="remove_id(\'parameter'+num+'\')"><i class=\"icon-minus-sign\"></i></a></div>');
					fieldWrapper.append(paramtype);
					$('#filter_rule').append(fieldWrapper);

					$('#rule_type'+num).change(function(){

						var rule_type = $('#rule_type'+num+' :selected').text();
						if(rule_type == 'Type')
						{
							$('#cumatype'+num).show();
							$('#value'+num).hide();
							//$('#cumatype'+num).prop('disabled',false);
						}else
						{
							$('#cumatype'+num).hide();
							$('#value'+num).show();
							//$('#cumatype'+num).prop('disabled',true);
						}
					});
					
					$('#rule'+num).change(function(){
						var rule = $('#rule'+num+' :selected').text();
						if(rule == 'Messages')
						{
							$('#word'+num).show();
							//$('#word'+num).prop('disabled',false);
						}else
						{
							$('#word'+num).hide();
							//$('#word'+num).prop('disabled',true);
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
			
				$('#rule_type').change(function(){

					var rule_type = $('#rule_type :selected').text();
					if(rule_type == 'Type')
					{
						$('#cumatype').show();
						$('#value').hide();
						//$('#cumatype').prop('disabled',false);
					}else
					{
						$('#cumatype').hide();
						$('#value').show();
						//$('#cumatype').prop('disabled',true);
					}
				});
				
				$('#rule').change(function(){
					var rule = $('#rule :selected').text();
					if(rule == 'Messages')
					{
						$('#word').show();
						//$('#word').prop('disabled',false);
					}else
					{
						$('#word').hide();
						//$('#word').prop('disabled',true);
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
					<input name="nama_rule" type="text" class="input-large" placeholder="Filter Name">
				</div>
			</div>
			<legend>Rule</legend>
					<div id="filter_rule">
					<select name="rule[]" class="input-medium" id="rule">
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
					<select name="regex[]"  class="input-small" id="rule_type">
						<option value="=">=</option>
						<option value="start_with">Start with</option>
						<option>Type</option>
					</select>
					<select name="type_param[]" class="input-medium hide" id="cumatype">
						<option value="numeric">numeric only</option>
						<option value="alphabet">alphabet only</option>
						<option value="alphanumeric">alphanumeric</option>
					</select>
					<input name="value[]" id="value" type="text" class="input-large">
					Additional rule:
					<select name="join[]" class="input-medium " id="join">
						<option value="none">NONE</option>
						<option value="and">AND</option>
						<option value="or">OR</option>
					</select>
					<a class="btn hide" id="plus" onclick="add_param()" ><i class="icon-plus-sign"></i></a> 				
					</div>
			<legend>Action</legend>
			<div class="control-group">
				<div class="controls">
					<select name="action[]" class="input-medium">
						<option>Add Label</option>
						<option>API</option>
						<option>Mark as read</option>
						<option>Archive</option>
					</select>
					
					<select name="label[]" class="input-medium">
					<?php if(isset($label)){?>
					<?php foreach($label as $lb){?>
						<option value="<?php echo $lb->id_labelname;?>"> <?php echo $lb->name;?> </option>
					<?php } ?>
					<?php } ?>
					</select>
					
					
					<div class="controls hide">
						<textarea name="api[]" rows="3"></textarea>
						<input name="api_email[]" type="text" placeholder="API Failure report email">
					</div>
					<a class="btn"><i class="icon-minus-sign"></i></a>
					<a class="btn"><i class="icon-plus-sign"></i></a>
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
