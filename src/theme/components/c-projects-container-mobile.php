<?php 
	// $current_language = pll_current_language();
	// $page = get_page_by_path('/projets');
	// $pageId = $page->ID;
	// if ($current_language === 'en') {
	// 	$page = get_page_by_path('/projects');
	// 	$pageId = $page->ID;
	// }
?>
<section class="projects-objects-mobile">
  <div class="projects-objects-mobile__wrapper">

  <?php if (have_rows('projects_columns')): ?>
    <?php while (have_rows('projects_columns')) : the_row(); ?>    

      <?php if (have_rows('column')): ?>
        <?php while (have_rows('column')) : the_row(); 
          $project = get_sub_field('project');  
          // print_r($project);
          $pre_title = get_post_field('pretitle', $project->ID);
          $type = get_post_field('type', $project->ID);
          $project_title = $project->post_title;  
          $project_id = $project->ID;
          $project_link = get_permalink($project_id);
        ?>    
          <a class="projects-objects-mobile__project" href="<?= $project_link ?>">
            <!-- <div 
              class="projects-objects-mobile__img lazy js-to-appear js-to-appear--mobile" 
              data-src="<?= get_the_post_thumbnail_url( $project_id, 'full' ); ?>" 
              data-type="bg">
            </div> -->
            <img 
              class="projects-objects-mobile__img lazy js-to-appear js-to-appear--mobile" 
              data-src="<?= get_the_post_thumbnail_url( $project_id, 'full' ); ?>" 
              data-type="img"
              alt="Batiik Studio Project" 
            />
            <h3 class="projects-objects-mobile__title js-to-appear js-to-appear--mobile">
  <!--             <?php if ($pre_title): ?>
                <p class="pretitle"> <?= $pre_title ?> </p>
              <?php endif ?> -->
              <p class="title"> <?= $project_title ?> </p>
            </h3>
          </a>
        <?php endwhile; ?>
      <?php endif; ?>

    <?php endwhile; ?>
  <?php endif; ?>

  </div>
</section>