<section class="about-left">

<?php $current_language = pll_current_language(); ?>
<?php $title = get_field('title', 'options') ?>
<?php $titleEn = get_field('title_en', 'options') ?>
  <?php if ($current_language === 'fr') : ?>
    <h1 class="about-left__title js-to-appear js-to-appear--vertical"> <?= $title ?> </h1>
  <?php else : ?>
    <h1 class="about-left__title js-to-appear js-to-appear--vertical"> <?= $titleEn ?> </h1>
  <?php endif; ?>
  <div class="about-left__infos js-to-appear js-to-appear--custom">
    <div class="about-left__infos-line">
      <?php $address = get_field('address', 'options'); ?>
      <?php if ($current_language === 'fr') : ?>
        <p class="label"> <?= $address['label'] ?> </p>
      <?php else : ?>
        <p class="label"> <?= $address['label_en'] ?> </p>
      <?php endif; ?>
      <div class="value">
        <p> <?= $address['street'] ?> </p>
        <p> <?= $address['city'] ?> </p>
      </div>
    </div>
    <div class="about-left__infos-line">
      <?php $socials = get_field('socials', 'options'); ?>
      <?php if ($current_language === 'fr') : ?>
        <p class="label"> <?= $socials['label'] ?> </p>
      <?php else : ?>
        <p class="label"> <?= $socials['label_en'] ?> </p>
      <?php endif; ?>
      <div class="value">
      <?php
        if( have_rows('socials', 'options') ): while ( have_rows('socials', 'options') ) : the_row(); 
          if( have_rows('list') ): while ( have_rows('list') ) : the_row(); 
      ?>  
          <a href="<?= get_sub_field('link') ?>" target="_blank" class="link-hover"> 
            <span> <?= get_sub_field('name') ?> </span>
          </a>
      <?php 
          endwhile; endif;
        endwhile; endif;
      ?>
      </div>
    </div>
  </div>
  <div class="about-left__email js-to-appear js-to-appear--custom">
    <?php $email = get_field('email_group', 'options'); ?>
    <?php if ($current_language === 'fr') : ?>
      <div class="text"> <?= $email['text'] ?> </div>
    <?php else : ?>
      <div class="text"> <?= $email['text_en'] ?> </div>
    <?php endif; ?>
    <!-- <a href="mailto:<?= $email['email'] ?>" class="email link-hover"> 
      <span> <?= $email['email'] ?> </span>
    </a> -->
  </div>

</section>