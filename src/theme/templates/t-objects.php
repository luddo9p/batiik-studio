<?php
/*
Template Name: Objects
*/

get_header(); ?>

<main data-barba="container" data-barba-namespace="objects">
  <?php
    get_template_part('components/c-objects-container');
    get_template_part('components/c-objects-container-mobile');
  ?>
</main>

<?php get_footer(); ?>