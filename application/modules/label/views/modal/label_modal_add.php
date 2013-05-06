<div id="addlabel" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<!-- javascripnya -->
			<script>
				$(document).ready(function(){
										
					$('#form_label_add').validate({
						rules: {
							add_label_name: {
								required: true,
								remote:{
									type:'post',	
									url:'<?php echo base_url();?>label/add_ceklabel'
								}
							},
							
							radio1 : {
								required: true
							},
						},
						
						messages: {
							add_label_name :{
								remote:'Label Telah Dipakai..!!'
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
					
					$('#add_label').click(function(){
						
						var valid = $('#form_label_add').valid();
						if(valid == true)
						{
							$.post('<?php echo base_url();?>label/add_label',$('#form_label_add').serialize(),function(data){
								if(data=='true')
								{
									//console.log(data);
									location.reload();
								}
								else
								{
									$('#err').show();
								}
							});
						}
						else
						{
							return false;
						}
					});
				});
				
				
			</script>
			

		<h3>Add Label</h3>
	</div>
	<div class="modal-body">
		<div  class="alert alert-danger hide" id="err"><strong>Galat</strong>Error Dalam Menambahkan Label</div>
		<form class="form-horizontal"  id="form_label_add">
			<div class="control-group">
				<label class="control-label">Label Name</label>
				<div class="controls">
					<input type="text" name="add_label_name" class="input-small" placeholder="Label name" >
				</div>
			</div>
			<!-- Colour Option -->
			<div class="control-group">
				<label class="control-label">Colour</label>
				<div class="controls span1">
					<label class="radio">
						<input type="radio" name="radio1" value="e7e7e7"> <span class="label badge-e7e7e7">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="c2c2c2"> <span class="label badge-c2c2c2">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="ffc8af"> <span class="label badge-ffc8af">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="ff7537"> <span class="label badge-ff7537">&nbsp;&nbsp;</span>
					</label>
				</div>
				<div class="controls span1">
					<label class="radio">
						<input type="radio" name="radio1" value="b6cff5"> <span class="label badge-b6cff5">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="4986e7"> <span class="label badge-4986e7">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="ffdeb5"> <span class="label badge-ffdeb5">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="ffad46"> <span class="label badge-ffad46">&nbsp;&nbsp;</span>
					</label>
				</div>
				<div class="controls span1">
					<label class="radio">
						<input type="radio" name="radio1" value="98d7e4"> <span class="label badge-98d7e4">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="2da2bb"> <span class="label badge-2da2bb">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="fbe983"> <span class="label badge-fbe983">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="ebdbde"> <span class="label badge-ebdbde">&nbsp;&nbsp;</span>
					</label>
				</div>
				<div class="controls span1">
					<label class="radio">
						<input type="radio" name="radio1" value="e3d7ff"> <span class="label badge-e3d7ff">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="b99aff"> <span class="label badge-b99aff">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="fdedc1"> <span class="label badge-fdedc1">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="cca6ac"> <span class="label badge-cca6ac">&nbsp;&nbsp;</span>
					</label>
				</div>
				<div class="controls span1">
					<label class="radio">
						<input type="radio" name="radio1" value="fbd3e0"> <span class="label badge-fbd3e0">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="f691b2"> <span class="label badge-f691b2">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="b3efd3"> <span class="label badge-b3efd3">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="42d692"> <span class="label badge-42d692">&nbsp;&nbsp;</span>
					</label>
				</div>
				<div class="controls span1">
					<label class="radio">
						<input type="radio" name="radio1" value="f2b2a8"> <span class="label badge-f2b2a8">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="fc4c2f"> <span class="label badge-fc4c2f">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="a2dcc1"> <span class="label badge-a2dcc1">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="16a765"> <span class="label badge-16a765">&nbsp;&nbsp;</span>
					</label>
				</div>
			</div>
			<!-- Colour Option -->
		</form>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn btn-primary" id="add_label" >Save</a>		
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
	</div>
</div>
