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
  <?php submit_button(); ?>
  </form>
</div>
