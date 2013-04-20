          <div class="row-fluid">
            <div class="span12">
				
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th><input type="checkbox"></th>
			<th>Name</th>
			<th>Number</th>
			<th>Group</th>
			<th>Operator</th>
			<th>Last Message</th>
		</tr>
	</thead>
    <tbody>
	<?php if(isset($data)) {?>
	
		<?php for($i=0;$i < count($data);$i++){ ?> 
			<tr>
				<td>
					<input class="address_list" type="checkbox" id="id_address_book_<?php echo $data[$i]['id_address_book'] ?>" value="<?php echo $data[$i]['id_address_book'] ?>"> 
				</td>
				<td>
					<a href="#" onclick="edit_address('<?php echo $data[$i]['id_address_book'] ?>')"><strong><?php echo $data[$i]['first_name'];?> <?php if($data[$i]['last_name']){echo $data[$i]['last_name']; }?></strong></a>
				</td>
				<td>
					<a href="#" onclick="edit_address('<?php echo $data[$i]['id_address_book'] ?>')"><strong><?php echo $data[$i]['number'];?></strong></a>
				<td>
					<?php $group = $data[$i]['group']; if($group){ ?>
					<?php for($j=0;$j< count($group);$j++){?>
						<?php echo $group[$j];?><br>
					<?php } ?>
					<?php }else{ ?>
					<?php echo 'No Group'; ?>
					<?php } ?>
					
				</td>
				<td>
					<?php if($data[$i]['operator']){echo $data[$i]['operator'];} else { echo 'Unknown Operator'; }?>
				</td>
				<td>
					<?php if($data[$i]['last_message']){?>
					<?php echo date('j F Y',$data[$i]['last_message']);?><br>
					<small><?php echo date('g:i a',$data[$i]['last_message']);?><br></small>
					<?php } else {?>
					<?php echo 'No Data';?>
					<?php }?>
				</td>
			</tr>
			<tr>
		<?php } ?>
	<?php } ?>
	</tbody>
</table>
<div align="center">
	<div class="pagination">
	  <ul>
	    <li class="disabled"><a href="#">&laquo;</a></li>
	    <li class="active"><a href="#">1</a></li>
	    <li><a href="#">2</a></li>
	    <li><a href="#">3</a></li>
	    <li><a href="#">4</a></li>
	    <li><a href="#">5</a></li>
	    <li><a href="#">&raquo;</a></li>
	  </ul>
	</div>
</div>
            </div>
          </div>
        </div>
      </div>
    </div>
<div id="show_modal"> </div>
