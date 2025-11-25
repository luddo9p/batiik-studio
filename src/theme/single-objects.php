<?php
get_header(); 
?>

<main data-barba="container" data-barba-namespace="object">
  <?php
    get_template_part('components/c-object-container');
    get_template_part('components/c-object-container-mobile');
  ?>
</main>

<?php get_footer(); ?>