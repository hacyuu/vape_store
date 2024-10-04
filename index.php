<?php

include('koneksi.php');
session_start();

if(!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>vapest</title>
    <!-- <link rel="stylesheet" href=""></link> -->
    <script src="https://unpkg.com/@phosphor-icons-web"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>
<body class="h-screen min-w-screen ">
  
    
    
    <header class=" w-full "> 
        <nav class="flex bg-gray-900 max-w-screen  justify-between  ">
            
            <div >
                <a href="#items">
                    <h1 class="  flex p-2 my-auto text-slate-500 mx-8 text-4xl font-[poppins] ">Vape <span class="text-white">store</span></h1>
                </a>
            </div>
            
            <div class="text-white  flex mx-8 items-center justify-center justify-between text-2xl font-sans text-lg gap-5 p-2 space-between  2xl:flex-row xl:flex-row lg:flex-row md:flex-row hidden  md:flex lg:flex xl:flex 2xl:flex  ">
                <a class="hover:text-slate-700 hover:border-b-2 border-slate-700  md:flex lg:flex xl:flex 2xl:flex" href="#pod">Pod</a>
                <a class="hover:text-slate-700 hover:border-b-2 border-slate-700   md:flex lg:flex xl:flex 2xl:flex" href="#liquid">Liquid</a>
                <a class="hover:text-slate-700 hover:border-b-2 border-slate-700   md:flex lg:flex xl:flex 2xl:flex" href="#mod">Mod</a>
            </div>

        
            
          
<section class="flex gap-2">
            <form  class="d-flex items-center"action="">
                <button class="me-1 flex justify-between" type="submit" formaction="cart.php"> 
                <img class="fa-solid fa-user"src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAAa5JREFUSEvFlT1OAzEQhd+jB3EEUnICWsJFIA0RN4AKqOAGiDQkFyFpOQElOQKCniET7JXX+Dfa1Y601dr+5o3fjImBggNxMTxYRI4A6LcNkqs+q9EoFpE7ALcebERy3UcCOfCK5LhvsFvqU0d9L6qD5jL3vTR3Pic56Vp11NUi8gLgwgC7KPfa9UsKrOVW1V3G2HZLso9F5MNtsQ4ymJCcb9s1dZjXYrphsQP83F4ZyYaXnVyO6urWMibVqmncb7g6K/4GVE6Bp7qqtby9TZlLwa7JWlkXJG09oo4eueuzinWxiKi7NQGNItWpMhcpNmDtZ+1rjVbJYqpzV1Sk2MBt2YpMJhuySepfmYsVG7D7euUmmc59W6GgL2oU62F2fud81fx3e7faXHZD5M1OJRH1Q7FiB27dnVPdehT8xbuALwEcAngi+e0fKCL7AK4AfJKcxbKrAovIA4Brc9iS5FkA/ArAmu+R5E0IXgt2DxWSewHwjzOKg8lVtZNpKS3zs4HNSE4DYP2v6zSmsXJXKTbwYwAHJN8SU+sEwBfJ907uOGfjmv/VimsOT60dDPwLyOevH+ByjoIAAAAASUVORK5CYII="/>

                <span class="badge bg-gray-700 text-white ms-1 rounded-pill"><?php echo count($_SESSION['cart']);?></span>
                </button>
            </form>


            <div class="my-auto mr-8 items-center justify-center" >
                
            <div class="relative">
        <!-- Profile Icon -->
        <button id="profileButton" class="flex items-center space-x-2 focus:outline-none">
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAAXNSR0IArs4c6QAAAj5JREFUSEvFVttRAzEMtCuBVALphFQCqQSohKQS0om4vZE8a1m27zLDxD+ZydlaabV65PSgkx+Em3YDi8hzSuk1pYTfmzp+yzlf9gSxCVjB3lJK7wPjcALg55yzOdS9PgUWkY8JoDcO0O+cM97tB9YoP5VWM4CIrgvNX4hK7+AbqH9ZqAcrduDAsRd9GLEa/CUjADzNKNR3SIc50AXvAf9QpMhZRZuImGEI7MLCCvQA4R085w2wiIBeM1yBduiHzYYRpw2k5sTgFbCjGJEc+bIs1iaqLjl1ToJypKqUnAfmaGGkXHQRnCEwdYLLLGLItFJF7YFxCXlrqBERy3uTM0pPxFL4rgCLCEoCl3BAi0W0/iEi5lQktsJUXpTo0gNG8B2nsMjAfOHgS4eAIzbMqYgNMGh0l4BCYO+1RswdbM2xNpHq/6D0GLiwxcBsoInY0R2JO6xXfWfVEEbMOa4UbSiqA3Qm3OVjw6GZUNpsLMchcEhJFJo6APB1Io1aqSvDwiRTDWAbCk1ZKGUAs4HAPsGBq68EfRMq3kuf81zoHrRKT0g1FFyJDhsI072KJZhUMO4HPee8gFMJwsFKsNGQ4KjRRGzVweOmeSiduMOt00RmDjXvImDOdaVcPzQ8z26y2edtY5EiQPuEE3aaNhoAc0nic7e2uzuX5taDI3/oWutWSasPaH7yq0+0AJizw2Vv43YZlXqoBb443TI74glbJrZL6+HRhd3A1DIt56ZWW+r/Z6GfeX/P901U32N49uYPM9FaLqBCLL0AAAAASUVORK5CYII=" alt="Profile" class="w-10 h-10 rounded-full"/>
        </button>
        
        <!-- Dropdown Menu -->
        <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg">
            <ul>
                <li>
                    <a href="profile.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profile</a>
                </li>
                <li>
                    <a href="login.php" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Login</a>
                </li>
            </ul>
        </div>
    </div>

    <script>
        // Toggle dropdown menu visibility
        const profileButton = document.getElementById('profileButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        profileButton.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
        });

        // Hide dropdown when clicking outside
        window.addEventListener('click', (e) => {
            if (!profileButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
    </section>
            </div>

        </nav>

        <nav class="bg-gray-900  2xl:hidden xl:hidden lg:hidden md:hidden flex">
            <div class="text-white  flex mx-8 items-center  justify-between text-2xl font-sans text-lg gap-5 p-2 space-between ">
                <a class="hover:text-slate-700 hover:border-b-2 border-slate-700" href="#pod">pod</a>
                <a class="hover:text-slate-700 hover:border-b-2 border-slate-700" href="#liquid">liquid</a>
                <a class="hover:text-slate-700 hover:border-b-2 border-slate-700" href="#mod">mod</a>
            </div>
           

        </nav>
    </header>

    <div class="bg-cover bg-center h-full sm:h-64 sm:object-cover sm:w-full md:w-full md:object-cover lg:w-full lg:object-cover  xl:w-full xl:object-cover 2xl:max-w-full 2xl:object-cover" style="background-image: url('images/bannerV.webp');">
        <div class="flex items-center justify-center h-full bg-black bg-opacity-50">
            <div class="text-center">
                <h1 class="text-white text-5xl font-bold sm:text-xl md:text-2xl lg:text-3xl xl:text-4xl 2xl:text-5xl">Welcome to Our Shop</h1>
                <p class="text-white text-xl sm:text-sm  md:text-md lg:text-lg xl:text-xl 2xl:text-xl mt-4">Find the best products at unbeatable prices</p>
            </div>
        </div>
    </div>
    
    
    
    <div class="grid 2xl:grid-cols-5 xl:grid-cols-5 lg:grid-cols-4 md:grid-cols-3 grid-cols-2 pb-2 mt-6 px-2 gap-4  justify-center items-center content-center  ">
        <img class=" flex p-4 max-w-52 sm:46 sm:object-cover md:flex lg:flex xl:flex 2xl:flex " src="barang/logo lost vape.webp" alt="">
        <img class=" flex p-4 max-w-52 sm:flex md:flex lg:flex xl:flex 2xl:flex " src="barang/aspire.jpeg" alt="">
        <img class=" flex p-4 max-w-52 sm:flex md:flex lg:flex xl:flex 2xl:flex " src="barang/extreme vafour.jpeg" alt="">
        <img class=" flex p-4 max-w-52 sm:flex md:flex lg:flex xl:flex 2xl:flex " src="barang/vgod.jpeg" alt="">
        <img class=" flex p-4 max-w-52 sm:flex md:flex lg:flex xl:flex 2xl:flex " src="barang/oxva-logo.webp" alt="">
    </div>
     
    <div>
        <a href="#"></a>
    </div>
    
    <section class="container mx-auto px-6 py-10 2xl:flex-row xl:flex-row lg:flex-row md:flex-row flex-col" >
            
        <h1 class=" text-gray-900 font-semibold uppercase text-3xl " id="items">All items</h1>
        
        <div class="grid 2xl:grid-cols-5 xl:grid-cols-5 lg:grid-cols-4 md:grid-cols-3 grid-cols-2 pb-2 mt-3 px-2 gap-3 ">
            <?php
                include 'koneksi.php';
                $query =  "SELECT * FROM tb_produk  "; 
                $hasil = mysqli_query ($koneksi, $query);
                while ($data = mysqli_fetch_array ($hasil)){
            ?>
                    
            <div class= "flex-col  card shadow-sm hover:border hover:border-slate-50 border-sm p-2 w-52 " >
                <div>
                <img  class="h-full w-52 bg-cover"  src="images/<?php echo $data['poto']?>" alt="">
                </div>
                <h1 class="text-slate-500 font-semibold sm:text-md"><?php echo $data['nama'] ?></h1>
                <p class="text-slate-500 font-semibold sm:text-sm/[17px]"><?php echo $data['harga'] ?></p>
                <p class="text-white py-2"><?php echo $data['deskripsi'] ?></p>
                <div class="btn-group sm-text-base mt-8">
                    <a href="detail.php?id=<?php echo $data['id']?>" type="button " class="btn btn-sm btn-outline-secondary  ">view</a>
                </div>
            </div>
            <?php } ?>          
        </div>

        <hr class="bg-gray-900">
        
        <div>
            <h1 class="text-center text-gray-900 font-semibold uppercase text-4xl mt-12 ">kategori</h1>
        </div>

        <h1 class=" text-gray-900 font-semibold mt-12 uppercase  text-3xl" id="liquid">Liquid</h1>
        <div class="flex flex-row  pb-2 mt-6 px-2 gap-3 ">
            <?php
                include 'koneksi.php';
                $query =  "SELECT * FROM tb_produk WHERE jenis='liquuid' "; 
                $hasil = mysqli_query ($koneksi, $query);
                while ($data = mysqli_fetch_array ($hasil)){
            ?>
                                        
            <div class= "flex-col card shadow-sm hover:border hover:border-slate-50 border-sm p-2 max-w-52 min-h-full" >
                <div class="">
                    <img  class="h-full w-full"  src="images/<?php echo $data['poto']?>" alt="">
                </div>
                <h1 class="text-slate-500 font-semibold"><?php echo $data['nama'] ?></h1>
                <p class="text-slate-500 font-semibold "><?php echo $data['harga'] ?></p>
                <p class="text-white py-2"><?php echo $data['deskripsi'] ?></p>
                <div class="btn-group">
                    <a href="detail.php?id=<?php echo $data['id']?>" type="button " class="btn btn-sm btn-outline-secondary ">view</a>
                </div>
            </div>
            <?php } ?>
        </div>   
        
        <hr class="bg-gray-900">


                <h1 class=" text-gray-900 font-semibold uppercase mt-12 text-3xl " id="pod">Pod portable</h1>
                <div class="flex flex-row  pb-2 mt-6 px-2 gap-6 ">                        
                    <?php
                        include 'koneksi.php';
                        $query =  "SELECT * FROM tb_produk WHERE jenis='pod' "; 
                        $hasil = mysqli_query ($koneksi, $query);
                        while ($data = mysqli_fetch_array ($hasil)){
                    ?>
                    
                    <div class= "flex-col card shadow-sm hover:border hover:border-slate-50 border-sm p-2 max-w-52 min-h-full" >
                        <div class="">
                            <img  class="h-full w-full"  src="images/<?php echo $data['poto']?>" alt="">
                        </div>
                        <h1 class="text-slate-500 font-semibold"><?php echo $data['nama'] ?></h1>
                        <p class="text-slate-500 font-semibold "><?php echo $data['harga'] ?></p>
                        <p class="text-white py-2"><?php echo $data['deskripsi'] ?></p>
                        <div class="btn-group">
                        <a href="detail.php?id=<?php echo $data['id']?>" type="button " class="btn btn-sm btn-outline-secondary ">view</a>
                    </div>
                </div>
            <?php } ?>          
        </div>

        <hr class="bg-gray-900">


                                <div class="">
                                    <h1 class=" text-gray-900 font-semibold uppercase mt-12 text-3xl ">Mod</h1>
                                </div>  
                 
                            <div class="flex flex-row  pb-2 mt-6 px-2 gap-6 ">
                    
                    <?php
  include 'koneksi.php';
  $query =  "SELECT * FROM tb_produk WHERE jenis='mod' "; 
  $hasil = mysqli_query ($koneksi, $query);
  while ($data = mysqli_fetch_array ($hasil)){
  ?>
                    

                        <div class= "flex-col card shadow-sm hover:border hover:border-slate-50 border-sm p-2 max-w-52 min-h-full" >
                            <div class="">
                                <img  class="h-full w-full"  src="images/<?php echo $data['poto']?>" alt="">
                            </div>
                            <h1 class="text-slate-500 font-semibold"><?php echo $data['nama'] ?></h1>
                            <p class="text-slate-500 font-semibold "><?php echo $data['harga'] ?></p>
                            <p class="text-white py-2"><?php echo $data['deskripsi'] ?></p>
                            <div class="btn-group">
                            <a href="detail.php?id=<?php echo $data['id']?>" type="button " class="btn btn-sm btn-outline-secondary ">view</a>
                          </div>
                        </div>
                   <?php } ?>          
                    </div>
  </div>

  <hr class="bg-gray-900">

                </section>

                 <!-- Footer -->
     <footer class="bg-gray-900 text-white p-4 mt-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Vape Store. All rights reserved.</p>
        </div>
    </footer>
    
    </body>
</html>