<body>
<header>
	<div id="menu">
		<ul>
			<li class="no_border">
				<a href="/">Home</a>
			</li>
			<li>
				<a href="/categories.php">Categories</a>
			</li>
			<li>
				<a href="/cart.php">My Cart</a>
			</li>
			<?php 
				if ($is_admin)
					echo "<li><a href=\"/admin/home.php\">Admin</a></li>";
				if ($is_logged)
				{
					if (!$is_admin)
						echo "<li><a href=\"/account.php\">Account</a></li>";
					echo "<li><a href=\"/logout.php\">Logout</a></li>";
				}
				else 
					echo "<li><a href=\"/login.php\">Login</a></li>";
			?>
		</ul>
	</div>
</header>