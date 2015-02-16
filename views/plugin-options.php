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
		         <input type="hidden" name="hellobar_plugin_option_activation" value="false" />
		         <input type="checkbox" name="hellobar_plugin_option_activation" <?php echo hellobar_get_plugin_option( 'activation', true ) ? 'checked="checked"' : ''; ?> />
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="hellobar_plugin_option_title"><?php _e('Title', 'viapress'); ?></label></th>
          <td>
            <input name="hellobar_plugin_option_title" value="<?php echo hellobar_get_plugin_option( 'title', '' ); ?>" type="text" id="title" placeholder="Title">
            <p class="description"><?php _e('Short explanation about the notice', 'viapress'); ?></p>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="hellobar_plugin_option_description"><?php _e('Description', 'viapress'); ?></label></th>
          <td>
            <input name="hellobar_plugin_option_description" value="<?php echo hellobar_get_plugin_option( 'description', '' ); ?>" type="text" id="description" placeholder="Description">
            <p class="description"><?php _e('Short description about the notice', 'viapress'); ?></p>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="hellobar_plugin_option_link"><?php _e('Link', 'viapress'); ?></label></th>
          <td>
            <input name="hellobar_plugin_option_link" value="<?php echo hellobar_get_plugin_option( 'link', '' ); ?>" type="text" id="link" placeholder="Link">
            <p class="description"><?php _e('If there\'s a post or link about the notice', 'viapress'); ?></p>
          </td>
        </tr>
      </tbody>
    </table>
  <?php submit_button(); ?>
  </form>
</div>
