<?php
include_once "./config.php";
if (isset($_POST) == false) {

  header('Location: ./home.php');

}



  $sql = "UPDATE usuarios SET comment='" . $_POST["msg"] . "' WHERE id=" . $_POST["husuario"];



mysqli_query($link, $sql);


if ($_POST["redir"] != 'user_edit.php') {
  $_SESSION["message"] = "Saved!";
  header('Location: ./' . $_POST["redir"] . '?id=' . $_POST["hevent"]);
} else {
  $_SESSION["success"] = "Saved!";
  header('Location: ./' . $_POST["redir"] . '?id=' . $_POST["id"]);
}


?>