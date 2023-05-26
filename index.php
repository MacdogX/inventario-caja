<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <title>Login</title>
</head>
    <body>
        <header>
        <link rel="stylesheet" href="controller/login.css">
        </header>
        <?php include 'controller/librery/librery.php';?>
        <main>

        <?php  include 'view/nav/nav.php'; ?>


        </main>
   
<div class="container mx-auto px-4 flex items-center justify-center h-screen">

        <div class="w-full max-w-xs h-8">
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

<button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mb-2" type="button">
  Crear usuario
</button>
  <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
    Olvidé la contraseña
  </a>
 
</div>
  </form>
  <p class="text-center text-gray-500 text-xs">
    &copy;2023
  </p>
</div>

</div>






<!-- Main modal -->
<div id="authentication-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="authentication-modal">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Cerrar Ventana</span>
            </button>
            <div class="px-6 py-6 lg:px-8">
                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Creacion de Usuario</h3>
                <form class="space-y-6" action="model/crearusuario.php" method="POST">
                    <div>
                        <label for="nombres" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombres</label>
                        <input type="text" name="nombres" id="nombres" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="nombres" required>
                    </div>
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="correo@compañia.com" required>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>              
                    <div>
                        <label for="password1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirme la Contraseña</label>
                        <input type="password" name="password1" id="password1" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                    </div>

                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Crear Usuario</button>

                </form>
            </div>
        </div>
    </div>
</div>


<!-- Script para abrir y cerrar el modal -->
<script>
function openModal() {
  document.getElementById("myModal").classList.remove("hidden");
}

function closeModal() {
  document.getElementById("myModal").classList.add("hidden");
}
</script>

<!--
        <h1>Login</h1>
  <form method="post" action="login.php">
    <label for="correo">Correo:</label>
    <input type="email" id="correo" name="correo" required>

    <br><br>

    <label for="contrasena">Contraseña:</label>
    <input type="password" id="contrasena" name="contrasena" required>

    <br><br>

   
  </form>

  <p><a href="recuperar_contrasena.php">¿Olvidaste tu contraseña?</a></p>


-->
        <footer>
        </footer>
    </body>
</html>