<section class="projects-objects-mobile">
  <div class="projects-objects-mobile__wrapper">

  <?php if (have_rows('objects_columns')): ?>
    <?php while (have_rows('objects_columns')) : the_row(); ?>    

      <?php if (have_rows('column')): ?>
        <?php while (have_rows('column')) : the_row(); 
          $object = get_sub_field('object');  
          $pre_title = get_post_field('pretitle', $object->ID);
          $type = get_post_field('type', $object->ID);
          $object_title = $object->post_title;  
          $object_id = $object->ID;
          $object_link = get_permalink($object_id);
        ?>    
          <a class="projects-objects-mobile__project" href="<?= $object_link ?>">
            <!-- <div 
              class="projects-objects-mobile__img lazy js-to-appear js-to-appear--mobile" 
              data-src="<?= get_the_post_thumbnail_url( $object_id, 'full' ); ?>" 
              data-type="bg">
            </div> -->
            <img 
              class="projects-objects-mobile__img lazy js-to-appear js-to-appear--mobile" 
              data-src="<?= get_the_post_thumbnail_url( $object_id, 'full' ); ?>" 
              data-type="img"
              alt="Batiik Studio Object" 
            />
            <h3 class="projects-objects-mobile__title js-to-appear js-to-appear--mobile">
              <?php if ($pre_title): ?>
                <p class="pretitle"> <?= $pre_title ?> </p>
              <?php endif ?>
              <p class="title"> <?= $object_title ?> </p>
            </h3>
          </a>
        <?php endwhile; ?>
      <?php endif; ?>

    <?php endwhile; ?>
  <?php endif; ?>

  </div>
</section>