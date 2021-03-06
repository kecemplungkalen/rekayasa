<div id="editfilter" class="container modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" onclick="javascript:location.reload();" aria-hidden="true">&times;</button>
		<h3>Create Filter</h3>
	</div>
			<!-- test jquery -->
			<script>
				
				var intId = $(".parameter").length;
				
				$(document).ready(function(){
					
					$("#label option[value='1']").remove();
					$("#label option[value='2']").remove();
					$("#label option[value='3']").remove();
					$("#label option[value='4']").remove();
					
					
					$('#save').click(function(){
						var valid = $('#form_rule').valid();
						if(valid == true)
						{	
							$.post('<?php echo base_url()?>filter/update_filter',$('#form_rule').serialize(),function(data){
								if(data == 'true')
								{
									location.reload();
								}
							});
						}
						else
						{
							return false;
						}
						
					});
					
					//valiasi
					$('#form_rule').validate({
						rules: {
						  nama_filter : {
							required: true,
							remote:{
								type:'post',	
								url:'<?php echo base_url();?>filter/cek/<?php if(isset($id_filter)){echo $id_filter;}?>'
							}
						  }
						},
					
						messages: {
							nama_filter :{
								remote:'Nama Filter Telah dipakai..!!'
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
				
				
				//add parameter 
				var num = intId;
				function add_param()
				{
					num = intId++;
					var fieldWrapper = $("<div class=\"control-group\" id=\"parameter" + num + "\"/>");
					var paramtype = $('<div class=\"controls\" id=\"param\"> <select name="type_filter[]" class=\"input-medium\" id=\"rule'+num+'\"><option value="number" >Number</option><option value="messages">Messages</option></select> <select name="word[]"class=\"input-medium hide\" id=\"word'+num+'\"><option value="1">1st word</option><option value="2">2nd word</option><option value="3">3rd word</option><option value="4">4th word</option><option value="5">5th word</option><option value="6">6th word</option><option value="7">7th word</option><option value="8">8th word</option><option value="9">9th word</option><option value="10">10th word</option></select> <select name="type_regex[]"class=\"input-small\" id=\"rule_type'+num+'\"><option value="regex">Regex</option><option value="=">=(Equal)</option><option value="start_with">Start With</option><option value="type">Type</option></select> <select name="filter_regex[]"class=\"input-medium hide\" id=\"cumatype'+num+'\"><?php if(isset($filter_regex)){?><?php foreach($filter_regex as $fr){?> <option value="<?php echo $fr->id_filter_regex;?>"> <?php echo $fr->regex;?></option><?php } ?> <?php } ?></select> <input name="regex_data[]" id="value'+num+'"type=\"text\" class=\"input-large\"> Additional rule: <select name="add_rule[]" class="input-medium " id="join'+num+'"> <option value="none">NONE</option><option value="and">AND</option><option value="or">OR</option></select> <a class=\"btn\" onclick="remove_id(\'parameter'+num+'\')"><i class=\"icon-minus-sign\"></i></a><a class=\"btn hide\" id="plus'+num+'" onclick=\"add_param()\"><i class=\"icon-plus-sign\"></i></a></div>');
					fieldWrapper.append(paramtype);
					$('.filter_rule').append(fieldWrapper);

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
					var actionDiv = $("<div id=\"actionz_" + plus + "\"/>");
					var action = $('<div class=\"control-group\"><select id="filter_action_type'+plus+'"name=\"filter_action_type[]\" class=\"input-medium\"><?php if(isset($filter_action_type)){?><?php foreach($filter_action_type as $fat){?> <option value=\"<?php echo $fat->id_filter_action_type ;?>\"><?php echo $fat->action_type_text;?></option><?php } ?><?php } ?></select><select name=\"label[]\" id=\"label'+plus+'\" class="input-medium\"><?php if(isset($label)){?><?php foreach($label as $lb){?><option value=\"<?php echo $lb->id_labelname;?>\"> <?php echo $lb->name;?> </option><?php } ?><?php } ?></select><div id="api'+plus+'"class=\"controls hide\"><textarea name=\"api_post[]\" rows=\"3\"></textarea><input name=\"api_error_email[]\" type=\"text\" placeholder=\"API Failure report email\"></div><a onclick="remove_id(\'actionz_'+plus+'\')" class="btn"><i class="icon-minus-sign"></i></a></div>');
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
							$('#label'+plus).hide();
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
				
				
				
				

				$('.rule').change(function(){
					var rule = $(this).val();
					var idattr = $(this).attr('id');
					var splits = idattr.split('_');
					if(rule == 'messages')
					{
						$('#word_'+splits[1]).show();
					}else
					{
						$('#cumatype_'+splits[1]).hide();
						$('#word_'+splits[1]).hide();
					}
					
					
				});
			
				
							
				$('.rule_type').change(function(){

					var rule_type = $(this).val();				
					var idnya = $(this).attr('id');
					var splits = idnya.split('_');
					var valrule = $('#rule_'+splits[2]).val();
					console.log(rule_type);
					console.log(valrule);
					if(rule_type == 'type' && valrule != 'number')
					{
						$('#cumatype_'+splits[2]).show();
						$('#value_'+splits[2]).hide();
					}else
					{
						$('#cumatype_'+splits[2]).hide();
						$('#value_'+splits[2]).show();
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
				



				$('.join').change(function(){
					var tambah = $(this).val();
					var tambah_tombol = $(this).attr('id');
					var splits = tambah_tombol.split('_');
					//console.log(splits[1]);
					if(tambah != 'none')
					{
						$('#plus_'+splits[1]).show();
					}else
					{
						$('#plus_'+splits[1]).hide();
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
					<input type="hidden" name="id_filter" value="<?php if(isset($id_filter)){echo $id_filter;}?>" > 
					<?php if(isset($has_filter)){?>
					<input name="nama_filter" type="text" class="input-large" placeholder="Filter Name" value="<?php echo $has_filter->filter_name; ?>">
					<?php } ?>
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label">Delimiter</label>
				<div class="controls">
					
					<select name="delimiter" class="delimiter input-medium" id="delimiter">
						<?php if(isset($delimiter)){?>
						<?php $selected = false; ?>
						<?php foreach($delimiter as $delim){?>
						<?php if(isset($has_delimiter)){?>
							<?php if($has_delimiter->id_delimiter == $delim->id_delimiter){?>
								<option value="<?php echo $delim->id_delimiter; ?>" selected> <?php echo $delim->name_delimiter ;?> </option>
							<?php } else {?>
							<option value="<?php echo $delim->id_delimiter; ?>" > <?php echo $delim->name_delimiter ;?> </option>							
							<?php } ?>
			
							<?php } ?>
						<?php } ?>
						<?php } ?>
					</select>
				</div>
			</div>
			
					<legend>Rule</legend>
					<div class="filter_rule" id="filter_rule">
				<?php if($has_filter_detail){ ?>
					<?php $paramz=0;?>
					<?php foreach($has_filter_detail as $hfd){?>
					<div class="parameter" id="parameter_<?php echo $paramz; ?>">
							<input type="hidden" name="id_filter_detail" value="<?php echo $hfd->id_filter_detail; ?>">
							<select name="type_filter[]" class="rule input-medium" id="rule_<?php echo $hfd->id_filter_detail; ?>">
								<option value="number" <?php if($hfd->type_filter == 'number'){ echo 'selected';}?> >Number</option>
								<option value="messages" <?php if($hfd->type_filter == 'messages'){ echo 'selected';}?> >Messages</option>
							</select>
							<select name="word[]" class="word input-medium" id="word_<?php echo $hfd->id_filter_detail; ?>">
								<option value="1" <?php if($hfd->word == '1'){ echo 'selected';}?> >1st word</option>
								<option value="2" <?php if($hfd->word == '2'){ echo 'selected';}?> >2nd word</option>
								<option value="3" <?php if($hfd->word == '3'){ echo 'selected';}?> >3rd word</option>
								<option value="4" <?php if($hfd->word == '4'){ echo 'selected';}?> >4th word</option>
								<option value="5" <?php if($hfd->word == '5'){ echo 'selected';}?> >5th word</option>
								<option value="6" <?php if($hfd->word == '6'){ echo 'selected';}?> >6th word</option>
								<option value="7" <?php if($hfd->word == '7'){ echo 'selected';}?> >7th word</option>
								<option value="8" <?php if($hfd->word == '8'){ echo 'selected';}?> >8th word</option>
								<option value="9" <?php if($hfd->word == '9'){ echo 'selected';}?> >9th word</option>
								<option value="10" <?php if($hfd->word == '10'){ echo 'selected';}?> >10th word</option>
							</select>
							<select name="type_regex[]"  class="rule_type input-small" id="rule_type_<?php echo $hfd->id_filter_detail; ?>" >
								
								<option value="regex" <?php if($hfd->type_regex == 'regex'){ echo 'selected';}?> >Regex</option>
								<option value="=" <?php if($hfd->type_regex == '='){ echo 'selected';}?> >= (Equal) </option>
								<option value="start_with" <?php if($hfd->type_regex == 'start_with'){ echo 'selected';}?> >Start With</option>
								<option value="type" <?php if($hfd->type_regex == 'type'){ echo 'selected';}?> >Type</option>
							</select>

							<select name="filter_regex[]" class="cumatype input-medium <?php if($hfd->type_regex != 'type'){ echo 'hide'; }?>" id="cumatype_<?php echo $hfd->id_filter_detail; ?>" >
								<?php if(isset($filter_regex)){?>
								<?php foreach($filter_regex as $fr){?>
									<?php if($fr->id_filter_regex == $hfd->id_filter_regex){ ?>
									<option value="<?php echo $fr->id_filter_regex;?>" selected><?php echo $fr->regex;?></option>
									<?php } else {?>
									<option value="<?php echo $fr->id_filter_regex;?>"><?php echo $fr->regex;?></option>
									<?php }?>
								<?php }?>
								<?php }?>
							</select>							
							
							<input name="regex_data[]" id="value_<?php echo $hfd->id_filter_detail; ?>" type="text" class="value input-large <?php if($hfd->regex_data === ''){ echo 'hide'; }?>" value="<?php echo $hfd->regex_data;?>">
							
							Additional rule:
							<select name="add_rule[]" class="join input-medium " id="join_<?php echo $hfd->id_filter_detail; ?>">
								<option value="none" <?php if($hfd->add_rule == 'none'){ echo 'selected' ;}?>>NONE</option>
								<option value="and" <?php if($hfd->add_rule == 'and'){ echo 'selected' ;}?> >AND</option>
								<option value="or" <?php if($hfd->add_rule == 'or'){ echo 'selected' ;}?> >OR</option>
							</select>
							<a class="btn" id="minus_<?php echo $hfd->id_filter_detail; ?>" onclick="remove_id('parameter_<?php echo $paramz ;?>')" ><i class="icon-minus-sign"></i></a>
							<a class="btn hide" id="plus_<?php echo $hfd->id_filter_detail; ?>" onclick="add_param()" ><i class="icon-plus-sign"></i></a>
							<br>
							</div>
 							<?php $paramz++;?>

						<?php } ?>
					<?php } ?>
					</div>
			
			<legend>Action</legend>
			<div id="action_filter"> 
				<?php if(isset($has_filter_action)){?>
				<?php foreach($has_filter_action as $hfa){?>
				<div id="actionz_<?php echo $hfa->id_action;?>">		
					<div class="control-group" >
						
						<div class="controls">
								<input type="hidden" name="id_action" value="<?php echo $hfa->id_action;?>">
								<select name="filter_action_type[]" class="input-medium" id="filter_action_type">
										<?php if(isset($filter_action_type)){?>
											<?php foreach($filter_action_type as $fat){?>
											
												<option value="<?php echo $fat->id_filter_action_type ;?>" <?php if($hfa->id_filter_action_type == $fat->id_filter_action_type){ echo 'selected';}?> ><?php echo $fat->action_type_text;?></option>
											<?php } ?>
										<?php } ?>
								</select>
					
								<select name="label[]" id="label" class="input-medium <?php if($hfa->id_filter_action_type != '1'){ echo 'hide';}?>">
									<?php if(isset($label)){?>
										<?php foreach($label as $lb){?>
											<option value="<?php echo $lb->id_labelname;?>" <?php if($hfa->id_label == $lb->id_labelname){ echo 'selected';}?>> <?php echo $lb->name;?> </option>
										<?php } ?>
									<?php } ?>
								</select>
						</div>
					</div>
					
							<div class="control-group" >
								<div id="api" class="controls <?php if($hfa->id_filter_action_type != '2'){ echo 'hide';}?>">
									<textarea name="api_post[]" rows="3"><?php if($hfa->api_post != ''){ echo $hfa->api_post;}?></textarea>
									<input name="api_error_email[]" type="text" placeholder="API Failure report email" value="<?php if($hfa->api_error_email != ''){ echo $hfa->api_error_email; }?>">
								</div>
								<a class="btn" onclick="remove_id('actionz_<?php echo $hfa->id_action;?>');"><i class="icon-minus-sign"></i></a>
							</div>
					</div>
					<?php } ?>
				<?php } ?>
			</div>
			<a class="btn" onclick="add_action()" ><i class="icon-plus-sign"></i></a>

			


		</form>
			<div class="row">
				<button class="btn btn-primary pull-right" id="save" type="button">Save</button>
			</div>
	</div>
	
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal" onclick="javascript:location.reload();" aria-hidden="true">Close</a>
	</div>
	
</div>
