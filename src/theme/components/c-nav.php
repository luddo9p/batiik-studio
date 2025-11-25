<nav class="nav">
  <div class="nav__container">
    <a href="<?= get_home_url(); ?>" class="nav__logo">
      Batiik Studio
    </a>
    <ul class="nav__links">
      <?php
      $current_language = pll_current_language();
      $current_url = home_url($_SERVER['REQUEST_URI']);

      if ($current_language === 'fr') :
        if (have_rows('header_menu_fr', 'option')):
          while (have_rows('header_menu_fr', 'option')) : the_row();
            $link_url = get_sub_field('link');
            $is_current = (rtrim($current_url, '/') === rtrim($link_url, '/'));
            $active_class = $is_current ? ' active' : '';
        ?>
            <li class="nav__link<?= $active_class; ?>">
							<a class="link-hover<?= $active_class; ?>" href="<?= $link_url; ?>" title="<?= the_sub_field('text'); ?>">
									<?= the_sub_field('text'); ?>
							</a>
            </li>
            <?php
          endwhile;
        endif;
      elseif ($current_language === 'en') :
        if (have_rows('header_menu_en', 'option')):
          while (have_rows('header_menu_en', 'option')) : the_row();
            $link_url = get_sub_field('link');
            $is_current = (rtrim($current_url, '/') === rtrim($link_url, '/'));
            $active_class = $is_current ? ' active' : '';
        ?>
            <li class="nav__link<?= $active_class; ?>">
							<a class="link-hover<?= $active_class; ?>" href="<?= $link_url; ?>" title="<?= the_sub_field('text'); ?>">
								<?= the_sub_field('text'); ?>
							</a>
            </li>
            <?php
          endwhile;
        endif;
      endif;
      ?>
      <span class="nav__languages">
        <li><span class="no-barba" data-href="/en"> en </span></li>
        <span>/</span>
        <li><span class="no-barba" data-href="/"> fr </span></li>
      </span>
    </ul>
  </div>
</nav>