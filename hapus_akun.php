<?php
    include "koneksi.php";

    $id= $_GET['id'];

    $query = mysqli_query($koneksi,"delete from tb_user where id=$id");
    header('location: customer2.php');
?>