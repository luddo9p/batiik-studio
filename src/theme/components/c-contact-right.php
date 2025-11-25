<section class="contact-right">

  <div class="contact-right__section">
    <h3 class="contact-right__subtitle"> <?= get_field('studio_title') ?> </h3>
    <p class="contact-right__description"> <?= get_field('studio_description') ?> </p>
  </div>

  <div class="contact-right__section">
    <div>
      <h3 class="contact-right__subtitle"> 
        <?= get_field('founder_name') ?> 
        <span class="contact-right__profession"> <?= get_field('founder_profession') ?> </span>
      </h3>
      <div class="contact-right__description contact-right__description--double">
        <?php $founderDescription = get_field('founder_description_group') ?>
        <div> <?= $founderDescription['paragraph_one'] ?> </div>
        <div> <?= $founderDescription['paragraph_two'] ?> </div>
      </div>
    </div>
  </div>

  <?php $image = get_field('image') ?>
  <img class="contact-right__image" src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>" />

  <div class="contact-right__section contact-right__section--multiple">
    <?php if (have_rows('employees')): ?>
      <?php while (have_rows('employees')) : the_row(); ?>
        <div>
          <h3 class="contact-right__subtitle"> 
            <?= the_sub_field('name') ?> 
            <span class="contact-right__profession"> <?= the_sub_field('profession') ?> </span>
          </h3>
          <p class="contact-right__description"> <?= the_sub_field('description') ?> </p>
        </div>
      <?php endwhile ?>
    <?php endif ?>
  </div>

  <div class="contact-right__section">
    <h3 class="contact-right__subtitle"> <?= get_field('collaborators_title') ?> </h3>
    <div class="contact-right__description"> <?= get_field('collaborators_paragraph') ?> </div>
  </div>

  <div class="contact-right__section">
    <h3 class="contact-right__subtitle"> <?= get_field('press_title') ?> </h3>
    <ul class="contact-right__list">
      <?php if (have_rows('press_articles')): ?>
        <?php while (have_rows('press_articles')) : the_row(); 
        ?>
          <li class="contact-right__list-item">
            <a href="<?= the_sub_field('link') ?>">
              <span class="date"> <?= the_sub_field('date') ?> </span>
              <span class="journal"> <?= the_sub_field('journal') ?> </span>
              <span class="number"> <?= the_sub_field('number') ?> </span>
            </a>
          </li>
        <?php endwhile ?>
      <?php endif ?>
    </ul>
  </div>

</section>