<div class="hellobar hellobar--alert">
  <i class="icon ion-speakerphone hellobar-icon"></i>
  <p class="hellobar__title"><?php echo hellobar_get_plugin_option( 'title' ); ?></p>
  <p class="hellobar__description">
    <?php echo hellobar_get_plugin_option( 'description' ) . ' …'; ?>
    <?php if ( hellobar_get_plugin_option( 'link' ) ): ?>
      <a class="hellobar__link" href="<?php echo hellobar_get_plugin_option( 'link' ); ?>"><?php _e("Read more", "hellobar"); ?></a>
    <?php endif; ?>
  </p>
  <button class="hellobar__close"><i class="icon ion-close"></i><span><?php _e("Close notice", "hellobar"); ?></span></button>
</div>
