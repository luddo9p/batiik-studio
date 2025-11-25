<?php
  $projects = get_posts(array(
    'numberposts'	=> -1,
    'post_type'		=> 'projects',
    'meta_key'		=> 'is_on_homepage',
    'meta_value'  => true,
    'order'       => 'ASC'
  ));
?>

<section class="home-container-mobile">
  <div class="home-container-mobile__wrapper">
    <?php foreach($projects as $project): 
      $projectFields = get_fields($project->ID);
      $project_link = get_permalink($project->ID);
      $homepageImages = $projectFields['homepage_images'];
    ?>
      <div class="home-container-mobile__project">

        <h2 class="home-container-mobile__title"> 
          <span class="type js-to-appear js-to-appear--mobile"> <?= $project->pretitle ?> </span>
          <a class="title" href="<?= $project_link ?>">
            <span class="js-to-appear js-to-appear--mobile"> <?= $project->post_title ?> </span>
          </a>
        </h2>

        <?php foreach($homepageImages as $images): ?>
          <?php foreach($images as $image): 
            $position = $image['position'];
            $format = $image['format'];
            $size = $image['size'];
            $url = $image['image']['url'];
          ?>
            <div class="home-container-mobile__item js-to-appear js-to-appear--mobile lazy <?= $format ?>" data-src="<?= $url ?>" data-type="bg"></div>
          <?php endforeach ?>
        <?php endforeach ?>


      </div>
    <?php endforeach ?>
  </div>
</section>