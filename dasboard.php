<?php
include 'koneksi.php';

session_start();
if(!isset($_SESSION['admin'])){
    header('location: login.php');
}

if (isset($_POST['simpan'])) {
  $nama_barang = $_POST['nama_barang'];
  $harga_barang = $_POST['harga_barang'];
  $stok_barang = $_POST['stok_barang'];
  $poto = $_FILES['poto']['name'];
  $file_tmp = $_FILES ['poto']['tmp_name'];
  move_uploaded_file($file_tmp, 'images/'.$poto);
  $jenis= $_POST['jenis'];
  $deskripsi_barang =$_POST['deskripsi_barang'];
  
  $submit = mysqli_query($koneksi, "INSERT INTO tb_produk (nama,harga,stok,poto,jenis,deskripsi) values('$nama_barang', '$harga_barang', '$stok_barang' , '$poto', '$jenis' , '$deskripsi_barang')"); 
  
  if($submit) {

    header("location: dasboard.php");

  }
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="dasboard.css">
</head>
<body class="h-screen min-w-screen">
    <div class="flex flex-row max-h-screen min-w-screen gap-2" >

        <nav class="">
            
        <div class="sidebar h-screen max-w-full w-full lg:left-0 p-2  bg-gray-900">
            <div class="text-gray-100 text-xl">
                <div class="p-2.5 mt-1 flex items-center">
                    <i class="bi bi-app-indicator"></i>
                    <h1 class="font-bold text-gray-200 text-3xl ml-3">vapestore</h1>
                    <i class="bi bi-x"></i>
                </div>
                <hr class="my-2 text-gray-600">
            </div>
            
            <div class="p-2.5 mt-3 flex items-center rounded-md duration-300
            cursor-pointer bg-gray-700 text-white">
            <i class="bi bi-search text-sm" ></i>
            <input type="text" class="text-[15px] ml-4 w-full
            bg-transparent focus:outlane-none">
        </div>
        
        <hr class="my-2 text-gray-600">
        <div class="text-3xl font-bold p-2.5 text-gray-200" >
            <h1>kategori</h1>
        </div>
        <hr class="my-2 text-gray-600">
        <div class = "flex flex-col text-gray-200 font-[poppins] text-2xl ">
            
            <a class=" border-s-indigo-100 py-2 block border-l pl-4 -ml-px border-transparent hover:border-slate-400 dark:hover:border-slate-500 text-slate-300 hover:text-slate-500 dark:text-slate-400 dark:hover:text-slate-300 "href="index.php">produk</a>
            <a class=" border-s-indigo-100  py-2 block border-l pl-4 -ml-px border-transparent hover:border-slate-400 dark:hover:border-slate-500 text-slate-300 hover:text-slate-500 dark:text-slate-400 dark:hover:text-slate-300" href="customer2.php">customer</a>
            <a class=" border-s-indigo-100  py-2 block border-l pl-4 -ml-px border-transparent hover:border-slate-400 dark:hover:border-slate-500 text-slate-300 hover:text-slate-500 dark:text-slate-400 dark:hover:text-slate-300" href="login.php">login</a>
        </div>

        
    </nav>

    <section class=" flex flex-col overflow-y-scroll justify-start w-screen"> 
        <div class="">

          <form class="border-2 p-4 border-black edit" action="" method="POST" enctype="multipart/form-data">
            
            <legend>data</legend>
            <div class="mb-3">
              <label for="disabledTextInput" class="form-label">nama barang</label>
              <input type="text" name="nama_barang" id="disabledTextInput" value="<?= @$nama ?>" class="form-control" placeholder="nama barang" require>
            </div>
            <div class="mb-3">
              <label for="disabledTextInput" class="form-label">harga barang</label>
              <input type="text" name="harga_barang" id="disabledTextInput" class="form-control" value="<?= @$harga ?>" placeholder="harga barang" require>
            </div>
            <div class="mb-3">
              <label for="disabledTextInput" class="form-label">stok barang</label>
              <input type="text" name="stok_barang" id="disabledTextInput" class="form-control" value="<?= @$stok ?>" placeholder="stok barang" require>
            </div>
            <div class="mb-3">
              <label for="disabledSelect" class="form-label">jenis barang</label>
              <select name="jenis" value="<?= @$jenis ?>"id="disabledSelect"class="form-select">
                <option>liquuid</option>
                <option>pod</option>
                <option>mod</option>
              </select>
              <div class="mb-3">
                <label for="disabledTextInput" class="form-label">deskripsi barang</label>
                <input type="text" name="deskripsi_barang" id="disabledTextInput" value="<?= @$deskripsi ?>" class="form-control" placeholder="deskripsi barang" require>
              </div>
            </div>
            <div class="input-group mb-3">
  <input type="file" class="form-control" value="<?=@$foto?>" name="poto" id="inputGroupFile02">
</div>


       <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="disabledFieldsetCheck" disabled>
                <label class="form-check-label" for="disabledFieldsetCheck" >
                  Can't check this
                </label>
              </div>     
            </div>
            <button type="submit" name="simpan" class="btn btn-primary">Submit</button>     
            
          </form>
<thead>

  </div>
  <table class="border border-black h-screen">
                        <tr class="border border-black bg-slate-900 text-white">
                          <th scope="col" class="border border-black p-2.5">no</th>
                          <th scope="col" class="border border-black p-2.5">nama</th>
                          <th scope="col" class="border border-black p-2.5">harga</th>
                          <th scope="col" class="border border-black p-2.5">stok</th>
                          <th scope="col" class="border border-black p-2.5">jenis</th>
                          <th scope="col" class="border border-black p-2.5">poto</th>
                          <th scope="col" class="border border-black p-2.5">deskripsi</th>
                          <th scope="col1" class="border border-black p-2.5">action</th>
                         </tr>
                          </thead>
                          <tbody>
 <?php
 include 'koneksi.php';
 $no = 1 ;
  $hasil = mysqli_query ($koneksi, "SELECT * FROM tb_produk " );
  while ($data = mysqli_fetch_array ($hasil)){
    
  
  
  ?>
                 
               <tr class = "border-2 border-black  ">
                  <td class="border-black border-2 "><?= $no++;?></td>
                  <td class="border-black border-2 "><?= $data ['nama']?></td>
                  <td class="border-black border-2 "><?= $data ['harga']?></td>
                  <td class="border-black border-2 "><?= $data ['stok']?></td>
                  <td class="border-black border-2 "><?= $data ['jenis']?></td>
                  <td class="border-black border-2 "><img src="./images/<?= $data ['poto']?>"height="150px" width="200px" ></td>
                  <td class="border-black border-2 "><?= $data ['deskripsi']?></td>
                    <td class="border-black border-2 ">
                      <a href="updateVape.php?id=<?= $data['id']?>" class="btn btn-warning">edit</a>
                      <a href="hapus.php?id=<?= $data ['id'] ?>" class="btn btn-danger">hapus</a>
                    </td>            
                  </tr>
                  <?php }?>
                </tbody>
              </table>
                    
            </section>
            
            
            
        </div>
        </body>
        </html>