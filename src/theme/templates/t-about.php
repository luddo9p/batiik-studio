<?php
/*
Template Name: About
*/

get_header(); 
?>

<main data-barba="container" data-barba-namespace="about">
  <section class="about-container">
    <?php
      get_template_part('components/c-about-left');
      get_template_part('components/c-about-right');
    ?>
    <div class="mobile-only">
       <?php get_template_part('components/c-about-left'); ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>