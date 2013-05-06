<script type="text/javascript">
	
	$(document).ready(function(){
		
		$('#set_archive').click(function(){
			var thread =  $('.pesan_list:checkbox').map(function() {
				if(this.checked){
				   return this.value;
				  }
			}).get();
			//console.log(thread);
			
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
		

		$('#hapus_pesan').click(function(){
			
			var id =  $('.pesan_list:checkbox').map(function() {
				if(this.checked){
				   return this.value;
				  }
			}).get();
			//maek this make labeled trash
			$.post('<?php echo base_url();?>dashboard_data/hapus_message',{id:id},function(){
				
				location.reload();
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
				
				console.log(data);
				//if(data == 'true')
				//{
					//reloadz();
					//applyPagination();
					//location.reload();
				//}
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
		



	});
	
	//$('#checkall_pesan').click(function(){
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
	//});
	
	function read_sms(thread)
	{
		$.get('<?php echo base_url();?>dashboard_data/read_sms_modal',{thread:thread,label:'<?php if($label){ echo $label; } ?>'},function(data){
			
			$('#show_modal').html(data);
			$('#readsms').modal('show');
			
		});
	}
	function reloadz()
	{
		$.post('<?php echo base_url();?>message/<?php if($label){ echo $label; } ?>/',$('#search').serialize()+"&reload=1",function(data) {
			$("#tampil_data").html(data);
			applyPagination();
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
	<a class="btn" id="hapus_pesan" ><i class="icon-trash"></i></a>
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
