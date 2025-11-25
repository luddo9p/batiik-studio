<section class="contact-left">

  <h1 class="contact-left__title"> <?= the_field('title'); ?> </h1>
  <div class="contact-left__infos">
    <div class="contact-left__infos-line">
      <?php $address = get_field('address'); ?>
      <p class="label"> <?= $address['label'] ?> </p>
      <div class="value">
        <p> <?= $address['street'] ?> </p>
        <p> <?= $address['city'] ?> </p>
      </div>
    </div>
    <div class="contact-left__infos-line">
      <?php $socials = get_field('socials'); ?>
      <p class="label"> <?= $socials['label'] ?> </p>
      <div class="value">
      <?php
        if( have_rows('socials') ): while ( have_rows('socials') ) : the_row(); 
          if( have_rows('list') ): while ( have_rows('list') ) : the_row(); 
      ?>  
          <a href="<?= get_sub_field('link') ?>" target="_blank"> <?= get_sub_field('name') ?> </a>
      <?php 
          endwhile; endif;
        endwhile; endif;
      ?>
      </div>
    </div>
  </div>
  <div class="contact-left__email">
    <?php $email = get_field('email_group'); ?>
    <div class="text"> <?= $email['text'] ?> </div>
    <a href="mailto:<?= $email['email'] ?>" class="email"> <?= $email['email'] ?> </a>
  </div>

</section>