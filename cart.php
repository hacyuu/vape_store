<?php
include "koneksi.php";
session_start();

$total = 0;

$id_user = $_SESSION['id_user'];

if(isset($id_user)) {

    if (isset($_POST['add'])){
        if (isset($id_user)){
            
            
            if(isset($_SESSION['cart'])){
                
                $item_array_id = array_column($_SESSION['cart'], 'id');
            if(!in_array($_GET["id"], $item_array_id)){
                $count = count($_SESSION['cart']);
                $item_array = array(
                    'id' => $_GET['id'],
                    'nama' => $_POST['nama'],
                    'harga' => $_POST['harga'],
                    'foto' => $_POST['foto'],
                    'jumlah' => $_POST['jumlah']
        );
        
        $_SESSION['cart'] [$count] = $item_array;
        echo "<script>
        alert('berhasil dimasukan ke keranajang');
        </script>";
    }else {
        echo"<script> 
        alert('sudah ada di keranjang');
        </script>";
    }
}else {
    $item_array = array(
        'id' => $_GET['id'],
        'nama' => $_POST['nama'],
        'harga' => $_POST['harga'],
        'foto' => $_POST['foto'],
        'jumlah' => $_POST['jumlah']
    );
    
    $_SESSION['cart'] [0] = $item_array;
    echo "<script>
    alert('berhasil dimasukan kekeranjang');
    </script>";
    }
}
}
if(isset($_GET['aksi'])){
    if($_GET['aksi'] == 'hapus'){
        foreach($_SESSION['cart'] as $key => $value){
            if($value['id'] == $_GET['id']){
                unset($_SESSION['cart'] [$key]);
                echo"<script>alert('produk di hapus dari keranjang');</script>";
                echo"<script>windows.location = 'cart.php';</script>";
                
            }
        }   
    } else if ($_GET['aksi'] == 'beli') { 
        foreach($_SESSION['cart'] as $key => $value){
            $total = $total + ($value["jumlah"] * $value['harga']);
        } 
        
        $query = mysqli_query ($koneksi, "INSERT INTO tb_transaksi(tanggal,id_pelanggan,total) VALUES ('". date("Y-m-d") . "','$id_user','$total') ");
        $id_transaksi = mysqli_insert_id($koneksi);
        
        foreach($_SESSION['cart'] as $value){
            $id_produk = $value['id'];
            $jumlah = $value['jumlah'];
            $sql = "INSERT INTO tb_detail(id_transaksi,id_produk,jumlah) VALUES ('$id_transaksi','$id_produk','$jumlah')";
            $res = mysqli_query($koneksi, $sql);
            
            if ($res > 0) {
                unset($_SESSION['cart']);
                
                echo "<script>
                alert('terimakasih sudah berbelanja');
                </script>";
                
                echo "<script>
                window.location = 'cetak.php?id=". $id_transaksi."';
                </script>";
            }
        }
    }        
}
} else {
    echo "<script>
    alert('login woyyyy');
    </script>";
    
    echo "<script>
    document.location.href = 'login.php';
    </script>";
}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Keranjang Belanja</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Header -->
    <header class="bg-gray-900 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold text-puple-700">Vape <span>Store</span></h1>
            <nav>
                <a href="index.php" class="text-white hover:text-gray-300 hover:border-b-2 border-grey-300 mx-2">Home</a>
                <a href="#" class="text-white hover:text-gray-300 hover:border-b-2 border-grey-300 mx-2">Products</a>
                <a href="#" class="text-white hover:text-gray-300 hover:border-b-2 border-grey-300 mx-2">Contact</a>
            </nav>
        </div>
    </header>

  
    <!-- Main Content -->
    <main class="container mx-auto my-8 p-4 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Keranjang Belanja</h2>
        <div class="space-y-4">
        <?php
            if (!empty($_SESSION['cart'])) {
                foreach($_SESSION['cart'] as $value) { ?>
            <div class="min-w-full bg-slate-50 flex items-center gap-4 p-4 justify-between">
                <div class="flex items-center gap-4">
                    <img src="./images/<?php echo $value['foto'] ?>" alt="" class="w-32">
                    <div class="flex flex-col gap-1">
                        <h1 class="font-bold text-xl"><?php echo $value['nama'] ?></h1>
                        <p>jumlah beli : <span> <?php echo $value['jumlah'] ?> </span></p>
                        <p class="text-lg font-bold text-yellow-500"><?php echo number_format( $value['harga'] * $value['jumlah']) ?></p>
                    </div>
                </div>
                <form action="" method="POST">

                    <a name="hapus" href="cart.php?aksi=hapus&id=<?php echo $value['id'] ?>" class="text-slate-900 font-bold text-lg hover:bg-red-500 hover:text-slate-50 px-3 py-2 rounded-xl">Hapus</a>
                </form>
            </div>
            <?php 
            
        } 
            ?>
            <?php } ?>
            
        </div>
        <!-- Total -->
        <div class="flex justify-between font-bold border-t pt-4 mt-4">
        <?php 
             foreach($_SESSION['cart'] as $value){
             $total = $total + ($value['harga'] * $value['jumlah']);
            } ?>
            <span>Total <?php echo number_format($total) ?></span>
        </div>
        <!-- Checkout Button -->
        <div class="mt-8">

<form action="" method="POST">

         <a href="cart.php?aksi=beli" class="bg-gray-900 text-white py-2 px-4 rounded-lg hover:bg-gray-800 transition inline-block">Proceed to Checkout</a>
        <a href="index.php" class="outline outline-offset-2 outline-2 px-4 py-2 rounded-lg ">kembali </a>    
</form>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white p-4 mt-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Vape Store. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>