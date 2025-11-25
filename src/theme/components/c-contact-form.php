<?php $form = get_field('form'); ?>
<section class="contact-form">
	<div class="contact-form__gradient"></div>
  <div class="contact-form__container">
    <h2 class="contact-form__title js-to-appear js-to-appear--vertical"> <?= the_field('form_title') ?> </h2>
    <p class="contact-form__desc js-to-appear js-to-appear--vertical"> <?= the_field('form_description') ?> </p>
    <div class="contact-form__form js-to-appear js-to-appear--vertical">
      <?= the_field('form') ?>
    </div>
		<div class="contact-form__recaptcha-infos js-to-appear js-to-appear--vertical">
			This site is protected by reCAPTCHA and the Google
			<a href="https://policies.google.com/privacy" target="_blank" rel="noreferrer">Privacy Policy</a> and
			<a href="https://policies.google.com/terms" target="_blank" rel="noreferrer">Terms of Service</a> apply.
		</div>
  </div>
</section>