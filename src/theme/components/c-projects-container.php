<?php if (have_rows('projects_columns')): ?>
  <section class="projects-container">
    <ul class="projects-container__titles js-horizontal-scroll__outstide js-to-appear js-to-appear--vertical">
      <?php while (have_rows('projects_columns')) : the_row(); ?>  
        <?php if (have_rows('column')): ?>
          <?php while (have_rows('column')) : the_row(); 
            $project = get_sub_field('project');  
            $project_id = $project->ID;
            $project_title = $project->post_title; 
            $project_link = get_permalink($project_id);
          ?>
            <li class="projects-container__titles-item">
              <a class="link-hover" href="<?= $project_link ?>"> <?= $project_title ?> </a>
            </li>
          <?php endwhile; ?>
        <?php endif; ?>
      <?php endwhile; ?>
    </ul>
    <div class="projects-container__wrapper js-horizontal-scroll__wrapper js-hover-image__wrapper">
      
    <?php while (have_rows('projects_columns')) : the_row(); ?>    

      <div class="projects-container__column js-horizontal-scroll__column js-hover-image__column">
        <div class="projects-container__column-images js-horizontal-scroll__column-container">

          <?php if (have_rows('column')): ?>
            <?php while (have_rows('column')) : the_row(); 
              $project = get_sub_field('project');  
              $project_id = $project->ID;
              $project_link = get_permalink($project_id);
            ?>    

            <a class="js-horizontal-scroll__image-container js-hover-image__image-wrapper lazy-wrapper" href="<?= $project_link ?>" data-id="<?= $project_id ?>">
              <!-- <div class="lazy-wrapper"> -->
                <div
                  class="project-container__img js-horizontal-scroll__image js-hover-image__image lazy" 
                  data-src="<?= get_the_post_thumbnail_url( $project_id, 'full' ); ?>" 
                  data-type="bg">
                </div>
              <!-- </div> -->
            </a>

            <?php endwhile; ?>
          <?php endif; ?>

        </div>
        <div class="projects-container__column-texts js-hover-image__texts-container">

          <?php if (have_rows('column')): ?>
            <?php while (have_rows('column')) : the_row(); 
              $project = get_sub_field('project');
              $pre_title = get_post_field('pretitle', $project->ID);
              $type = get_post_field('type', $project->ID);
              $date = get_post_field('date', $project->ID);
              $project_title = $project->post_title;  
              $project_id = $project->ID;
            ?>
              <div class="js-hover-image__text" data-id="<?= $project_id ?>">
                <div class="top">
<!--                   <?php if ($pre_title): ?>
                    <p class="pretitle"> <?= $pre_title ?> </p>
                  <?php endif ?> -->
                  <p class="title"> <?= $project_title ?> </p>
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