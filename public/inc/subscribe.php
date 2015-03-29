<?php
  $mailchimp_url = hellobar_get_plugin_option( 'mailchimp_url' );
  $mailchimp_token = hellobar_get_plugin_option( 'mailchimp_token' );
  $mailchimp_listid = hellobar_get_plugin_option( 'mailchimp_listid' );

  $mailchimp_action = $mailchimp_url . 'post-json?u=' . $mailchimp_token . '&id=' . $mailchimp_listid . '&c=?';
?>

<form action="<?php echo $mailchimp_action; ?>" method="POST" class="hellobar__subscribe" id="hellobar_subscribe">
  <input type="email" autocapitalize="off" autocorrect="off" name="MERGE0" id="MERGE0" size="25" value="" placeholder="namn@gmail.com" class="hellobar__subscribe-input">
  <div style="position: absolute; left: -5000px;"><input type="text" name="b_412ec319f27466c765c25de0d_0d27b3e3c3" tabindex="-1" value=""></div>
  <input type="submit" class="hellobar__subscribe-btn" name="submit" value="<?php _e( 'Prenumerera', 'viapress'); ?>" id="subscribe_submit">
  <div id="subscribe_messages"></div>
</form>
