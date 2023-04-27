<?php
/**
 * The header template file
 *
 * This is the content displayed on top of your content.
 * It is included on all the template files.
 *
 */

?>
<header id="header" role="banner" itemscope itemtype="http://schema.org/WPHeader">

	<nav class="nav-primary">
		<?php
		if (has_nav_menu('primary_navigation')) :
			wp_nav_menu(['theme_location' => 'primary_navigation']);
		endif;
		?>

	</nav>

	<hgroup>
		<h1 itemprop="name">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		</h1>
		<p itemprop="description">
			<?php bloginfo( 'description' ); ?>
		</p>
	</hgroup>
</header>
