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
    $next_post = get_next_post();
    if (!$next_post) {
      $next_post = get_posts(array(
        'numberposts'	=> 1,
        'post_type'		=> 'projects',
        'order'       => 'ASC'
      ));
      $next_post = $next_post[0];
    }
    $next_post_id = $next_post->ID;
    $next_post_link = get_permalink($next_post_id);
    $next_post_title = $next_post->post_title;
    $next_post_pretitle = $next_post->pretitle;
    $mailto = get_post_field('acheter', $post_id);
?>

<section class="project-container-mobile">
  <div class="project-container-mobile__wrapper">
    
    <div class="project-container-mobile__infos">
      <div class="project-container-mobile__infos-container js-to-appear js-to-appear--mobile">
        <h1 class="project-container-mobile__title"> 
  <!--         <?php if ($pre_title) : ?>
            <span class="type"> <?= $pre_title ?> </span>
          <?php endif; ?> -->
          <span class="title"> <?= $title ?> </span>
        </h1>
				<?php if ($description) : ?>
					<div class="project-container-mobile__description js-to-hide"> 
						<p> <?= $description ?> </p>
					</div>
				<?php endif; ?>
        <div class="project-container-mobile__lists js-to-hide">
          <ul class="project-container-mobile__list project-container-mobile__list--left">
            <?php if (have_rows('details')): ?>
              <?php while (have_rows('details')) : the_row(); 
                $type = get_sub_field('type');
              ?>
                <li> <?= $type ?> </li>
              <?php endwhile ?>
            <?php endif ?>
          </ul>
          <ul class="project-container-mobile__list project-container-mobile__list--right">
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
          <a href="<?= $mailto; ?>" target="_blank" class="project-container__next-mail" style="font-size:12px;" data-count="<?=count($mailto);?>"> 
            <span class="link-mailto"><?= get_locale() === "fr_FR" ? "acheter" : "buy";  ?></span>
          </a>
        <?php endif; ?>
        <?php if($linkedObjectId): ?>
          <a href="<?= $linkedObjectLink ?>" class="project-container-mobile__linked"> 
            <span class="link-hover"> <?= $linkedObjectLabel ?> </span> 
          </a>
        <?php endif ?>
      </div>
    </div>

    <?php if (have_rows('project_images')): ?>
      <?php while (have_rows('project_images')) : the_row(); 
        $image = get_sub_field('image');
      ?>  
        <div class="project-container-mobile__images">
          <!-- <div 
            class="project-container-mobile__image lazy js-to-appear js-to-appear--mobile"
            data-src="<?= $image['url']; ?>" 
            data-type="bg">
          </div> -->
          <img 
            class="project-container-mobile__image lazy js-to-appear js-to-appear--mobile"
            data-src="<?= $image['url']; ?>" 
            data-type="img" 
          />
        </div>
      <?php endwhile; ?>
      <div class="project-container-mobile__next">
        <div class="project-container-mobile__next-container js-to-appear js-to-appear--mobile">
          <?php if ($next_post): ?>
            <!-- <span class="type"> <?= $next_post_pretitle ?> </span> -->
            <a class="title" href="<?= $next_post_link ?>">
              <span> <?= $next_post_title ?> </span>
            </a>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>

  </div>
</section>