<?php $role_id = $this->session->userdata('level');?>
<script>

	$(document).ready(function(){
		

		
		$('#hapus').click(function(){
			var id =  $('.groupdata:checkbox').map(function() {
			if(this.checked){
			   return this.value;
			  }
			}).get();
			$.post('<?php echo base_url();?>address/group/hapus_group',{id:id},function(data){
				
				console.log(data);
				
			});
			
		});
		
		$('#cekall').click(function(){
			
			var action = 'cek';
			if($('#cekall').attr('checked'))
			{
				action = 'uncek';
				$('#cekall').removeAttr('checked');

			}else{
				$('#cekall').attr('checked','checked');
			}
			$('.groupdata:checkbox').map(function() {
				if(action == 'cek'){
					$("#"+this.id).prop('checked', true);
				}else{
					$("#"+this.id).removeAttr("checked");
				}
			});
			
			
		});
		
		$('#add_group_form').validate({
			rules: {
			  group_name: {
				required: true,
				remote:{
					type:'post',	
					url:'<?php echo base_url();?>address/group/cekgroup'
				}
			  },
			  radio1 : {
				required: true
			  },
			},
			
			messages: {
				group_name :{
					remote:'Nama Telah dipakai..!!'
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
		

		
		$('#add_group').click(function(){
			
			var valid = $('#add_group_form').valid();
			if(valid == true)
			{
				$.post('<?php echo base_url()?>address/group/add_group_name',$('#add_group_form').serialize(),function(data){
					if(data)
					{
						$('#tabel_group').append(data);
					}
				});
			}
			else
			{
				return false;
			}			
		});
		
		
		
		
		
		$('#form_edit_group').validate({
			rules: {
			  input_id_groupname : {
				required: true
			  },
			  input_nama_group : {
				//var id_groupname = $('#input_id_groupname').val();
				required: true,
				remote:{
					type:'post',	
					url:'<?php echo base_url();?>address/group/edit_cekgroup/',
					data :{
							id_groupname : function(){
							return $('#input_id_groupname').val();
						}
					}
				},
			  },
			  radio1 : {
				required: true
			  },
			},
			
			messages: {
				input_nama_group :{
					remote:'Nama Group Telah dipakai..!!'
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
		
		
		
		
		
		$('#update_group').click(function(){
			
			var valid = $('#form_edit_group').valid();
			if(valid == true)
			{
				$.post('<?php echo base_url();?>address/group/update_group',$('#form_edit_group').serialize(),function(data){
					
					if(data)
					{
						location.reload();
						//$('#tabel_group').html(data);
						//hideedit();
					}
				});
			}
			
		});
		
		
	});

	function showadd()
	{
		$('#show_edit_group').hide();
		$('#tambah_group').show();
	}
	
	function hideadd()
	{
		$('#tambah_group').hide();
	}

	function hideedit()
	{
		$('#show_edit_group').hide();
	}
	
	
	
	function editgroup(id_groupname)
	{
		$('#tambah_group').hide();
		$.post('<?php echo base_url();?>address/group/show_group',{id_groupname:id_groupname},function(data){
			$('#show_edit_group').show();
			//console.log(data);
			
			$('#input_id_groupname').val(data.id_groupname);
			$('#input_nama_group').val(data.nama_group);
			$('[id=radio_color]').filter('[value='+data.color+']').attr('checked','checked');
			
		},'json');
		
	}

</script>

<div id="groupmgmt" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3>Group Management</h3>
	</div>
	<div class="modal-body">
		<?php if($role_id == '1'){?>
		<div class="btn-group">
			<a class="btn" data-toggle="dropdown" onclick="showadd();"><i class="icon-plus"></i></a>
			<a class="btn" id="hapus" ><i class="icon-trash"></i></a>
		</div>
		<?php } ?>
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th><input type="checkbox" id="cekall" ></th>
					<th>Group Name</th>
					<th>Members</th>
					<th>Color</th>
					<th>Action</th>
				<tr>
			</thead>
			<tbody id="tabel_group">
				<?php //var_dump($group);?>
				<?php if($group){?>
				<?php foreach($group as $g) {?>
				
				<tr>
				<td><input class="groupdata" id="id_group_<?php echo $g->id_groupname; ?>" type="checkbox" name="id_group[]" value="<?php echo $g->id_groupname; ?>" ></td>
				<td> <?php echo $g->nama_group; ?></td>
				<td><?php echo $g->jml; ?></td>
				<td><span class="label badge-<?php echo $g->color; ?>">&nbsp;&nbsp;</span></td>
				<td><a class="btn" onclick="editgroup('<?php echo $g->id_groupname; ?>')"> edit </a></td>
				</tr>
				<?php }?>
				<?php }?>
			</tbody>
		</table>
		
		<div class="hide" id="tambah_group">
		<legend>Add Group</legend>
		<form class="form-horizontal" id="add_group_form">
			<div class="control-group">
				<label class="control-label">Group Name</label>
				<div class="controls">
					<input type="text" name="group_name" class="input-large" placeholder="Group Name">
				</div>
			</div>
		
		
		
	
			<!-- Colour Option -->
			<div class="control-group" id="color">
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
			<div class="pull-right controls">
			<button class="btn" onclick="hideadd();" type="button">Batal</button>
			<button class="btn btn-primary" id="add_group" type="button">Save</button>
			</div>

		</div>



		<div class="hide" id="show_edit_group">
		<legend>Edit Group</legend>
			<div class="pull-right controls">
			<button class="btn" onclick="hideedit();" type="button">Batal</button>
			<button class="btn btn-primary" id="update_group" type="button">Save</button>
			</div>
		<form class="form-horizontal" id="form_edit_group">
			<div class="control-group">
				<label class="control-label">Group Name</label>
				<div class="controls">
					<input type="hidden" id="input_id_groupname" name="input_id_groupname" >
					<input type="text" class="input-large" placeholder="Group Name" id="input_nama_group" name="input_nama_group">
				</div>
			</div>
			<!-- Colour Option -->
			<div class="control-group">
				<label class="control-label">Colour</label>
				<div class="controls span1">
					<label class="radio">
						<input type="radio" name="radio1" value="e7e7e7" id="radio_color" > <span class="label badge-e7e7e7">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="c2c2c2" id="radio_color"> <span class="label badge-c2c2c2">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="ffc8af" id="radio_color" > <span class="label badge-ffc8af">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="ff7537" id="radio_color" > <span class="label badge-ff7537">&nbsp;&nbsp;</span>
					</label>
				</div>
				<div class="controls span1">
					<label class="radio">
						<input type="radio" name="radio1" value="b6cff5" id="radio_color"> <span class="label badge-b6cff5">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="4986e7" id="radio_color"> <span class="label badge-4986e7">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="ffdeb5" id="radio_color"> <span class="label badge-ffdeb5">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="ffad46" id="radio_color"> <span class="label badge-ffad46">&nbsp;&nbsp;</span>
					</label>
				</div>
				<div class="controls span1">
					<label class="radio">
						<input type="radio" name="radio1" value="98d7e4" id="radio_color"> <span class="label badge-98d7e4">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="2da2bb" id="radio_color"> <span class="label badge-2da2bb">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="fbe983" id="radio_color"> <span class="label badge-fbe983">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="ebdbde" id="radio_color"> <span class="label badge-ebdbde">&nbsp;&nbsp;</span>
					</label>
				</div>
				<div class="controls span1">
					<label class="radio">
						<input type="radio" name="radio1" value="e3d7ff" id="radio_color"> <span class="label badge-e3d7ff">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="b99aff" id="radio_color"> <span class="label badge-b99aff">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="fdedc1" id="radio_color"> <span class="label badge-fdedc1">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="cca6ac" id="radio_color"> <span class="label badge-cca6ac">&nbsp;&nbsp;</span>
					</label>
				</div>
				<div class="controls span1">
					<label class="radio">
						<input type="radio" name="radio1" value="fbd3e0" id="radio_color"> <span class="label badge-fbd3e0">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="f691b2" id="radio_color"> <span class="label badge-f691b2">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="b3efd3" id="radio_color"> <span class="label badge-b3efd3">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="42d692" id="radio_color"> <span class="label badge-42d692">&nbsp;&nbsp;</span>
					</label>
				</div>
				<div class="controls span1">
					<label class="radio">
						<input type="radio" name="radio1" value="f2b2a8" id="radio_color"> <span class="label badge-f2b2a8">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="fc4c2f" id="radio_color"> <span class="label badge-fc4c2f">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="a2dcc1" id="radio_color"> <span class="label badge-a2dcc1">&nbsp;&nbsp;</span>
					</label>
					<label class="radio">
						<input type="radio" name="radio1" value="16a765" id="radio_color"> <span class="label badge-16a765">&nbsp;&nbsp;</span>
					</label>
				</div>
			</div>
			<!-- Colour Option -->
		</form>		
		</div>



	</div>
	<br>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
	</div>
</div>
