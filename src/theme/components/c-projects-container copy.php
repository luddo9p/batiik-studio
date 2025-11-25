<?php
  $args = array(
      'post_type' => 'projects',
      'orderby'   => 'menu_order',
      'order'     => 'ASC',
      'nopaging'  => true
  );
  $projects = new WP_Query($args);
  if ($projects->have_posts()) :
  ?>
  <section class="projects-container">
    <div class="projects-container__wrapper js-horizontal-scroll-wrapper">

    <?php
      while ($projects->have_posts()) : $projects->the_post();
          $post_id = get_the_ID();
      ?>
      <div class="projects-container__column js-column">
        <div class="js-column-container">
          <div class="js-image-container">
            <div class="project-container__img js-image" style="background-image: url(<?= get_the_post_thumbnail_url( $post_id, 'full' ); ?>)"></div>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
      
    </div>
  </section>
  <?php
  endif;
  wp_reset_query();
  ?>