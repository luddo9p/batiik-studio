<?php
  $projects = get_posts(array(
    'numberposts'	=> -1,
    'post_type'		=> 'projects',
    'meta_key'		=> 'is_on_homepage',
    'meta_value'  => true,
    'order'       => 'ASC'
  ));
?>
<section class="home-container">

  <div class="home-container__wrapper">

    <?php foreach($projects as $project): 
      $projectFields = get_fields($project->ID);
      $project_link = get_permalink($project->ID);
      $homepageImages = $projectFields['homepage_images'];
    ?>
      <div class="home-container__project home-container__mains">
        <div class="home-container__text">
          <div class="home-container__text-container">
            <div class="type">
              <span> <?= $project->pretitle ?> </span>
            </div>
            <a class="title" href="<?= $project_link ?>">
              <span> <?= $project->post_title ?> </span>
            </a>
          </div>
        </div>
        <?php foreach($homepageImages as $images): ?>
          <?php foreach($images as $image): 
            $position = $image['position'];
            $format = $image['format'];
            $size = $image['size'];
						$url = $image['image']['url'];
						$id = $image['image']['ID'];
          ?>
            <div class="home-container__column <?= $position ?>">
							<a class="home-container__image-wrapper lazy-wrapper <?= $format ?> <?= $size ?>" href="<?= $project_link ?>">
								<div class="home-container__item-zoom">
									<div class="home-container__item lazy" data-src="<?= $url ?>" data-type="bg" data-id="<?= $id ?>"></div>
								</div>
              </a>
            </div>
          <?php endforeach ?>
        <?php endforeach ?>
      </div>  
    <?php endforeach ?>

    <div class="home-container__text home-container__text--allprojects home-container__mains">
			<?php $current_language = pll_current_language();
        if ($current_language === 'fr') : ?>
      		<div class="home-container__text-container">
        		<div class="type">
          		<span>Tous les</span>
        		</div>
        		<a class="title" href="/projets">
          		<span> Projets </span>
        		</a>
					</div>
				<?php else: ?>
					<div class="home-container__text-container">
        		<div class="type">
          		<span> All </span>
        		</div>
        		<a class="title" href="/projets">
          		<span> Projects </span>
        		</a>
					</div>
					<?php endif; ?>
		</div>
				

  </div>

  <div class="scroll-cta">
    Scroll
  </div>

</section>