<?php
  require_once(__DIR__."/../../../../services/controllers/hellobars.php");
  $hellobarController = new hellobars();
  echo $hellobarController->getHtml();
?>
