<div class="wrap hellobar-settings">

  <h2><?php echo hellobar()->name . ' Settings'; ?></h2>
  <p><?php echo hellobar()->description; ?></p>

  <form id="hellobar_settings" action="" method="post">
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row"><label for="activate"><?php _e('Activate', 'viapress'); ?></label></th>
          <td>
            <input name="activate" type="checkbox" id="activate" value="0">
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="title"><?php _e('Title', 'viapress'); ?></label></th>
          <td>
            <input name="title" type="text" id="title" placeholder="Title">
            <p class="description"><?php _e('Short explanation about the notice', 'viapress'); ?></p>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="description"><?php _e('Description', 'viapress'); ?></label></th>
          <td>
            <input name="description" type="text" id="description" placeholder="Description">
            <p class="description"><?php _e('Short description about the notice', 'viapress'); ?></p>
          </td>
        </tr>
        <tr>
          <th scope="row"><label for="link"><?php _e('Link', 'viapress'); ?></label></th>
          <td>
            <input name="link" type="text" id="link" placeholder="Link">
            <p class="description"><?php _e('If there\'s a post or link about the notice', 'viapress'); ?></p>
          </td>
        </tr>
      </tbody>
    </table>
  </form>

  <?php submit_button(); ?>
</div>
