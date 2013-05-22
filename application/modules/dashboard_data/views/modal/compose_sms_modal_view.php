<div id="compose" class="modal hide fade " data-backdrop="static" >
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h6>Kirim SMS</h6>
	</div>

	<script type="text/javascript">
		
		$(document).ready(function(){
		
			$('.combobox').combobox();
			$('#number').typeahead({
				
				
				source: function(query,process){
					  data = [];
					  map = {};
					  var source = [];
					  // ambil JSON ke server
						$.post('<?php base_url();?>dashboard_data/get_addr',{query:query},function(result){
							if(result)
							{
									source = result;
									$.each(source, function (i, dt) {
										map[dt.first_name+''+dt.last_name] = dt;
										data.push(dt.first_name+''+dt.last_name);
									});
									$.each(source, function (i, dt) {
										map[dt.number] = dt;
										data.push(dt.number);
									});								
									process(data);
							}
							else
							{
								var dud = $('#number').val();
								$('#number').data('number',dud);
							}
						},'json');
				},
				
				minLength:3,
				items : 10,
				
				updater: function (item) 
				{
					  // lakukan apapun yang ingin dilakukan dengan ID data terpilih
					selectedItem = map[item].number;
					$('#number').data('number',selectedItem);
						

					  // penting! jangan hapus kode di bawah ini (used by typeahead)
					return item;
				}
			
				
			});
			
			$('#number').click(function(){
				
				$('#checkpbk').prop('checked',false);
				$('.combobox').val('');
				
			});
			
			$('.combobox').click(function(){
				
				$('#checkpbk').prop('checked',true);
				
			});
			
			
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
		
		function save()
		{
			$.post('<?php echo base_url();?>dashboard/save_draft',$('#form_send').serialize(),function(data){
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
		
		function send()
		{
			//console.log($('#form_send').serialize());
			var number = '';
			var checkbox = '0';
			var number_box = '';
			var addr_num = $('#number').data('number');
			if(addr_num != undefined)
			{
				number = addr_num;
				
			}
			else
			{
				number = $('#number').val();
			}
			
			if($('#checkpbk').prop('checked'))
			{
				checkbox = '1';
				number_box = $('#number_box').val();
			}
			// sikat  
			
			var text = $('#text').val();
			
			$.post('<?php echo base_url();?>dashboard/insert',{number:number,checkbox:checkbox,text:text,number_box:number_box},function(data){
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
		$('#number_box').change(function(){
			$('#checkpbk').prop('checked',true);
			$('#number').val('');
		});
	</script>
	<div class="modal-body" >
		<div id="warning" class="alert-error hide">
		<strong> Warning Modem Error..!!</strong>
		</div>
		<!-- start modal body -->
	<form id="form_send">  
		<div class="row-fluid">
			<div class="span12">
				<input type="hidden" name="id_user" value="<?php echo $this->session->userdata('id_user');?>">
				<label class="control-label">Nomor</label>
				<div class="controls">
					<input type="hidden" name="id_address_book" id="id_address_book">
					<input type="text" id="number" name="number" class="input-block-level input-medium"  placeholder="Name Address Or Number" autocomplete="off">
				</div>

				<label class="checkbox">
				<input type="checkbox" value="true" name="checkbox" id="checkpbk">Send To Group 
				</label>
				<div class="controls">
				  <select class="combobox" name="number_box" id="number_box">
					  <?php if($data){?>
						<?php foreach($data as $d){?>
							<option value="<?php echo $d->id_groupname?>"><?php echo $d->nama_group;?></option>
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
		<a class="btn btn-info" onclick="save()">Save</a>
		<a class="btn btn-success" onclick="send()">Send</a>
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true" >Close</a>
	</div>
</div>
