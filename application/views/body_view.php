<body>
<?php if(isset($navbar)){ echo $navbar;}?>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span3">
			<?php if(isset($sidebar)){ echo $sidebar;}?>
        </div>
		<div class="span9">
			<?php if(isset($top_button)){ echo $top_button; }?>
          <div class="row-fluid">
            <div class="span12" id="tampil_data">
					<?php if(isset($content)){echo $content;}?>
					
				 <div id="show_modal"> </div>

            </div>
          </div>
        </div>
      </div>
 </div>

</body>
