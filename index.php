<?php session_start();
?>
<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="controller/index.css">
   <!--Boxicon link--> 
    <link rel="stylesheet"
         href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!--google fonts link-->    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&family=Permanent+Marker&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css"  rel="stylesheet" />
    <title>landing</title>
</head>
<body>
    <header>

    <a href="#" class="logo">
         <img src="resources/inventori.png" alt="" class="icono">
    </a>

    <div class="bx bx-menu" id="menu-icon"></div>

    <ul class="navbar">
        <li><a href="">Home</a></li>
        <li><a href="">Rent</a></li>
        <li><a href="">Videos</a></li>
        <li><a href="">About</a></li> 
        <li><a href="">Ingreso</a></li>
    </ul>

    <div class="top-bttn">
     <!--   <a href="#" class="top-btn">Ingreso</a>-->
        <button data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
            Ingreso
            </button>
    </div>

    </header>

    <section class="hero">
        <div class="hero-text">
            <h6>Good day</h6>
            <h5>Optimiza tus Ventas Diarias con Nuestro Software de Seguimiento</h5>
            <h1><span>Inventorio</span></h1>
            <p>En el mundo empresarial actual, mantener un control efectivo sobre las ventas diarias es esencial para el éxito continuo de cualquier negocio. Imagina tener la capacidad de rastrear cada transacción, comprender las tendencias del mercado y tomar decisiones informadas que impulsen tus ingresos. Con nuestro innovador software de seguimiento de ventas, lograrás precisamente eso y más.</p>
            <a href="#" class="btn">Compra Ahora</a>
            <a href="#" class="btn btn2">Videos</a>
        </div>
        <div class="hero-imgg"> 
            <img src="resources/ahorrar-dinero.png" alt="">
        </div>
    </section>
    <div class="scroll">
        <a href="#">
            scroll down
        <i class='bx bxs-chevron-down'></i>
        </a>
    </div>

    <div class="icon">
        <a href="#"><i class='bx bxl-github'></i></a>
        <a href="#"><i class='bx bxl-linkedin-square'></i></a>
        <a href="#"><i class='bx bxl-twitter'></i></a>
    </div>

<!-- Main modal -->
<div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                Inicio de sesión
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
          <form  class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post" action="model/login.php">
          <div class="mb-4">
                          <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="username">
                            Correo
                          </label>
                          <input required  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" id="correo" name="correo" type="text" placeholder="Username">
                        </div>
                        <div class="mb-6">
                          <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            Contraseña
                          </label>
                          <input required class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="contrasena" name="contrasena"type="password" placeholder="***********">
                          <p class="text-red-500 text-xs italic"></p>
                        </div>
                   
                         <!-- Modal footer -->
                         <div class="flex items-center justify-end space-x-2 border-gray-200 rounded-b dark:border-gray-600">
                        <div class="flex flex-row items-center space-x-2">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                                <input type="submit" value="Iniciar sesión">
                            </button>
                            <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancelar</button>
                        </div>
                    </div>
          </form>
   
            </div>
       
    </div>
</div>

        <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

    <!---Js file link-->
    <script >
        let menu = document.querySelector('#menu-icon');
        let navbar = document.querySelector('.navbar');
        menu.onclick = () => {
            menu.classList.toggle('bx-x');
            navbar.classList.toggle('active');
        }

    
    </script>
</body>
</html>