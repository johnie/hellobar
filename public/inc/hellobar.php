<?php body_class('hellobar__activate'); ?>

<div class="hellobar hellobar--alert">
  <i class="icon ion-speakerphone hellobar-icon"></i>
  <p><?php echo hellobar_get_plugin_option( 'title' ); ?></p>
  <button class="hellobar__close"><i class="icon ion-close"></i><span><?php _e("Close notice", "hellobar"); ?></span></button>
</div>
