<section class="about-right">

  <div class="about-right__gradient"></div>

	<?php $studioDescription = get_field('studio_description_group') ?>
	<?php $image = get_field('image') ?>

  <div class="about-right__section">
    <div class="about-right__top js-to-appear js-to-appear--custom">
      <div class="about-right__top-texts">
				<h3 class="about-right__subtitle js-to-appear js-to-appear--custom"> <?= get_field('studio_title') ?> </h3>
				<div class="about-right__studio-description">
					<?php $studioDescription = get_field('studio_description') ?>
					<div class="about-right__description">
						<?= $studioDescription ?>
					</div>
				</div>
				<img class="about-right__image-mobile" src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>" />
				<div class="js-to-appear js-to-appear--vertical about-right__founder-content">
        	<h3 class="about-right__subtitle">
          	<span> <?= get_field('founder_name') ?> </span>
          	<span class="about-right__profession"> <?= get_field('founder_profession') ?> </span>
        	</h3>
        	<?php $founderDescription = get_field('founder_description') ?>
					<div class="about-right__description about-right__description--founder"> <?= $founderDescription ?> </div>
				</div>
				<div class="js-to-appear js-to-appear--vertical about-right__founder-content">
        	<h3 class="about-right__subtitle">
          	<span> <?= get_field('cofounder_name') ?> </span>
          	<span class="about-right__profession"> <?= get_field('cofounder_profession') ?> </span>
        	</h3>
        	<?php $cofounderDescription = get_field('cofounder_description') ?>
					<div class="about-right__description about-right__description--founder"> <?= $cofounderDescription ?> </div>
				</div>
      </div>
      <img class="about-right__image" src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>" />
    </div>
  </div>

	<h3 class="about-right__subtitle"> <?= get_field('employees_title') ?> </h3>
  <div class="about-right__section about-right__section--multiple js-to-appear js-to-appear--vertical">
    <?php if (have_rows('employees')): ?>
      <?php while (have_rows('employees')) : the_row(); ?>
        <div>
					<?php $image = get_sub_field('image') ?>
      		<img class="about-right__employee-image" src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>" />
          <h3 class="about-right__subtitle">
            <span> <?= the_sub_field('name') ?> </span>
            <span class="about-right__profession"> <?= the_sub_field('profession') ?> </span>
          </h3>
          <p class="about-right__description"> <?= the_sub_field('description') ?> </p>
        </div>
      <?php endwhile ?>
    <?php endif ?>
  </div>

  <div class="about-right__section js-to-appear js-to-appear--vertical">
    <h3 class="about-right__subtitle"> <?= get_field('collaborators_title') ?> </h3>
    <div class="about-right__description"> <?= get_field('collaborators_paragraph') ?> </div>
  </div>

  <div class="about-right__section about-right__section--articles js-to-appear js-to-appear--vertical">
    <div class="left">
      <h3 class="about-right__subtitle"> <?= get_field('press_title') ?> </h3>
      <ul class="about-right__list">
        <?php if (have_rows('press_articles')): ?>
          <?php while (have_rows('press_articles')) : the_row();
          ?>
            <li
              class="about-right__list-item js-images-links"
              data-index="<?= get_row_index(); ?>"
            >
              <a href="<?= the_sub_field('link') ?>" target="_blank">
                <span class="date"> <?= the_sub_field('date') ?> </span>
                <span class="journal"> <?= the_sub_field('journal') ?> </span>
                <div class="number-container">
                  <span class="number"> <?= the_sub_field('number') ?> </span>
                </div>
              </a>
            </li>
          <?php endwhile ?>
        <?php endif ?>
      </ul>
    </div>
    <div class="right about-right__article-images">
      <div class="about-right__article-images-container">
      <?php if (have_rows('press_articles')): ?>
          <?php while (have_rows('press_articles')) : the_row();
          $articleImage = get_sub_field('image');
          ?>
            <img class="js-images-hover" src="<?= $articleImage['url'] ?>" alt="<?= $articleImage['alt'] ?>">
          <?php endwhile ?>
        <?php endif ?>
      </div>
    </div>
  </div>

  <div class="about-right__section about-right__section--various js-to-appear js-to-appear--vertical">
    <?= the_field('various') ?>
  </div>

</section>