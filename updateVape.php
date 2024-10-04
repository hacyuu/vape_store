<?php
include 'koneksi.php';

$id = (int)$_GET['id'];

if(isset($_POST['simpan'])) {

    $nama_barang = $_POST['nama_barang'];
    $harga_barang = $_POST['harga_barang'];
    $stok_barang = $_POST['stok_barang'];
    $jenis= $_POST['jenis'];
    $deskripsi_barang =$_POST['deskripsi_barang'];
    $poto = $_FILES['poto']['name'];
    $file_tmp = $_FILES ['poto']['tmp_name'];
    move_uploaded_file($file_tmp, 'images/'.$poto);
    
$query= "UPDATE tb_produk SET nama='$nama_barang', harga='$harga_barang', stok='$stok_barang', poto='$poto', jenis='$jenis', deskripsi='$deskripsi_barang' WHERE id=$id";
$submit = mysqli_query($koneksi, $query); 


if ($submit)  {
    echo "<script altert> ('data berhasil berubah') </script>";
    header('location: dasboard.php' );
}   
}


    $id = $_GET['id'];
    $hasil = mysqli_query ($koneksi, "SELECT * FROM tb_produk where id = '$id'" );
    while ($data = mysqli_fetch_array ($hasil)){
      
      $nama = $data['nama'];
      $harga = $data['harga'];
      $stok = $data['stok'];
      $jenis = $data['jenis'];
      $poto = $data['poto'];
      $deskripsi = $data['deskripsi'];
    } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit</title>
        <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
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
  <input type="file" class="form-control" value="<?php echo $poto ?>" name="poto" id="inputGroupFile02">
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
</body>
</html>