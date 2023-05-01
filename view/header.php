<header>
	<nav>
		<div class="ui secondary pointing menu">
			<div class="ui left menu">
	    		<a class="ui item" href="/">Home</a>
				<a class="ui item" href="/create.php">Create New</a>
				<a class="ui item" href="#">Contact</a>
			</div>

			<div class="ui right menu">
				<?php if($user_id) {?>
					<a class="ui item" href="/logout.php">Logout</a>
					<a class="ui item" href="/"><?php echo $author->get_name(); ?></a>
				<?php } else { ?>
					<a class="ui item" href="#">Register</a>
					<a class="ui item" href="/login.php">Login</a>
				<?php } ?>
    		</div>
 		 </div>
	</nav>
</header>
