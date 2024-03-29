<?php 
    require_once '../model/login.php';
    session_start();
    if (isset($_SESSION['correo'])) {
        $correo = $_SESSION['correo'];
        $nombre = $_SESSION['nombre'];
        $id = $_SESSION['id'];
     //  echo "Bienvenido, $nombre ($correo)($id)";
    }  else {
        header("Location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
     include '../controller/librery/librery.php';
     require_once '../controller/librery/database.php';

    ?>
    <title>Estadistica</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../controller/estadistica.css">


    <!--Liberia de menu-->

    <link rel="stylesheet" href="../view/menu/style.css">

</head>


<body>

    <?php include '../view/nav/nav.php'; ?>
    <?php   include '../view/menu/barmenu.html'?>

    <div class="container mx-auto">

            <div class="grid grid-cols-3 gap-4">
                <!--LINEA NEGRA-->
                    <div class="col-span-3 md:col-span-1 bg-indigo-800 p-4 flex flex-col items-center">
                        <!-- Modal toggle -->
                        <h2 class="text-white mb-4">Modulo de estadistica</h2>
                    </div>
                    <div class="col-span-3 md:col-span-1 flex justify-center">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:flex-col md:flex-row">
                            <button class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500 font-bold py-2 px-4 rounded" id="botonInformacion">Informacion de venta de Hoy</button>
                            
                            <button class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500 font-bold py-2 px-4 rounded" id="botonfiltrodata">Informacion de venta por Fecha</button>
                        </div>
                    </div>


    <div class="col-span-3 md:col-span-1 bg-white p-4 flex flex-col items-center" id="informacion">

        <div>
    
                <?php include '../model/traerdatos.php';
                    try {
                        $ventatotal = new VentaTotal($connection);
                        $ventatotaldia = $ventatotal->obtenerValorTotal($id);

                        $row = $ventatotaldia->fetch(PDO::FETCH_ASSOC);
                        $gananciaTotal = $row['ganancia_total'];
                        echo "<div class='relative flex flex-col bg-clip-border bg-white text-gray-700 rounded-2xl shadow-lg shadow-gray-500/10'>
                        <div class='bg-clip-border mx-4 rounded-xl overflow-hidden bg-gradient-to-tr from-orange-600 to-orange-400 text-white shadow-orange-500/40 shadow-lg absolute -mt-4 grid h-16 w-16 place-items-center'>
                            <div class='icon-div'>
                                <img src='../resources/icons8-señal-100.png' alt='Icono JPG' class='w-12 h-12'>
                            </div>
                        </div>
                        <div class='p-4 text-right'>
                            <p class='block antialiased font-sans text-sm leading-normal font-normal text-blue-gray-600'>Venta total del día</p>
                            <h2 class='block antialiased tracking-normal font-sans text-2xl font-semibold leading-snug text-blue-gray-900'><span id='gananciaTotal'>0</span> </span>  </h2>
                        </div>
                        <div class='border-t border-blue-gray-50 p-4'>
                            <p class='block antialiased font-sans text-base leading-relaxed font-normal text-blue-gray-600'>
                                <strong class='text-green-500'>Impulsando las ganancias</strong>&nbsp;con éxito financiero
                            </p>
                        </div>
                    </div>";
                            
                        } catch (PDOException $e) {
                            die("Error al obtener los datos: " . $e->getMessage());
                        }
                ?>
        </div>
    <div class="lg:flex py-4"> 
        <div class="text-black items-center prueba pb-10 w-full lg:w-1/2 p-4">
        <div class="lg:w-1/2 p-4 order-1 lg:order-2 flex items-center">
            <div class=' mr-4'>
                <img src='../resources/ganancias.png' alt='Icono JPG' class='w-12 h-12'>
            </div>
            <h2 class="text-black mb-4 text-center mx-auto py-4 lg:text-right lg:mr-4 lg:mb-0">Indicador de ganancias diarias</h2>
        </div>
            <?php 
                $ventasStats = new VentasStatistics($connection);
                // Obtener las ventas por nombre utilizando el método obtenerVentasPorNombre()
                $ventasPorNombre = $ventasStats->obtenerVentasPorNombre($id);
                // Acceder a los resultados obtenidos
                $nombres = $ventasPorNombre['nombres'];
                $ganancias = $ventasPorNombre['ganancias'];
                $colores = array(
                    'rgba(54, 162, 235, 0.5)',   // Azul claro
                    'rgba(255, 206, 86, 0.5)',   // Amarillo claro
                    'rgba(75, 192, 192, 0.5)',   // Verde claro
                    'rgba(153, 102, 255, 0.5)',  // Violeta claro
                    'rgba(255, 159, 64, 0.5)',   // Naranja claro
                    'rgba(255, 215, 64, 0.5)',   // Oro claro
                    'rgba(144, 238, 144, 0.5)',  // Verde bosque claro
                    'rgba(0, 191, 255, 0.5)',    // Azul cielo claro
                    'rgba(255, 182, 193, 0.5)',   // Rosa claro
                    'rgba(255, 99, 132, 0.5)'  // Rojo claro
                    // Puedes agregar más colores si lo deseas
                  );
            ?>    
       <table class="table-auto w-full border border-gray-300 text-center bg-clip-border bg-white text-gray-700 rounded-2xl shadow-lg shadow-gray-500/10 border-t border-blue-gray-50 p-4">
       <table class="table-auto w-full border border-gray-300 text-center bg-white rounded-2xl shadow-lg" >
            <thead class="bg-gradient-to-tr from-orange-600 to-orange-400 text-gray-700">
                <tr>
                    <th class="px-4 py-2 border border-gray-300 bg-gray-300">Nombre del producto</th>
                    <th class="px-4 py-2 border border-gray-300 bg-gray-300">Ganancia</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($nombres as $key => $nombre): ?>
                    <tr>
                        <td class="px-4 py-2 border border-gray-300" style="background-color: <?php echo $colores[$key % count($colores)]; ?>">
                            <?php echo $nombre; ?>
                        </td>
                        <td class="px-4 py-2 border border-gray-300">
                            <?php echo '$ ' . number_format($ganancias[$key], 0, ',', '.'); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
            <!--Grafica de ganacias-->
                <div class="w-full lg:w-1/2 p-4">   
                    <h2 class="text-center font-bold py-4">Gráfico de Barras - Ganancias diarias</h2>
                        <div id="chartContainer" class="" style=" width: 100%; ">
                            <canvas id="barChart" style=" top: 0; left: 0; width: 100%; height: 100%;"></canvas>
                    </div>
                </div>  
             <!--Final-->   
         
    </div>



   </div>



            <!--Columan de filtro de fecha -->
            <div class="col-span-3 md:col-span-1 bg-white p-4 flex flex-col items-center" id="filtrodata">
                        <div class="flex justify-center items-start p-10 px-4 py-2 border border-gray-300">
                            <form id="consultaForm" class="flex flex-wrap items-center gap-4 md:flex-row flex-col">
                            <label for="fechaInicio" class="text-gray-700">Fecha de inicio:</label>
                                <input type="date" id="fechaInicio" name="fechaInicio" class="block w-36 py-2 px-2 border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>

                                <label for="fechaFin" class="text-gray-700">Fecha de fin:</label>
                                <input type="date" id="fechaFin" name="fechaFin" class="block w-36 py-2 px-2 border border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <input type="hidden" id="usuariocode" name="usuariocode" value="<?php echo $id; ?>">      
                                <button type="submit" id="btnConsultar" class="h-10 px-5 py-2 text-white bg-indigo-700 rounded-lg transition-colors duration-150 shadow-md focus:outline-none focus:ring focus:ring-indigo-200 focus:ring-opacity-50 hover:bg-indigo-800">Consultar</button>
                            </form>
                        </div>
                    <br>

                    <div id="resultado">
                            <!-- Aquí se mostrará la tabla con los productos -->
                    </div> 
            </div>
            <!-- Final -->


</div>



  </div>

<!-- SCRIPT de barmenu-->
<script src="../view/menu/script.js"></script>


<!-- Agrega las referencias a las librerías de jQuery y DataTables -->
<link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script scrt=""></script>

<!-- Script del gráfico -->
<script>
  // Obtener los datos de PHP y convertirlos a formato JavaScript

  var nombres = <?php echo json_encode($nombres); ?>;
  var ganancias = <?php echo json_encode($ganancias); ?>;

        // Crear un elemento script
        var nuevoScript = document.createElement('script');

        // Asignar la fuente (ruta) del script que deseas cargar
        nuevoScript.src = '../controller/graficosgananciadiaria.js';

        // Adjuntar el nuevo script al documento
        document.body.appendChild(nuevoScript);
</script>

<script src="../controller/inventario.js">
    
</script>

<script>
   
         $(document).ready(function() {
            $('#botonInformacion').click(function() {
                $('#informacion').toggle();
            });

            $('#botonfiltrodata').click(function() {
                $('#filtrodata').toggle();
            });

            $('#consultaForm').submit(function(event) {
                event.preventDefault();
                const fechaInicio = $('#fechaInicio').val();
                const fechaFin = $('#fechaFin').val();
                const usuariocode = $('#usuariocode').val();
                
                obtenerProductosPorFecha(fechaInicio, fechaFin,usuariocode);
            });
        });



      

    function obtenerProductosPorFecha(fechaInicio, fechaFin, usuariocode) {
            fetch(`../model/consultar.php?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}&usuariocode=${usuariocode}`)
                .then(response => response.json())
                .then(data => mostrarProductos(data.productos))
                .catch(error => console.error('Error al obtener los datos:', error));
        }
    function formatNumberWithCommas(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

    function mostrarProductos(productos) {
                        const resultadoDiv = document.getElementById("resultado");
                        resultadoDiv.classList.add("my-8");
                        resultadoDiv.innerHTML = "";

                        // Crear un nuevo elemento h1
                        var nuevoH1 = document.createElement("h1");
                        var br = document.createElement("br");
                        // Asignar texto al elemento h1
                        nuevoH1.textContent = "La informacion que se muestra en el tablero es la venta de los productos en su totalidad de la fecha del filtro";

                        // Obtener la referencia al elemento existente antes del cual deseas insertar el h1
                        var referenciaElemento = resultadoDiv;

                        // Insertar el nuevo h1 antes del elemento de referencia
                        referenciaElemento.parentNode.insertBefore(nuevoH1, referenciaElemento);


                        // Calcular el valor total de todos los productos
                        var valorTotal = 0;
                            productos.forEach(producto => {
                                const precioNumero = parseFloat(producto.precio);
                                valorTotal += precioNumero;
                            });

                            // Crear un nuevo elemento <span> para mostrar el valor total
                            var spanValorTotal = document.createElement("span");
                            spanValorTotal.textContent = "Valor total de productos: $ " + valorTotal.toLocaleString('en-US', { minimumFractionDigits: 0 }); // Formatear el valor total con dos decimales y el formato en-US
                            spanValorTotal.classList.add("m-8","px-4", "py-2", "border", "border-gray-300","my-6");
                            referenciaElemento.parentNode.insertBefore(spanValorTotal, referenciaElemento.nextSibling); // Insertar el <span> después del h1


                            if (productos.length === 0) {
                                resultadoDiv.textContent = "No se encontraron productos en las fechas seleccionadas.";
                                return;
                            }


                        if (productos.length === 0) {
                            resultadoDiv.textContent = "No se encontraron productos en las fechas seleccionadas.";
                            return;
                        }
                            
                        const table = document.createElement("table");
                        table.id = "miTabla";
                        table.classList.add("table-auto", "w-full", "border", "border-gray-300", "text-center", "display");

                        const thead = document.createElement("thead");
                        const trHead = document.createElement("tr");
                        const thNombre = document.createElement("th");
                        thNombre.textContent = "Nombre del producto";
                        thNombre.classList.add("px-4", "py-2", "border", "border-gray-300");
                        const thPrecio = document.createElement("th");
                        thPrecio.textContent = "Precio";
                        thPrecio.classList.add("px-4", "py-2", "border", "border-gray-300");
                        trHead.appendChild(thNombre);
                        trHead.appendChild(thPrecio);
                        thead.appendChild(trHead);

                        const tbody = document.createElement("tbody");
                        productos.forEach(producto => {
                            const tr = document.createElement("tr");
                            const tdNombre = document.createElement("td");
                            tdNombre.textContent = producto.nombre;
                            tdNombre.classList.add("px-4", "py-2", "border", "border-gray-300");
                            const tdPrecio = document.createElement("td");

                            // Convertir el precio a número y formatear con puntos para separar miles y dos decimales
                            const precioNumero = parseFloat(producto.precio);
                            const precioFormateado = precioNumero.toLocaleString('en-US', { minimumFractionDigits: 0 });

                            // Formatear el precio con el símbolo de pesos
                            const precioConSimbolo = "$" + precioFormateado;
                            tdPrecio.textContent = precioConSimbolo;
                            tdPrecio.classList.add("px-4", "py-2", "border", "border-gray-300");
                            tr.appendChild(tdNombre);
                            tr.appendChild(tdPrecio);
                            tbody.appendChild(tr);
                        });
                        table.appendChild(thead);
                        table.appendChild(tbody);
                        resultadoDiv.appendChild(table);

                        
                        // Inicializar DataTables
                        $(document).ready(function () {
                            $('#miTabla').DataTable({
                                "order": [[1, "desc"]] // 1 indica la columna del precio (la primera columna es 0)
                            });
                        });
                    }
</script>





<script>
    const gananciaTotalElement = document.getElementById('gananciaTotal');
    const targetGananciaTotal = parseFloat(<?php echo $gananciaTotal; ?>); // Valor final de gananciaTotal
    const increment = targetGananciaTotal / 100; // Incremento por paso (ajustar para cambiar la velocidad)
    let currentGananciaTotal = 0;
    let animationRequestId;

    function updateGananciaTotal() {
        gananciaTotalElement.textContent = '$ ' + currentGananciaTotal.toLocaleString('en-US', { minimumFractionDigits: 0 });

        currentGananciaTotal += increment;

        if (currentGananciaTotal <= targetGananciaTotal) {
            animationRequestId = requestAnimationFrame(updateGananciaTotal);
        }
    }

    document.getElementById('botonInformacion').addEventListener('click', function () {
        if (!animationRequestId) {
            updateGananciaTotal();
        }
    });
</script>

</body>
</html>

    
