<?php
include 'koneksi.php';
session_start();

if(!isset($_SESSION['role']) == 'pelanggan' ) {
    echo "<script>
    document.location.href = 'login.php'
    </script>";
}

$id_user = $_SESSION['id_user'];

function tampilkan($query){
    global $koneksi;
    $result = mysqli_query($koneksi,$query);
    
    while($data = mysqli_fetch_assoc($result)) {
        $items[] = array(
            'id' =>$data["id"],
            'nama' => $data["nama"],
            'username' => $data["username"],
            'password' => $data["password"],
            'no_telepon' => $data["no_telepon"],
            'alamat' => $data["alamat"],
            'role' => $data["role"],
        );
        $response = array(
            'status' => 'ok',
            'items' => $items,
        );
 
    }        
    return $response;
}

function perbarui_pelanggan($post, $id_pelanggan) {
    global $koneksi;
        
    $nama = $post['nama'];
    $username = $post['username'];
    $no_telepon = $post['no_telepon'];
    $alamat = $post['alamat'];

  $sql = mysqli_query($koneksi, "UPDATE tb_user SET nama = '$nama', username = '$username' , no_telepon = '$no_telepon', alamat = '$alamat' WHERE id='$id_pelanggan'");
    
  if($sql > 0) {
    return mysqli_affected_rows($koneksi);
  } else {
    return mysqli_error($koneksi);
  }
}

$data = tampilkan("SELECT * FROM tb_user WHERE username = '$_SESSION[username]'");

if(isset($_POST['simpan'])) { 
    if(perbarui_pelanggan($_POST, $_SESSION['id']) > 0 ) {
        echo "<script>
        alert('Data updated success');
        document.location.href = 'profile.php';
        </script>";
    } else {
        echo "<script>
        alert('Data updated failed');
        document.location.href = 'profile.php';
        </script>";
    }
}

function tampilkanHistory($query) {
    global $koneksi;
    $result = mysqli_query($koneksi,$query);
    
    while($data = mysqli_fetch_assoc($result)) {
        $items[] = array(
            'id_transaksi' => $data['id_transaksi'],
            'tanggal' => $data['tanggal'],
            'total' => $data['total'],
        );
        $response = array(
            'status' => 'ok',
            'items' => $items,
        );
 
    }        
    return $response;
    }

    $history = tampilkanHistory("SELECT t.id_transaksi,t.tanggal,t.total FROM tb_transaksi t INNER JOIN tb_user u ON t.id_pelanggan = u.id WHERE u.username = '$_SESSION[username]' ORDER BY t.id_transaksi DESC");


 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body{
    min-height: 200vh;
    background-size: cover;
    background-position: center;
    background:blur; 
    background-image: url("barang/vapeshop.jpg");
        }
     

    </style>
</head>
<body class="" >

<div class="">
 


