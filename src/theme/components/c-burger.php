<section class="burger">
  <div class="burger__trigger">
      <div class="burger__trigger-lines"></div>
  </div>
  <div class="burger__menu">
    <a href="<?= get_home_url(); ?>" class="burger__logo">
      Batiik Studio
    </a>
    <ul class="burger__links">
      <?php
        $current_language = pll_current_language();
        if ($current_language === 'fr') :
          if (have_rows('header_menu_fr', 'option')):
            while (have_rows('header_menu_fr', 'option')) : the_row();
          ?>
              <li class="burger__link">
                <a href="<?= the_sub_field('link'); ?>" title="<?= the_sub_field('text'); ?>"><?= the_sub_field('text'); ?></a>
              </li>
              <?php
            endwhile;
          endif;
        elseif ($current_language === 'en') :
          if (have_rows('header_menu_en', 'option')):
            while (have_rows('header_menu_en', 'option')) : the_row();
          ?>
              <li class="burger__link">
                <a href="<?= the_sub_field('link'); ?>" title="<?= the_sub_field('text'); ?>"><?= the_sub_field('text'); ?></a>
              </li>
              <?php
            endwhile;
          endif;
        endif;
      ?>
      <span class="burger__languages">
        <li><span class="no-barba" data-href="/en"> en </span></li>
        <span>/</span>
        <li><span class="no-barba" data-href="/"> fr </span></li>
      </span>
    </ul>
  </div>
</section>