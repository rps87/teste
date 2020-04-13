<?php if ( ! defined('ABSPATH')) exit; ?>

<?php //if ( $this->login_required && ! $this->logged_in ) return; ?>

<!--nav class="menu clearfix"-->
<nav class="navbar navbar-expand-sm bg-light navbar-light">
	<a class="navbar-brand" href="<?php echo HOME_URI;?>">SisPNR</a>
	<ul class="navbar-nav">
		<li class="nav-item"><a class="nav-link" href="<?php echo HOME_URI;?>/cadastro/">Cadastro</a></li>
		<li class="nav-item"><a class="nav-link" href="<?php echo HOME_URI;?>/logout/">Logout</a></li>
	</ul>
</nav>