<div class="space-between flex 2xl:flex-row xl:flex-row lg:flex-row md:flex-row flex-col  ">
    <div class="p-14">
        <div class="bg-transparent border border-white rounded-lg h-80 w-80 justify-center items-center pt-4">
        <a href="index.php"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAAS5JREFUSEvt1tERgjAMBuD8m8gk6iY6iTqJbKJOIptEf6/1ChRogh4v9M63mo+mSVvIQgMLueKGVXUjIjsAtefjXbCqXkXkEMALgLMVN8MdNHpm3AR30CaoTDmHCS+GM+jxnW7iNxEx40VwDgVw5zJDkZnxSXgMjRvswUfhEtSLD8IW1INnYQ9qxXvwHNSC52ANAdgqx1i91pMpU3D7NFYLVtVd6Es6RF3ncLLyNF4x3JpoXXHo8d/AqsrLYDvwEY/uZdHJoG/FqsrTiSsYGzUAHqWf8Ss4Lbp4QUSDZzV/DYDqX3DvFgpbcCKId75XOGTAXVxxj9dUs23Y37OKiy3x9JxSBf+pAHzbcOp2KohXNOUOYJ/OzMGfh3rygCuKPDYp9+6efHPNVgcCLAa/ABp8LC5UzMVeAAAAAElFTkSuQmCC"/></a>
            <img class="justify-center  rounded-full mx-auto"src="barang/profile.jpeg" alt="">
            <h1 class="text-center text-3xl font-bold text-white"><?php echo isset($_SESSION['nama']) ? htmlspecialchars($_SESSION['nama']) : 'pelanggan tidak tersedia;' ?></h1>
            <p class="text-center text-xl font-semibold text-white"><?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'pelanggan tidak tersedia;' ?>`</p>
            <a href="logout.php"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAASpJREFUSEvtloEJwjAQRe9v4ii6iU6inUScREdxk29+SbSEKHfRWgQPCqUkffm5y8/BFgosxLXfApNcmZkeVwC41APDikkezWzrIj4GXc3sBOBQPoXAJAUUuDc2RX0UfDazdVIsBbsAXfMUQ1HdC74A2HjBJPkHv9zqfGy2JS8kS47n22qSKiKB7pD8Tem6AlCBucKd4+rYhNS1VuICNwxCrjO4pKWBLZd6Cc75lDloi7sDqSDqyR6wcur24NbqwmD9pFRxet1PfhpyqfBWT1efjEZmXuDfKa6ygKxeW6+jM9rj9DpsKXtWGK6qrpQr33sA44XwFQN5ch7nd64/uM5xxM2y57/VCCzW+qjKe2313vZIeqj1qc6421o/0t523x7VxC7Fn4AvBr4B3SbcH7E0YVkAAAAASUVORK5CYII="/></a>
        </div>
    </div> 

    <div class="mx-auto bg-transparent border-2 border-white w-full h-screen p-14 drop-shadow-xl rounded-lg  ">

        <div class="">        
            <form method="POST" action="" >

            <h1 class="font-bold text-white font-sans text-2xl" >edit profile</h1>

              <div class="py-5">
                  <div class="p-2.5 mt-3 flex items-center  bg-transparent border border-white  rounded-md duration-300
                  cursor-pointer w-full h-15 gap-3">
                  <h1 class="text-white">nama:</h1>  
                <input class=" text-[15px] text-white w-full bg-transparent focus:outlane-none" type="text" name="name" value="<?php echo isset($_SESSION['nama']) ? htmlspecialchars($_SESSION['nama']) : 'pelanggan tidak tersedia;' ?>" placeholder="masukkan nama">
                </div>
              </div>

            <div class="py-5">
                <div class="p-2.5 mt-3 flex items-center rounded-md duration-300
                cursor-pointer border border-white w-full h-15 gap-3">
                <h1 class="text-white">username:</h1>
                    <input class=" text-[15px] text-white  w-full bg-transparent focus:outlane-none" type="text" name="username" value="<?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'pelanggan tidak tersedia;' ?>" placeholder="masukkan username"
                    >
                 </div>
            </div>

            <div class="py-5">
                <div class="p-2.5 w-full  mt-3 flex items-center rounded-md duration-300
                cursor-pointer border border-white w-full h-15 gap-3  ">
                <h1 class="text-white">password:</h1>
                    <input class="text-[15px] text-white  w-full bg-transparent focus:outlane-none" type="password" name="password" value="<?php echo isset($_SESSION['password']) ? htmlspecialchars($_SESSION['password']) : 'pelanggan tidak tersedia;' ?>" placeholder="masukkan password"
                    >
                     <i class='bx bxs-lock' ></i>
                </div>
            </div>

            <div class="py-5">
                
                <div class="p-2.5 w-full  mt-3 flex items-center rounded-md duration-300
                cursor-pointer border border-white w-full h-15 gap-3 ">
                <h1 class="text-white">nohp:</h1>
                    <input class=" text-[15px] text-white  w-full bg-transparent focus:outlane-none" type="text" name="no_telepon" value="<?php echo isset($_SESSION['no_telepon']) ? htmlspecialchars($_SESSION['no_telepon']) : 'pelanggan tidak tersedia;' ?>" placeholder="masukkan nomor"
                    >
                </div>
           </div>

            <div class="py-5">

                <div class=" p-2.5 w-full  mt-3 flex items-center rounded-md duration-300
                cursor-pointer border border-white w-full h-15 gap-3 t">
                <h1 class="text-white" >alamat:</h1>
                <input class="text-[15px] text-white w-full bg-transparent focus:outlane-none" type="text" name="alamat" value="<?php echo isset($_SESSION['alamat']) ? htmlspecialchars($_SESSION['alamat']) : 'Pelanggan tidak tersedia'; ?>" placeholder="masukkan alamat"
                >
            </div>
        </div>                

                <button type="submit" name="signup" class="bg-white w-full rounded-lg mt-4"  >sign up</button>

             </form>           
            </div>
        </div>
    </div>

    <div class="flex flex-col my-14 border border-white duration-300 rounded-lg drop-shadow-lg w-full">
                        <h1 class=" text-white text-center font-bold text-3xl mb-2">HISTORY</h1>
                        <div class="flex flex-col bg-transpare text-white items-center gap-2 h-[400px] overflow-auto ">
                            <?php foreach($history['items'] as $value) { ?>
                            <div class=" flex items-center justify-evenly py-3 w-full flex-row gap-4 font-bold text-xl ">
                                <h1 class=""><?php echo $value['id_transaksi'] ?></h1>
                                <h1><?php echo $value['tanggal'] ?></h1>
                                <h1 class="text-red-500 font-extrabold" >Rp. <?php echo number_format($value['total']) ?></h1>
                                <a href="cetak.php?id=<?php echo $value['id_transaksi'] ?>" class="bg-slate-900 text-slate-50 px-4 py-1 hover:bg-yellow-600" >Detail</a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>


 </div>

  <!-- Footer -->
  <footer class="bg-gray-900 text-white p-4 mt-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Vape Store. All rights reserved.</p>
        </div>
    </footer>
    
</body>
</html>