<?php
/*
Template Name: Legals 
*/

get_header(); 
?>

<main data-barba="container" data-barba-namespace="legals">
	<section class="legals">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<h1> <?= the_title(); ?> </h1>
			<?= the_content(); ?>
		<?php endwhile; endif; ?>
	</section>
</main>

<?php get_footer(); ?>