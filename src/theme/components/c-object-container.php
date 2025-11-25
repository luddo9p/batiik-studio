<?php
    $post_id = get_the_ID();
    $title = get_the_title();
    $selectedTemplateName = get_field('template_selection');
    $linkedProjectId = get_post_field('project', $post_id);
		$linkedProjectLink = get_permalink($linkedProjectId);
		$linkedProjectLabel = get_post_field('label_project', $post_id);
?>
<section class="object-container">
  <div class="object-container__infos">
  <div class="object-container__infos-container js-to-appear">
      <h1 class="object-container__title"> 
        <span class="title "> <?= $title ?> </span>
      </h1>
      <div class="object-container__lists js-to-hide">
        <ul class="object-container__list object-container__list--left">
          <?php if (have_rows('details')): ?>
            <?php while (have_rows('details')) : the_row(); 
              $type = get_sub_field('type');
            ?>
              <li> <?= $type ?> </li>
            <?php endwhile ?>
          <?php endif ?>
        </ul>
        <ul class="object-container__list object-container__list--right">
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
      <?php if($linkedProjectId): ?>
        <a href="<?= $linkedProjectLink ?>" class="object-container__linked js-to-hide"> 
          <span class="link-hover"> <?= $linkedProjectLabel ?> </span>
        </a>
      <?php endif ?>
    </div>
	</div>
	<?php if ($selectedTemplateName === 'gabarit01'):
		if (have_rows('template_01')): 
			while (have_rows('template_01')) : the_row(); 
				$imageTop = get_sub_field('image_top');
				$imageBottom = get_sub_field('image_bottom');
			?>
			<div class="object-container__images object-container__images--template--01">
				<div class="object-container__template object-container__template--01">
					<div class="top">
						<?php if ($imageTop['url']): ?>
							<div class="object-container__lazy-wrapper lazy-wrapper js-to-appear">
								<div 
									class="image js-to-appear lazy" 
									data-src="<?= $imageTop['url']; ?>"
									data-type="bg">
								</div>
							</div>
						<?php endif ?>
					</div>
					<div class="bottom">
						<div class="object-container__lazy-wrapper lazy-wrapper js-to-appear">
							<div 
								class="image js-to-appear lazy" 
								data-src="<?= $imageBottom['url']; ?>"
								data-type="bg">
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php endwhile; ?>
		<?php endif; ?>

    <?php elseif ($selectedTemplateName === 'gabarit02'):
      if (have_rows('template_02')): 
        while (have_rows('template_02')) : the_row(); 
          $imageLeft = get_sub_field('image_left');
          $imageRight = get_sub_field('image_right');
        ?>
				<div class="object-container__images object-container__images--template--02">
          <div class="object-container__template object-container__template--02">
            <div class="left">
              <div class="object-container__lazy-wrapper lazy-wrapper js-to-appear">
                <div 
                  class="image js-to-appear lazy" 
                  data-src="<?= $imageLeft['url']; ?>"
                  data-type="bg">
                </div>
              </div>
            </div>
            <div class="right">
              <div class="object-container__lazy-wrapper lazy-wrapper js-to-appear">
                <div 
                  class="image js-to-appear lazy" 
                  data-src="<?= $imageRight['url']; ?>"
                  data-type="bg">
                </div>
              </div>
            </div>
					</div>
				</div>
        
        <?php endwhile; ?>
      <?php endif; ?>

    <?php elseif ($selectedTemplateName === 'gabarit03'):
      if (have_rows('template_03')): 
        while (have_rows('template_03')) : the_row(); 
          $imageLeft = get_sub_field('image_left');
          $imageRight = get_sub_field('image_right');
        ?>
				<div class="object-container__images object-container__images--template--02">
          <div class="object-container__template object-container__template--03">
            <div class="left">
              <div class="object-container__lazy-wrapper lazy-wrapper js-to-appear">
                <div 
                  class="image js-to-appear lazy" 
                  data-src="<?= $imageLeft['url']; ?>"
                  data-type="bg">
                </div>
              </div>
            </div>
            <div class="right">
              <div class="object-container__lazy-wrapper lazy-wrapper js-to-appear">
                <div 
                  class="image js-to-appear lazy" 
                  data-src="<?= $imageRight['url']; ?>"
                  data-type="bg">
                </div>
              </div>
            </div>
          </div>
				</div>
        <?php endwhile; ?>
      <?php endif; ?>

    <?php endif; ?>

  </div>
</section>