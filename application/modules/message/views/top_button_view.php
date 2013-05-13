<script type="text/javascript">
	
	$(document).ready(function(){
		
		
		<?php if($label){ ?>
		 
			<?php if($label != 'inbox'){ ?>
			$('#set_archive').hide();
			<?php } ?>
			
		<?php } ?>
		
		$('#set_archive').click(function(){
			var thread =  $('.pesan_list:checkbox').map(function() {
				if(this.checked){
				   return this.value;
				  }
			}).get();
			
			$.post('<?php echo base_url();?>dashboard_data/set_archive',{thread:thread},function(){
				
				location.reload();
				
				
			});
			
		});
		
		
		$('form#search').submit(function(event){
			event.preventDefault();
			$.post('<?php echo base_url();?>message/<?php if($label){ echo $label; } ?>/',$('#search').serialize()+"&reload=1",function(data) {
				$("#tampil_data").html(data);
				applyPagination();
			});
		});
		

		$('.dropdown-menu a#labelcek').click(function(e) {
		  e.stopPropagation();
		});
		
		$('#pindah_dari_trash').click(function(){
			
			var clist =  $('.pesan_list:checkbox').map(function() {
				if(this.checked){
				   return this.value;
				  }
			}).get();
			
			if(clist !='')
			{
				$('#move_from_trash').modal('show');
			}			
			
		});
		
		$('#blacklist_this').click(function(){
			
			var blist =  $('.pesan_list:checkbox').map(function() {
				if(this.checked){
				   return this.value;
				  }
			}).get();
			
			$.post('<?php echo base_url();?>dashboard_data/mark_spam',{thread:blist},function(data){
				console.log(data);
				if(data == 'true')
				{
					location.reload();
				}
				
				
			});
			
		});
		
		$('#remove_blacklist_this').click(function(){
			
			var blist =  $('.pesan_list:checkbox').map(function() {
				if(this.checked){
				   return this.value;
				  }
			}).get();
			
			$.post('<?php echo base_url();?>dashboard_data/remove_blacklist',{thread:blist},function(data){
				console.log(data);
				if(data == 'true')
				{
					location.reload();
				}
				
				
			});
			
		});
		
		$('#remove_from_trash').click(function(){
			var list_trash =  $('.pesan_list:checkbox').map(function() {
				if(this.checked){
				   return this.value;
				  }
			}).get();

			$.post('<?php echo base_url();?>dashboard_data/remove_from_trash',{thread:list_trash},function(data){
				if(data == 'true')
				{

					location.reload();
				}
			});
			
		});
		
		
		$('#hapus_pesan').click(function(){
			
			var id =  $('.pesan_list:checkbox').map(function() {
				if(this.checked){
				   return this.value;
				  }
			}).get();
			//maek this make labeled trash
			$.post('<?php echo base_url();?>dashboard_data/hapus_message',{id:id},function(data){
				if(data == 'true')
				{

					location.reload();
				}
				//	console.log(data);
				
			});
		});
		
		

		
		
		$('#terapkan_label').click(function(){
			
			var id_label =  $('.labelcek:checkbox').map(function() {
				if(this.checked){
				   return this.value;
				  }
			}).get();
			
			var value_thread =  $('.pesan_list:checkbox').map(function() {
				if(this.checked){
				   return this.value;
				  }
			}).get();
			
			$.post('<?php echo base_url();?>dashboard_data/apply_label',{id_label:id_label,thread:value_thread},function(data){
				if(data == 'true')
				{

					location.reload();
				}
			});

		});
		
	
		$('.labelcek').click(function(){
			
			var labelcek =  $('.labelcek:checkbox').map(function() {
				if(this.checked){
				   return this.value;
				  }
			}).get();
			if(labelcek !='')
			{
				$('#terapkan').show();
			}
			else
			{
				$('#terapkan').hide();
			}
		});
		
		$('#alert').click(function(){
			var ceklist =  $('.pesan_list:checkbox').map(function() {
				if(this.checked){
				   return this.value;
				  }
			}).get();
			
			if(ceklist !='')
			{
				$('#konfirm').modal('show');
			}

		});
		


	});
	
	function checkall()
	{		
			var action = 'cek';
			if($('#checkall_pesan').attr('checked'))
			{
				action = 'uncek';
				$('#checkall_pesan').removeAttr('checked');
			}else{
				$('#checkall_pesan').attr('checked','checked');
			}
			
			$('.pesan_list:checkbox').map(function() {
				if(action == 'cek'){
					$("#"+this.id).prop('checked', true);
					$('#top_btn').show();

				}else{
					$("#"+this.id).removeAttr("checked");
					$('#top_btn').hide();
				}
			});
	}
	
	function read_sms(thread)
	{
		$.get('<?php echo base_url();?>dashboard_data/read_sms_modal',{thread:thread,label:'<?php if($label){ echo $label; } ?>'},function(data){
			
			$('#show_modal').html(data);
			$('#readsms').modal('show');
			
		});
	}
	
	function reloadz()
	{
		location.reload();

		//$.post('<?php echo base_url();?>message/<?php if($label){ echo $label; } ?>/',$('#search').serialize()+"&reload=1",function(data) {
		//	$("#tampil_data").html(data);
			applyPagination();
		//});
	}
	
	function edit_address(id_address_book)
	{
		$.post('<?php echo base_url();?>address/edit_address/'+id_address_book,function(data){
			
			$('#show_modal').html(data);
			$('#editaddress').modal('show');
		});
	}
