<?php if (have_rows('objects_columns')): ?>
  <section class="objects-container">
    <div class="objects-container__wrapper js-horizontal-scroll__wrapper js-hover-image__wrapper">
      
    <?php while (have_rows('objects_columns')) : the_row(); ?>    

      <div class="objects-container__column js-horizontal-scroll__column js-hover-image__column">
        <div class="objects-container__column-images js-horizontal-scroll__column-container">

        <?php if (have_rows('column')): ?>
          <?php while (have_rows('column')) : the_row(); 
            $object = get_sub_field('object');  
            $object_id = $object->ID;
            $object_link = get_permalink($object_id);
            $thumbnailSecondId = get_post_field('thumbnail_hover', $object);
            $thumbnailSecondUrl = wp_get_attachment_image_src($thumbnailSecondId, 'full')[0];
          ?>

            <a class="objects-container__img-container js-horizontal-scroll__image-container js-hover-image__image-wrapper lazy-wrapper" href="<?= $object_link ?>" data-id="<?= $object_id ?>">
              <div 
                class="objects-container__img js-horizontal-scroll__image js-hover-image__image lazy" 
                data-src="<?= get_the_post_thumbnail_url( $object_id, 'full' ); ?>"
                data-type="bg"
              ></div>
              <div 
                class="objects-container__img hover-img js-horizontal-scroll__image js-hover-image__image lazy" 
                data-src="<?= $thumbnailSecondUrl ?>"
                data-type="bg"
              ></div>
            </a>

          <?php endwhile; ?>
        <?php endif; ?>

        </div>
        <div class="objects-container__column-texts js-hover-image__texts-container">

          <?php if (have_rows('column')): ?>
            <?php while (have_rows('column')) : the_row(); 
              $object = get_sub_field('object'); 
              $type = get_post_field('type', $object->ID);
              $date = get_post_field('date', $object->ID);
              $object_title = $object->post_title; 
              $object_id = $object->ID;
            ?>   
              <div class="js-hover-image__text" data-id="<?= $object_id ?>">
                <div class="top">
                  <p class="title"> <?= $object_title ?> </p>
                </div>
                <div class="bottom">
                  <p class="type"> <?= $type ?> </p>
                  <p class="date"> <?= $date ?> </p>
                </div>
              </div>
          <?php endwhile; ?>
        <?php endif; ?>

        </div>

      </div>

    <?php endwhile; ?>

    </div>

    <div class="scroll-cta">
    	Scroll
  	</div>

    <div class="back-cta">
      <?= the_field('back_button_text') ?>
		</div>
		
  </section>
<?php endif; ?>