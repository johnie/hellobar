<?php
  $activate_hellobar = hellobar_get_plugin_option( 'activation' );

  $hellobar_args = array(
    'post_type' => 'hellobar',
    'post_status' => 'publish',
    'post_per_page' => 1
  );

  $hellobars = new WP_Query($hellobar_args);

  while ($hellobars->have_posts()) : $hellobars->the_post();
?>

  <div class="hellobar hellobar--alert <?php echo $activate_hellobar == 'on' ? 'hellobar__active' : ''; ?>">
    <i class="icon ion-speakerphone hellobar-icon"></i>
    <p class="hellobar__title"><?php the_title(); ?> </p>
    <p class="hellobar__description">
      <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
      <?php if ( get_post_meta( get_the_ID(), '_hellobar_type_link', true ) != "" ): ?>
        <a class="hellobar__link" href="<?php echo get_post_meta( get_the_ID(), '_hellobar_type_link', true ); ?>"><?php _e("Read more", "hellobar"); ?></a>
      <?php else: ?>
        <a class="hellobar__link" href="<?php the_permalink(); ?>"><?php _e("Read more", "hellobar"); ?></a>
      <?php endif; ?>
    </p>
    <button class="hellobar__close"><i class="icon ion-close"></i><span><?php _e("Close notice", "hellobar"); ?></span></button>
  </div>

<?php endwhile; ?>
