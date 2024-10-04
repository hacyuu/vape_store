<?php
    include "koneksi.php";

    $id= $_GET['id'];

    $query = mysqli_query($koneksi,"delete from tb_produk where id=$id");
    header('location: dasboard.php');
?>