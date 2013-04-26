<script>
	$(document).ready(function(){
		//$(function() {
		//	$('#'+location.pathname.split("/")[3]).addClass('active');
		//});
		var activeurl = window.location;
		$('a[href="'+activeurl+'"]').parent('li').addClass('active');
	});

</script>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span3">
<a class="btn btn-large btn-success btn-block" >COMPOSE</a>
<ul class="nav  nav-pills nav-stacked">
	<?php if(isset($baku)){ ?>
	<?php for($i=0;$i<count($baku);$i++) {?>
		
    <li id="<?php echo $baku[$i]['name'];?>">
      <a href="<?php echo base_url();?>message/<?php echo $baku[$i]['name'];?>"> <?php echo $baku[$i]['name'];?>
      <?php if($baku[$i]['count'] != false) { ?>
      <span class="badge badge-important"><?php echo $baku[$i]['count'];?></span>
      <?php } ?> 
      </a>
    </li>
    <?php } ?>
    <?php } ?>
    
    <li><hr></li>
    <li class="nav-header">Label</li>
    
	<?php if(isset($add)){?>
		<?php for($i=0;$i<count($add);$i++) { ?>
	<li>
		<a href="<?php echo base_url('message/'.$add[$i]['name']); ?>"><?php echo $add[$i]['name']; ?> <?php if($add[$i]['count']){?> (<?php echo $add[$i]['count'];?>) <?php } ?>  <span class="label badge-<?php echo $add[$i]['color']; ?>">&nbsp;&nbsp;</span></a>
	</li>
		<?php }?>
	<?php }?>

  </ul>
  <div class="well">
    <p>
      <b>Tip:</b> You can add additional components to your layout easily.</p>
  </div>
  
        </div>
		<div class="span9">
			
			
