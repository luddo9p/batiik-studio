<?php
    $post_id = get_the_ID();
    $title = get_the_title();
    $pre_title = get_post_field('pretitle', $post_id);
    $description = get_post_field('description', $post_id);
    $type = get_post_field('type', $post_id);
    $place = get_post_field('place', $post_id);
    $surface = get_post_field('surface', $post_id);
    $budget = get_post_field('budget', $post_id);
    $status = get_post_field('statut', $post_id);
    $photosCredits = get_post_field('credits_photos', $post_id);
    $linkedObjectId = get_post_field('object', $post_id);
    $linkedObjectLink = get_permalink($linkedObjectId);
		$linkedObjectLabel = get_post_field('label_object', $post_id);
    $mailto = get_post_field('acheter', $post_id);


		$customNextPostId = get_post_field('next_project', $post_id);
		if ($customNextPostId) {
			$customNextPost = get_post($customNextPostId);
			$nextPost = $customNextPost;
		} else {
			$nextPost = get_next_post();
			if (!$nextPost) {
				$nextPost = get_posts(array(
					'numberposts'	=> 1,
					'post_type'		=> 'projects',
					'order'       => 'ASC'
				));
				$nextPost = $nextPost[0];
			}
		}

		$nextPostId = $nextPost->ID;
		$nextPostLink = get_permalink($nextPostId);
		$nextPostTitle = $nextPost->post_title;
		$nextPostPretitle = $nextPost->pretitle;
?>
<section class="project-container">
  
  <div class="project-container__infos">
    <div class="project-container__infos-container js-to-appear">
      <h1 class="project-container__title"> 
<!--         <?php if ($pre_title) : ?>
          <span class="type"> <?= $pre_title ?> </span>
        <?php endif; ?> -->
        <span class="title"> <?= $title ?> </span>
      </h1>
      <div class="project-container__description js-to-hide"> 
        <p> <?= $description ?> </p>
      </div>
      <div class="project-container__lists js-to-hide">
        <ul class="project-container__list project-container__list--left">
          <?php if (have_rows('details')): ?>
            <?php while (have_rows('details')) : the_row(); 
              $type = get_sub_field('type');
            ?>
              <li> <?= $type ?> </li>
            <?php endwhile ?>
          <?php endif ?>
        </ul>
        <ul class="project-container__list project-container__list--right">
          <?php if (have_rows('details')): ?>
            <?php while (have_rows('details')) : the_row(); 
              $value = get_sub_field('value');
              $secondValue = get_sub_field('additional_value');
            ?>
              <li> 
                <span> <?= $value ?> </span>
                <span> <?= $secondValue ?> </span>
              </li>
            <?php endwhile ?>
          <?php endif ?>
        </ul>
      </div>
      <?php if($mailto): ?>
          <a href="<?= $mailto; ?>" class="project-container__next-mail" target="_blank" style="font-size:12px;" data-count="<?=count($mailto);?>"> 
            <span class="link-mailto"><?= get_locale() === "fr_FR" ? "acheter" : "buy";  ?></span>
          </a>
        <?php endif; ?>
      <?php if($linkedObjectId): ?>
        <a href="<?= $linkedObjectLink ?>" class="project-container__linked"> 
          <span class="link-hover"> <?= $linkedObjectLabel ?> </span> 
        </a>
      <?php endif ?>
    </div>
  </div>
  
  <?php if (have_rows('project_images')): ?>
    <div class="project-container__wrapper">
      <?php while (have_rows('project_images')) : the_row(); 
        $image = get_sub_field('image');
        $format = get_sub_field('format');
      ?>  

        <div class="project-container__column <?= $format ?>">
          <div class="project-container__image-wrapper lazy-wrapper">
            <div 
              class="project-container__image lazy <?= $format ?>"
              data-src="<?= $image['url']; ?>" 
              data-type="bg">
            </div>
          </div>
        </div>

      <?php endwhile; ?>
      <div class="project-container__next">
        <div class="project-container__next-container">
          <?php if ($nextPost): ?>
            <!-- <span class="type"> <?= $nextPostPretitle ?> </span> -->
            <a class="title" href="<?= $nextPostLink ?>">
              <span> <?= $nextPostTitle ?> </span>
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>

</section>