<div class="wrap hellobar-settings">

  <h2><?php echo hellobar()->name . ' Settings'; ?></h2>
  <p><?php echo hellobar()->description; ?></p>

  <form id="hellobar_settings" action="" method="post">
    <?php
      // Save plugin options on post.
      if ( hellobar_is_method( 'post' ) ) {
        _hellobar_save_plugin_options();
      }
    ?>
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row"><label for="hellobar_plugin_option_activation"><?php _e('Activate', 'viapress'); ?></label></th>
          <td>
            <input type="hidden" name="hellobar_plugin_option_activation" value="off" />
            <input type="checkbox" name="hellobar_plugin_option_activation" <?php echo hellobar_get_plugin_option( 'activation', "on" ) === "on" ? 'checked' : ''; ?> />
          </td>
        </tr>
      </tbody>
    </table>
    <h3>Mailchimp setup</h3>
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row"><label for="hellobar_plugin_option_mailchimp_url"><?php _e('API URL', 'viapress'); ?></label></th>
          <td>
            <input type="text" name="hellobar_plugin_option_mailchimp_url" id="hellobar_plugin_option_mailchimp_url" value="<?php echo hellobar_get_plugin_option( 'mailchimp_url', '' ); ?>" placeholder="http://viaplay.us10.list-manage2.com/subscribe/">
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="hellobar_plugin_option_mailchimp_token"><?php _e('API Token', 'viapress'); ?></label></th>
          <td>
            <input type="text" name="hellobar_plugin_option_mailchimp_token" id="hellobar_plugin_option_mailchimp_token" value="<?php echo hellobar_get_plugin_option( 'mailchimp_token', '' ); ?>" placeholder="412ec319f27466c765c25de0d">
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="hellobar_plugin_option_mailchimp_listid"><?php _e('List ID', 'viapress'); ?></label></th>
          <td>
            <input type="text" name="hellobar_plugin_option_mailchimp_listid" id="hellobar_plugin_option_mailchimp_listid" value="<?php echo hellobar_get_plugin_option( 'mailchimp_listid', '' ); ?>" placeholder="0d27b3e3c3">
          </td>
        </tr>
      </tbody>
    </table>
  <?php submit_button(); ?>
  </form>
</div>
