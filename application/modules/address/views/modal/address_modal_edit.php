<script>

	$(document).ready(function(){
		$.post('<?php echo base_url();?>address/group/get_group',function(data){

			$('#data_group').html(data);

		});

		$.post('<?php echo base_url();?>address/get_address_book_detail/<?php if(isset($id_address_book)){echo $id_address_book;} ?>',function(data){

		//console.log(data);
		$('#top_first').html(data.first_name);
		$('#top_last').html(data.last_name);
		$('#phone').val(data.number);
		$('#firstname').val(data.first_name);
		$('#lastname').val(data.last_name);
		$('#email').val(data.email);
		for(var i=0;i< data.group.length;i++ )
		{
			$('#group_'+data.group[i].id_groupname).attr('checked');
			console.log(data.group[i].id_groupname);
		}

		//$().val();

		},'json');




	});

</script>

<div id="editaddress" class="modal hide fade">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3><span id="top_first"></span>  <span id="top_last"> </span></h3>
	</div>
	<div class="modal-body">
		<form class="form-horizontal">
		<input type="hidden" id="id_address_book" name="id_address_book">

			<div class="control-group">
				<label class="control-label">Phone Number</label>
				<div class="controls">
<!-- 					<input type="text" class="input-large" placeholder="Phone number" id="phone" name="phone" > -->
				</div>
			</div>

			<div class="control-group">
				<label class="control-label">First Name</label>
				<div class="controls">
					<input type="text" class="input-large" placeholder="First Name" id="firstname" name="firstname" value="<?php echo $address['first_name'];?>">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Last Name</label>
				<div class="controls">
					<input type="text" class="input-large" placeholder="Last Name" id="lastname" name="lastname">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Email</label>
				<div class="controls">
					<input type="text" class="input-large" placeholder="Email Address" id="email" name="email">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Groups</label>
<!-- 				<div id="data_group"> </div> -->
				<?php if($group){?>
					<?php foreach($group as $row){?>
					<div class="controls">
						<label class="checkbox">
							<input value="<?php echo $row->id_groupname;?>" type="checkbox" checked disabled="yes"><?php echo $row->nama_group;?>
						</label>
					</div>
					<?php }?>
				<?php }?>
				
				
				</label>
			   	
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
		<a href="#" class="btn btn-info">WHMCS Sync</a>
		<a href="#" class="btn btn-primary">Save changes</a>
	</div>
</div>
