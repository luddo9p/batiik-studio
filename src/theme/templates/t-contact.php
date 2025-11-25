<?php
/*
Template Name: Contact
*/

get_header(); 
?>

<main data-barba="container" data-barba-namespace="contact">
  <section class="contact-container">
    <?php
      get_template_part('components/c-about-left');
      get_template_part('components/c-contact-form');
    ?>
  </section>
</main>

<?php get_footer(); ?>