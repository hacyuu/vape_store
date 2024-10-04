<?php
include 'koneksi.php';

session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $login = mysqli_query($koneksi, "SELECT * from tb_user where username='$username' and password='$password'");


  
   if(mysqli_num_rows($login) > 0){
    while($data = mysqli_fetch_assoc($login)){

        if ($data['role'] == "admin")  {
            $_SESSION['admin'] = $username;
            $_SESSION['id_user'] = $data['id'];
            $_SESSION['role'] = $data['role'];

            header("location: dasboard.php");
        } elseif ($data['role'] == "pelanggan"){
            $_SESSION['username'] = $data['username'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['id_user'] = $data['id'];
            $_SESSION['alamat'] = $data['alamat'];
            $_SESSION['no_telepon'] = $data['no_telepon'];
            $_SESSION['password'] = $data['password'];
            $_SESSION['role'] = $data['role'];
            header("location: index.php");
        }
    };
        
    }else {
    echo "<script>alert('username dan password salah');</script>";
    echo "<script>location='login.php';</script>";
    
        
  }
}

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
            <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>login</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <style>
            * {
    margin:0;
    padding: 0;
    box-sizing: border-box;
    font-family: "poppins", sans-serif;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: url('vapebg2.jpeg') no-repeat  ;
    background-size: cover;
    background-position: center;

}

.wrapper {
    width: 460px;
    background: transparent;
    border: 2px solid gainsboro;
    color: white;
    border-radius: 10px;
    padding: 30px 40px;

}

.wrapper h1{
    font-size: 36px;
    text-align: center;

}

.wrapper .input-box{
    position: relative;
    width: 100%;
    height: 30px;
    margin: 30px 0;

}

.input-box input{
    width: 100%;
    height: 100%;
    background: transparent;
    border:none;
    outline: none;
    border: 2px solid grey;
    border-radius: 40px;
    font-size: 16px;
    color: white;
    padding: 20px 45px 20px 20px ;
}

.input-box input::placeholder {
    color:white;
}

.input-box i {
    position: absolute;
    right: 20px ;
    top: 50%;
    transform: translateY(-50%);
    font-size: 20px;
}

.wrapper .btn{
    width: 100%;
    height: 35px;
    background-color: white;
    border: none;
    outline: none;
    border-radius: 40px;
    box-shadow: 0 0 10px black;
    cursor: pointer;
    font-size: 16px;
    color: #333;
    font-weight: 600;
}

        </style>
    </head>
    <body >

<div class="wrapper">

    <form  action="" method="POST">

    <h1>login</h1>
        
        <div class="input-box">
            <input type="text" name="username" placeholder="username" 
            required>
            <i class='bx bxs-user'></i>
        </div>
        
        <div class="input-box">
            <input type="password" name="password" placeholder="password"
            required>
            <i class='bx bxs-lock' ></i>
        </div>

        <div class="mb-3 text-sm ">
              <div class="">
             <p> anda belum punya akun? <a class="text-blue-500" href="register.php">sign in</a></p>
          
              </div>     
            </div>
        
        <button type="submit" name="login" value="login" class="btn"  > login</button>


        
        
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
    
    
</body>
</html>
