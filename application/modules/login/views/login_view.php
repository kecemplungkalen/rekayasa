<div class="navbar">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="<?php echo base_url();?>">
				Rumahweb Indonesia
			</a>		
		</div> <!-- /container -->
	</div> <!-- /navbar-inner -->
</div> <!-- /navbar -->
		<br><br><br>
	
		
		<div  class="span5 offset4" >
			<div class="warning" id="warning"> 
				<?php if(isset($data)){ ?>
				<div class="alert alert-error">
					<a class="close" data-dismiss="alert" href="#">&times;</a>
					<strong><?php echo $data;?></strong>
				</div>
				<?php }?>
			</div>


			<div class="well well-large" style="text-align:center;">
				<form action="<?php echo base_url();?>login/user_login" method="post" />
					<legend><h3 class="text-center">Login Panel</h3></legend>
						<p>Sign in using your registered account:</p>
						<div>
							<label class="help-inline" for="username">Username:</label>
							<input autocomplete="off" type="text" id="username" name="username"  placeholder="Username" class="login username-field" />
						</div> <!-- /field -->
						
						<div>
							<label class="help-inline" for="password">Password:</label>
							<input autocomplete="off" type="password" id="password" name="password" placeholder="Password" class="login password-field" />
						</div>
						
							<button type="submit" class="btn btn-info btn-large btn-block">Sign In</button> 
				</form>
			</div>

		</div>
