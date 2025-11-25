<?php
/*
Template Name: Projects
*/

get_header(); ?>

<main data-barba="container" data-barba-namespace="projects">
  <?php
    get_template_part('components/c-projects-container');
    get_template_part('components/c-projects-container-mobile');
  ?>
</main>

<?php get_footer(); ?>