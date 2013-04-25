<script type="text/javascript">
	$(function() {
		applyPagination();
	});

	function applyPagination() {
		$(".pagination a").click(function() {
			//var filter = $('#filterid').val();
			var search = $('#keyword').val();
			var url = $(this).attr("href");
				$.ajax({
					type: "POST",
					data: "ajax=1&reload=1&keyword="+search,
					url: url,
					beforeSend: function() {
							$("#address_data").html('');
					},
					success: function(msg) {
						$("#address_data").html(msg);
						//console.log(msg);
					}
				});
			return false;
		});
	}
</script>
<!-- coba -->
<?php if(!$reload){ ?>
<div id="show_modal"> </div>
    <div class="row-fluid">
        <div class="span12">	
			<div id="address_data">
<?php } ?>
	<?php if(isset($address_data)){?>
		<?php echo $address_data;?>
	<?php }?>
<?php if(!$reload){ ?>
			</div>	
        </div>
    </div>
    </div>
   </div>
	<?php }?>

