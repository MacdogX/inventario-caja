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
    <title>estadistica</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.dataTables.min.css"0>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
/* Estilos para pantallas de 601 píxeles en adelante */
@media only screen and (min-width: 601px) {
   /* Estilos para el contenedor del gráfico */
   #chartContainer {
    padding-bottom: 100% !important;
    }
    /* Estilos para el gráfico de barras */
    canvas#barChart {
        height: 550px !important;
        
    }
    /* Estilos para el elemento con id "informacion" */
    #informacion {
        display: none;
    }
}

/* Estilos para pantallas de 600 píxeles o menos */
@media only screen and (max-width: 600px) {
    /* Estilos para el contenedor del gráfico */
    #chartContainer {
        padding-bottom: 100% !important;
    }
    /* Estilos para el gráfico de barras */
    canvas#barChart {
        height: 600px !important;
    }
    /* Estilos para el elemento con id "informacion" */
    #informacion {
        display: none;
    }
}  
        </style>

</head>


<body>

    <?php include '../view/nav/nav.php'; ?>

    <div class="container mx-auto">

    <div class="grid grid-cols-3 gap-4">

        <div class="col-span-3 md:col-span-1 bg-gray-800 p-4 flex flex-col items-center">
            <!-- Modal toggle -->
            <h2 class="text-white mb-4">Modulo de estadistica</h2>
        </div>

        <div class="col-span-3 md:col-span-1 flex justify-center">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <button class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500 font-bold py-2 px-4 rounded"   id="botonInformacion"  >Informacion de venta de Hoy</button>
                </div>
                <div>
                    <button class="text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:focus:ring-blue-800 dark:hover:bg-blue-500 font-bold py-2 px-4 rounded">Informacion de venta por Fecha</button>
                </div>
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
                        echo "<h2 class='px-4 py-2 border border-gray-300 text-center font-bold'> Venta total del dia :  $gananciaTotal</h2> " ;
                        } catch (PDOException $e) {
                            die("Error al obtener los datos: " . $e->getMessage());
                        }
                ?>
        </div>
    <div class="lg:flex"> 
        <div class="text-black items-center prueba pb-10 w-full lg:w-1/2 p-4">
          <h2 class="text-white mb-4 text-center mx-auto">Indicador de ganancias diarias</h2>
            <?php 
                $ventasStats = new VentasStatistics($connection);
                // Obtener las ventas por nombre utilizando el método obtenerVentasPorNombre()
                $ventasPorNombre = $ventasStats->obtenerVentasPorNombre($id);
                // Acceder a los resultados obtenidos
                $nombres = $ventasPorNombre['nombres'];
                $ganancias = $ventasPorNombre['ganancias'];
            ?>    
            <table class="table-auto w-full border border-gray-300 text-center">
                    <thead>
                       <tr>
                        <th class="px-4 py-2 border border-gray-300">Nombre del producto</th>
                         <th class="px-4 py-2 border border-gray-300">Ganancia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($nombres as $key => $nombre): ?>
                            <tr>
                                <td class="px-4 py-2 border border-gray-300"><?php echo $nombre; ?></td>
                                <td class="px-4 py-2 border border-gray-300"><?php echo number_format($ganancias[$key], 0, ',', '.'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
            </table>
    </div>

        <div class="w-full lg:w-1/2 p-4">   
            <h2 class="text-center font-bold py-4">Gráfico de Barras - Ganancias diarias</h2>
            <div id="chartContainer" class="pt-6" style="position: relative; width: 100%; height: 400px;">
            <canvas id="barChart" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></canvas>
            </div>
  </div>   
        </div>
   </div>




</div>





</div>

<script>
  var nombres = <?php echo json_encode($nombres); ?>;
  var ganancias = <?php echo json_encode($ganancias); ?>;

  // Crear el contexto del gráfico
  var ctx = document.getElementById('barChart').getContext('2d');
  // Crear el gráfico de barras verticales utilizando Chart.js
  var chart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: nombres,
      datasets: [{
        label: 'Ganancias',
        data: ganancias,
        backgroundColor: 'rgba(0, 123, 255, 0.5)', // Color de las barras
        borderColor: 'rgba(0, 123, 255, 1)', // Color del borde de las barras
        borderWidth: 1 // Ancho del borde de las barras
      }]
    },
    options: {
      responsive: true,
      scales: {
        x: {
          beginAtZero: true, // Comenzar el eje x desde cero
          ticks: {
            font: {
              size: 26 // Ajustar el tamaño de la fuente en el eje x

            }
          }
        },
        y: {
          beginAtZero: true, // Comenzar el eje y desde cero
          ticks: {
            font: {
              size: 16 // Ajustar el tamaño de la fuente en el eje y
            },
            callback: function(value, index, values) {
              return value.toLocaleString('en-US', {minimumFractionDigits: 0}); // Mostrar números con separadores de miles
            }
          }
        }
      },
      plugins: {
        legend: {
          display: false // Ocultar la leyenda
        },
        title: {
          display: true,
          text: '', // Título del gráfico
          fontSize: 8 // Tamaño de la letra del título
        }
      },
      // Ajusta el ancho de las barras
      barPercentage: 0.8, // Controla el ancho de las barras
      categoryPercentage: 0.8 // Controla el espacio entre las barras
    }
  });
</script>

<script>
        $(document).ready(function() {
        $('#botonInformacion').click(function() {
            $('#informacion').toggle();
        });
        });    
</script>


</body>
</html>