</script>

<div id="top_btn" class="btn-group animated hide">
	<a class="btn" id="set_archive"><i class="icon-hdd" ></i></a>
	<a id="menu_label" class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-tags"></i> <span class="caret"></span></a>
	<ul  class="dropdown-menu">
		<?php if(isset($list_label)){?>
		<?php foreach($list_label as $ll){?>
			<li>
				<a   id="labelcek"><input class="labelcek" id="label_to_<?php echo $ll->id_labelname;?>"type="checkbox" value="<?php echo $ll->id_labelname;?>" >&nbsp;&nbsp;<span class="label badge-<?php echo $ll->color;?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <?php echo $ll->name;?></a>
			</li>
		
		<?php }?>
		<?php }?>
		<li class="divider"></li>
		<li id="terapkan" class="hide">
			<a id="terapkan_label">Terapkan Label</a>
		</li>
	</ul>
	<?php if(isset($label)){ if($label != 'trash'){ ?>
		<a data-placement="bottom" rel="tooltip" data-title="Move to Trash"  class="btn" id="alert" ><i class="icon-trash"></i></a>
		<?php }else{ ?>
		<a href="#" data-placement="bottom" rel="tooltip" data-title="Move From Trash"   class="btn" id="pindah_dari_trash" ><i class="icon-share"></i></a>
		<?php } ?>
	<?php }?>
	<?php if(isset($label)){ if($label != 'spam'){ ?>
	<a href="#mark_as_spams" data-toggle="modal" data-placement="bottom" rel="tooltip" data-title="Mark Spam" class="btn" id="marks" ><i class="icon-warning-sign"></i></a>
		<?php }else{ ?>
	<a href="#mark_not_spams" data-toggle="modal" data-placement="bottom" rel="tooltip" data-title="Bukan Spam" class="btn" id="marks" >Bukan Spam</a>
		<?php } ?>
	<?php }?>
	
</div>
<form class="form-search pull-right" id="search">
  <input type="hidden" name="label" value="<?php if($label){ echo $label; } ?>">
  <input type="text" name="keyword" id="keyword" class="input-medium search-query" placeholder="Search keyword ...	">
  <button type="submit" class="btn">Search</button>
</form>
<hr>
<ul class="breadcrumb">
	<li>
		<a href="#">Dashboard</a>
		<span class="divider">/</span> 
	</li>
	<li class="active"><?php if($label){ echo $label; } ?></li>
</ul> 

<div class="modal fade hide" id="mark_as_spams">
	<div class="modal-header">
	<h6>Mark As SPAM ?</h6> 
	</div>
	<div class="modal-body pull-right">
	<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Batal</a>
	<a href="#" class="btn btn-danger" id="blacklist_this">Mark SPAM</a>
	</div>
</div>

<div class="modal fade hide" id="mark_not_spams">
	<div class="modal-header">
	<h6>Bukan SPAM ?</h6> 
	</div>
	<div class="modal-body pull-right">
	<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Batal</a>
	<a href="#" class="btn btn-success" id="remove_blacklist_this">Bukan Spam</a>
	</div>
</div>

<div class="modal fade hide" id="konfirm">
	<div class="modal-header">
	<h6>Ingin Menghapus thread ini ?</h6> 
	</div>
	<div class="modal-body pull-right">
	<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Batal</a>
	<a href="#" class="btn btn-danger" id="hapus_pesan">Hapus</a>
	</div>
</div>

<div class="modal fade hide" id="move_from_trash">
	<div class="modal-header">

	<h6>Ingin Megembalikan Pesan ?</h6> 

	</div>
	<div class="modal-body pull-right">
	<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Batal</a>
	<a href="#" class="btn btn-info" id="remove_from_trash">Kembalikan</a>
	</div>
</div>
