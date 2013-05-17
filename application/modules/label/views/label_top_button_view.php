<?php $role_id = $this->session->userdata('level');?>
<script>
	
	$(document).ready(function(){
		
		$('#search').submit(function(event){
			event.preventDefault();
			$.post('<?php echo base_url();?>label',$('#search').serialize()+"&reload=1",function(data) {
				$("#tampil_data").html(data);
				applyPagination();
			});
		});
		
		
		$('#label_add').click(function(){
			
			$.get('<?php echo base_url();?>label/add_additional_label',function(data){
				
				$('#show_modal').html(data);
				$('#addlabel').modal('show');
			});
			
		});
		
		$('#hapus_label').click(function(){
			var id =  $('.label_list:checkbox').map(function() {
				if(this.checked){
				   return this.value;
				  }
			}).get();
		
			$.post('<?php echo base_url();?>label/hapus_label',{id:id},function(){
				
					location.reload();
					//console.log(id);
				
			});
			
		});
		
		
		$('#alert').click(function(){
			
			var id =  $('.label_list:checkbox').map(function() {
			if(this.checked){
				   return this.value;
				  }
			}).get();
			if(id != '')
			{
				$('#konfirm').modal('show');
			}
		});

		
	});
	
	function checkall()
	{		
		var action = 'cek';
		if($('#checkall_label').attr('checked'))
		{
			action = 'uncek';
			$('#checkall_label').removeAttr('checked');

		}else{
			$('#checkall_label').attr('checked','checked');
		}
		
		$('.label_list:checkbox').map(function() {
			if(action == 'cek'){
				$("#"+this.id).prop('checked', true);
			}else{
				$("#"+this.id).removeAttr("checked");
			}
		});
	}
	
	
	
	
	function show_edit(id_labelname)
	{
		$.get('<?php echo base_url(); ?>label/edit_additional_label/'+id_labelname,function(data){
			if(data != '')
			{
				$('#show_modal').html(data);
				$('#editlabel').modal('show');
			}
			else
			{
				$('#noacc').modal('show');
			}
		});
	}
	
</script>
<?php if($role_id == '1' || $role_id == '2'){?>
<div class="btn-group">
	<a class="btn" id="label_add">+ <i class="icon-tags"></i></a>
	<a class="btn" id="alert"><i class="icon-trash"></i></a>
</div>
<?php }?>
<form class="form-search pull-right" id="search">
  <input type="text" class="input-medium search-query" autocomplete="off" name="keyword" id="keyword" placeholder="Search label ...	">
  <button type="submit" class="btn">Search</button>
</form>
<hr>
<ul class="breadcrumb">
	<li>
		<a href="<?php echo base_url();?>">Dashboard</a>
		<span class="divider">/</span> 
	</li>
	<li class="active">Label<span class="divider">/</span></li>
	<li class="active">Additional Label</li>
</ul>
<a class="btn btn-primary pull-right" href="<?php echo base_url();?>label/system">Go to System Label</a>
<div class="modal fade hide" id="konfirm">
	<div class="modal-header">
	<h6>Ingin Menghapus Label ini ?</h6> 
	</div>
	<div class="modal-body pull-right">
	<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Batal</a>
	<a href="#" class="btn btn-danger" id="hapus_label">Hapus</a>
	</div>
</div>
