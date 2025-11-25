<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<!-- <meta name="viewport" content="width=device-width"> -->
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<?php
    $favicon = get_field('favicon', 'option');
    if(isset($favicon)):
        ?>
        <link rel="icon" type="image/png" href="<?= $favicon; ?>" />
        <?php
    endif;
    ?>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-barba="wrapper">

<?php $mainColor = get_field('main_color', 'options'); ?>
<style>
	.link-hover {
		transition: color 0.2s ease;
	}
	.link-hover:hover { 
		color: <?= $mainColor; ?>;
	}
</style>

<?php 
	get_template_part('components/c-loader');
	get_template_part('components/c-nav');
	get_template_part('components/c-burger');
?>