<?php

/**
 * Theme Wrapper.
 *
 * The goal of the theme wrapper is to
 * remove any repeated markup from individual template.
 *
 */

global $sitepress;
if ($sitepress) {
	$lang = ICL_LANGUAGE_CODE;
	$sitepress->switch_lang($lang);
}
?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	<script>
		var globalajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	</script>
</head>

<body <?php body_class(); ?> role="document" itemscope itemtype="http://schema.org/WebPage">
	<ul id="skip-link-reader">
		<li><a href="#content-anchor"><?php esc_html_e('Skip to content', 'custom'); ?></a></li>
	</ul>

	<div class="container">
		<?php get_header(); ?>
		<a name="content-anchor" class="accessibility">Main Content</a>
		<main id="main-content" role="main" itemprop="mainContentOfPage">
			<?php
			/*
				* Get the right WordPress template file.
				*/
			require custom_template_path();
			?>
		</main>

		<?php
		/*
			* Include the site sidebar.
			* Even if you don't need a sidebar, do not remove this line.
			*/
		get_sidebar();
		?>

	</div><!-- .site__content -->

	<?php get_footer(); ?>

	</div><!-- .site -->

	<?php wp_footer(); ?>
</body>

</html>