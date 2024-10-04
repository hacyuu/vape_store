<?php
include('koneksi.php');

$id = $_GET['id'];

$query =  "SELECT * FROM tb_produk where id=$id"; 
$hasil = mysqli_query ($koneksi, $query);

// $tampilan = mysqli_query ($koneksi, "SELECT * FROM tb_produk where id='$id'");
//     if (mysqli_num_rows($tampilan) > 0) {
//         while ($data = mysqli_fetch_array($tampilan)){
//             $nama = $data ['nama'];
//             $harga = $data ['harga'];
//             $poto = $data ['poto'];
//             $deskripsi = $data ['deskripsi'];
//         }
//     }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Header -->
    <header class="bg-gray-900 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-3xl font-bold font-[poppins] text-slate-500">Vape <span class="text-white">Store</span></h1>
            <nav>
                <a href="index.php" class="text-white hover:text-gray-300 hover:border-b-1 border-gray-300 mx-2 ">Home</a>
                <a href="#" class="text-white hover:text-gray-300 mx-2">Products</a>
                <a href="#" class="text-white hover:text-gray-300 mx-2">Contact</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto my-8 p-4 bg-white shadow-lg rounded-lg">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full min-h-96 justify-center items-center ">
            <?php
             include('koneksi.php');
             
             $id = $_GET['id'];
             
             $query =  "SELECT * FROM tb_produk where id=$id"; 
             $hasil = mysqli_query ($koneksi, $query);
             
             while($h = mysqli_fetch_array($hasil)) {
                 
                 ?>
                <!-- Gambar Barang -->
            <div>
                <img src="images/<?php echo $h['poto'] ?>" alt="Nama Barang" class="w-56 h-56 rounded-lg">
            </div>
            <!-- Detail Barang -->
            <div>
                <form action="cart.php?id=<?= $h['id'] ?>" method="post">
                <h2 class="text-3xl font-semibold mb-4"><?php echo $h['nama'] ?></h2>
                <p class="text-gray-700 mb-4"><?php echo $h['deskripsi'] ?></p>
                <p class="text-lg font-bold mb-4">harga: Rp <?php echo $h['harga'] ?></p>
               
                
                <input type="number" class="border border-slate-900 w-44 h-13 px-2 py-1 rounded-full text-slate-900 font-bold text-xl mb-4" name="jumlah" value="1">
                <input type="hidden" name="nama" value="<?php echo $h['nama']  ?>">
                <input type="hidden" name="harga" value="<?php echo $h['harga']  ?>">
                <input type="hidden" name="foto" value="<?php echo $h['poto'] ?>">
                <div class="flex space-x-4">
                        <input type="submit" name="add" value="Add to Cart" class="bg-gray-800 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition"/>
                    </div>
                </form>
            </div> 

             
             <?php } ?>
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
