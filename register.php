

<?php
include 'koneksi.php';

if(isset($_POST['register'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $no_telepon = $_POST['no_telefon'];
    $alamat = $_POST['alamat'];

    
    
    $register = mysqli_query($koneksi, "INSERT INTO tb_user (nama,username,password,no_telepon,alamat, role) VALUES ('$nama', '$username', '$password', '$no_telepon', '$alamat','pelanggan' )");
    if ($register > 0 ){
        header("location: login.php");
    }else{
        header("location: register.php");
    }
}





?>





<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>register</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="regis.css">
    </head>
    <body class="flex flex-row ">
        
        <nav class="2xl:flex-row xl:flex-row lg:flex-row md:flex-row flex-col ">
            
            <div class="sidebar h-screen h-screen top-0 bottom-0 lg:left-0 p-2 w-[300px] overflow-y-auto bg-gray-900">
                <div class="text-gray-100 text-xl">
                    <div class="p-2.5 mt-1 flex items-center ">
                        <i class="bi bi-app-indicator"></i>
                        <h1 class="font-bold text-gray-200 text-[15px] ml-3">vapestore</h1>
                        <i class="bi bi-x"></i>
                        <a class="ml-auto" href="index.php">
                            <img class="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAARFJREFUSEvt1tERgjAMBuBkE0eBTXQSdRLZRDfRTX6J13IBYmkiJy/0kTv7YWj+lGmjxRu5FIYBHIioYeYu8vIhGMCNiI4JvDLzxYu74QmaPTfugifoK6lSclkuvBo20FNfbsHvROTGq2ALZeaH/M10yNz4IlxC8weO4EW4Bo3iX2EPGsFNOIJ68Rn8C+rBR7ARDq7e1OkFQNLsrJ6N9hpgABKBEoV6rQnLvm1uQw03KQz+C6swkBSSQHDHYKHUraQcM+eYtcci+g+0Jsz9+JpOr2/ttMPeOS/DY2invdRSvv1wfQ4RgKe6zrgP1qxnHX1s5Xb0Bcy8L10EJLslPvNFLgJ3Oib1Bot3rohW85vN4Dd3Zd0f2WphuAAAAABJRU5ErkJggg=="/>

                        </a>
                        
                    </div>
                </div>

                <section class="2xl:flex-row xl:flex-row lg:flex-row md:flex-row flex-col ">

                    
                    <div class="flex flex-row justify-center items-center ">
                        <h1  class="font-bold text-gray-200 text-[15px] text-xl" >register</h1>
                    </div>
                    <div class="">

                        <div class="p-2.5 mt-3 flex items-center rounded-md duration-300
            cursor-pointer bg-gray-700 ">
            <input class="  text-[15px] ml-4 w-full bg-transparent focus:outlane-none" type="text" name="nama" placeholder="nama" 
            required>
            <i class='bx bxs-user'></i>
        </div>
        <form method="POST" action="">
            
            <div class="p-2.5 mt-3 flex items-center rounded-md duration-300
            cursor-pointer bg-gray-700 ">
            <input class=" text-[15px] ml-4 w-full bg-transparent focus:outlane-none" type="text" name="username" placeholder="username"
            required>
        </div>
        <div class="p-2.5 mt-3 flex items-center rounded-md duration-300
        cursor-pointer bg-gray-700 ">
        <input class="text-[15px] ml-4 w-full bg-transparent focus:outlane-none" type="password" name="password" placeholder="password"
        required>
        <i class='bx bxs-lock' ></i>
    </div>
    <div class="p-2.5 mt-3 flex items-center rounded-md duration-300
    cursor-pointer bg-gray-700 ">
    <input class=" text-[15px] ml-4 w-full bg-transparent focus:outlane-none" type="text" name="no_telefon" placeholder="no_telefon"
    >
</div>
<div class=" p-2.5 mt-3 flex items-center rounded-md duration-300
cursor-pointer bg-gray-700 t">
<input class="text-[15px] ml-4 w-full bg-transparent focus:outlane-none" type="text" name="alamat" placeholder="alamat"
>
</div>

<button type="submit" name="register" class="bg-white w-full rounded-lg mt-4"  >sign up</button>

</form>

</div>
</section>


</nav>

<div>
    <div class="2xl:flex-row xl:flex-row lg:flex-row md:flex-row flex-col ">
        
        <img class="h-screen w-screen" src="barang/xlimbanner3.jpeg" alt="">
    </div>
</div>
<!-- <table class="border border-4 border-black">
    <tr class="border border-2 border-black">
        <td>username:</td>
        <td><input type="text" name="username" id=""></td>
    </tr>
            <tr class="border border-2 border-black">
                <td>password:</td>
                <td><input type="password" name="password" id=""></td>
            </tr>
            <tr class="border border-2">
                <td><input type="submit" name="login" value="login"></td>
            </tr>
            
        </table> -->
    </form>    
</div>
</div>
    
    
</body>
</html>
