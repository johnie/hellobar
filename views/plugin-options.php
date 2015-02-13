<div class="wrap hellobar-settings">

  <h2><?php echo hellobar()->name . ' Settings'; ?></h2>
  <p><?php echo hellobar()->description; ?></p>

  <form id="hellobar_settings" action="" method="post">
    <tbody>
      <tr>
        <th scope="row"><label for="activate">Activate</label></th>
        <td>
          <input name="activate" type="checkbox" id="activate" value="0" checked="">
        </td>
      </tr>
    </tbody>
  </form>

  <?php submit_button(); ?>
</div>
