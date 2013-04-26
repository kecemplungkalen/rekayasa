<script type="text/javascript">
	
	$(document).ready(function(){
		
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
		
			$.post('<?php echo base_url();?>dashboard_data/hapus_message',{id:id},function(data){
				
				location.reload();
				//	console.log(data);
				
			});
		});
		
		
		$('.remove_label').click(function(){
			var id_label = $(this).data('value');
			$.post('<?php echo base_url();?>dashboard_data/hapus_label',{id_label:id_label},function(data){
				if(data)
				{
					location.reload();
				}
			});
		});
		
		
		
		$('#terapkan_label').click(function(){
			
			var id_label =  $('.labelcek:checkbox').map(function() {
				if(this.checked){
				   return this.value;
				  }
			}).get();
			
			var id_pesan =  $('.pesan_list:checkbox').map(function() {
				if(this.checked){
				   return this.value;
				  }
			}).get();
			
			$.post('<?php echo base_url();?>dashboard_data/apply_label',{id_label:id_label,id_pesan:id_pesan},function(data){
				if(data)
				{
					location.reload();
				}
			});

		});
		
		$('.pesan_list').click(function(){
			
			var id =  $('.pesan_list:checkbox').map(function() {
				if(this.checked){
				   return this.value;
				  }
			}).get();
			if(id != '')
			{
				$('#top_btn').show();
			}
			else
			{
				$('#top_btn').hide();
			}
			//console.log(id);
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
		
		$('#checkall_pesan').click(function(){
			
			var action = 'cek';
			if($('#checkall_pesan').attr('checked'))
			{
				action = 'uncek';
				$('#checkall_pesan').removeAttr('checked');
				$('#hapus_pesan').hide();
			}else{
				$('#checkall_pesan').attr('checked','checked');
				$('#hapus_pesan').show();
			}
			
			$('.pesan_list:checkbox').map(function() {
				if(action == 'cek'){
					//$("#"+this.id).removeAttr("checked");
					//$("#"+this.id).attr("checked","checked");
					//$('.checkbox input[type="checkbox"]').prop('checked', true);
					$("#"+this.id).prop('checked', true);
				}else{
					$("#"+this.id).removeAttr("checked");
				}
			});
		});


	});
	
	

</script>

<div id="top_btn" class="btn-group animated hide">
	<a class="btn"><i class="icon-hdd" ></i></a>
	<a id="menu_label" class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-tags"></i> <span class="caret"></span></a>
	<ul  class="dropdown-menu">
		<?php if(isset($list_label)){?>
		<?php foreach($list_label as $ll){?>
			<li>
				<a   id="labelcek"><input class="labelcek" type="checkbox" value="<?php echo $ll->id_labelname;?>" >&nbsp;&nbsp;<span class="label badge-<?php echo $ll->color;?>">&nbsp;&nbsp;&nbsp;&nbsp;</span> <?php echo $ll->name;?></a>
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
  <input type="text" name="keyword" class="input-medium search-query" placeholder="Search keyword ...	">
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
