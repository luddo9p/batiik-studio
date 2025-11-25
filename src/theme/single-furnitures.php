<?php
get_header(); 
?>

<main data-barba="container" data-barba-namespace="project">
  <?php
    get_template_part('components/c-project-container');
    get_template_part('components/c-copyright');
    get_template_part('components/c-project-container-mobile');
  ?>
</main>

<?php get_footer(); ?>