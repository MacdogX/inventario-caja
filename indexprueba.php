<!DOCTYPE html>
<html lang="en">
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css">
 
    <!-- Añade este script en la sección head -->
       <!-- <script>
        // Habilita el desplazamiento suave en todos los enlaces internos
        document.addEventListener("DOMContentLoaded", function () {
            const internalLinks = document.querySelectorAll('a[href^="#"]');
            for (let link of internalLinks) {
            link.addEventListener("click", function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute("href"));
                target.scrollIntoView({
                behavior: "smooth",
                block: "start",
                });
            });
            }
        });
        </script>
    -->
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
    <a href="#" class="top-btn" id="openModalButton">Ingreso</a>
    </div>

    </header>

    <section class="hero">
        <div class="hero-text">
            <h6>Good day</h6>
            <h5>#1 Optimiza tus Ventas Diarias con Nuestro Software de Seguimiento</h5>
            <h1><span>Inventorio</span></h1>
            <p>En el mundo empresarial actual, mantener un control efectivo sobre las ventas diarias es esencial para el éxito continuo de cualquier negocio. Imagina tener la capacidad de rastrear cada transacción, comprender las tendencias del mercado y tomar decisiones informadas que impulsen tus ingresos. Con nuestro innovador software de seguimiento de ventas, lograrás precisamente eso y más.</p>
            <a href="#" class="btn">Buy now</a>
            <a href="#" class="btn btn2">Watch Videos </a>
        </div>
        <div class="hero-imgg"> 
        <img src="resources/ahorrar-dinero.png" alt="">
        <div class="scroll">
            <a href="#">
                scroll down
                <i class='bx bxs-chevron-down'></i>
            </a>
        </div>
    </div>

    <div class="icon">
        <a href="#"><i class='bx bxl-github'></i></a>
        <a href="#"><i class='bx bxl-linkedin-square'></i></a>
        <a href="#"><i class='bx bxl-twitter'></i></a>
    </div>


  

        <!-- Modal -->
        <div id="authentication-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            <div class="z-10 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full max-w-sm">
                <button class="absolute top-0 right-0 p-2" id="closeModalButton">×</button>
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post" action="model/login.php">
                        <h3 class="text-3xl font-bold dark:text-white">Inicio de sesión</h3>
                        <br>
                        <div class="mb-4">
                          <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                            Correo
                          </label>
                          <input required  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="correo" name="correo" type="text" placeholder="Username">
                        </div>
                        <div class="mb-6">
                          <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            Contraseña
                          </label>
                          <input required class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="contrasena" name="contrasena"type="password" placeholder="******************">
                          <p class="text-red-500 text-xs italic"></p>
                        </div>
                        <div class="flex flex-col items-center">
                          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mb-2" type="button">
                            <input type="submit" value="Iniciar sesión">
                          </button>
                            <!-- Modal toggle -->
                       <!--   <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mb-2" type="button">
                            Crear usuario
                          </button>
-->
                          <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                            Olvidé la contraseña
                          </a>
                      </div>
                </form>
            </div>
        </div>


<script>
    const openModalButton = document.getElementById('openModalButton');
    const modal = document.getElementById('authentication-modal');

    openModalButton.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });
</script>


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