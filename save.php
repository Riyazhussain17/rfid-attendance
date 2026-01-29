<?php
include "db.php";
$name = $_POST['name'];
$uid = $_POST['uid'];

$check = $conn->query("SELECT * FROM users WHERE uid='$uid'");
if ($check->num_rows > 0) {
  echo "Card already registered";
} else {
  $conn->query("INSERT INTO users (uid,name) VALUES ('$uid','$name')");
  echo "Card registered successfully";
}
?>
