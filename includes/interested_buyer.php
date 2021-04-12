<?php
require_once 'functions.php';

if (isset($_POST['buyer_reg_no'])) {
  $buyer_reg_no = $_POST['buyer_reg_no'];
  $ads_id = $_POST['ads_id'];

  queryMysql("INSERT INTO `interested_buyers`(`buyer_id`, `product_id`) VALUES ('$buyer_reg_no','$ads_id')");
}


?>