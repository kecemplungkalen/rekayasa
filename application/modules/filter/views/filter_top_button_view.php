<?php $role_id = $this->session->userdata('level');?>
<script type="text/javascript">
	
	$(document).ready(function(){
		
		$('#search').submit(function(event){
			event.preventDefault();
			$.post('<?php echo base_url();?>filter',$('#search').serialize()+"&reload=1",function(data) {
				$("#tampil_data").html(data);
				applyPagination();
			});
		});
		
		$('#hapus_filter').click(function(){
		var id =  $('.filter_list:checkbox').map(function() {
			if(this.checked){
			   return this.value;
			  }
		}).get();
	
			$.post('<?php echo base_url();?>filter/hapus_filter',{id:id},function(data){
				if(data == 'true')
				{
					location.reload();
				}
				
			});
		
		});
		
		$('#alert').click(function(){
			
			var id =  $('.filter_list:checkbox').map(function() {
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
	
	function add_filter()
	{
		$.get('<?php echo base_url();?>filter/add_filter_modal',function(data){
			
			$('#show_modal').html(data);
			$('#addfilter').modal('show');
		});
	}
	
	function enable_filter(id_filter)
	{
		$.post('<?php echo base_url();?>filter/switch_status',{status:'enable',id_filter:id_filter},function(data){
			if(data=='true')
			{
				location.reload();
			}
			
		});
		
	}
	
	function disable_filter(id_filter)
	{
		$.post('<?php echo base_url();?>filter/switch_status',{status:'disable',id_filter:id_filter},function(data){
			if(data)
			{
				location.reload();
				
			}
			
		});
	}
	
	function checkall()
	{
		var action = 'cek';
		if($('#checkall_filter').attr('checked'))
		{
			action = 'uncek';
			$('#checkall_filter').removeAttr('checked');

		}else{
			$('#checkall_filter').attr('checked','checked');
		}
		
		$('.filter_list:checkbox').map(function() {
			if(action == 'cek'){
				$("#"+this.id).prop('checked', true);
			}else{
				$("#"+this.id).removeAttr("checked");
			}
		});
	}

</script>
<?php if($role_id == '1'){?>
<div class="btn-group">
	<a class="btn dropdown-toggle" onclick="add_filter()" >+ <i class="icon-th"></i></a>
	<a class="btn" id="alert"><i class="icon-trash"></i></a>
</div>
<?php } ?>
<form class="form-search pull-right" id="search">
  <input type="text" name="keyword" autocomplete="off" id="keyword" class="input-medium search-query" placeholder="Search filter ...	">
  <button type="submit" class="btn">Search</button>
</form>
<hr>
<ul class="breadcrumb">
	<li>
		<a href="#">Dashboard</a>
		<span class="divider">/</span> 
	</li>
	<li class="active">Filter</li>
</ul>

<div class="modal fade hide" id="konfirm">
	<div class="modal-header">
	<h6>Ingin Menghapus Filter ini ?</h6> 
	</div>
	<div class="modal-body pull-right">
	<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Batal</a>
	<a href="#" class="btn btn-danger" id="hapus_filter">Hapus</a>
	</div>
</div>
