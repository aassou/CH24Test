<div class="navbar-inner">
	<div class="container-fluid">
	    <a class="brand"><img src="../assets/img/logo-index.png" alt="logo" /></a>
		<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
            <img src="../assets/img/menu-toggler.png" alt="" />
		</a>    	
		<?php if( isset($_SESSION['userCH24Test']) ){ ?>
		<ul class="nav pull-right">
			<li class="dropdown user">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<i class="icon-user"></i>
				</a>
				<ul class="dropdown-menu">
					<li><a href="logout.php"><i class="icon-key"></i>&nbsp;Déconnexion</a></li>
				</ul>
			</li>
		</ul>
		<?php } ?>	
	</div>
</div>