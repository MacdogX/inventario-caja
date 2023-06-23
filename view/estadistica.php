<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../controller/librery/librery.php';?>
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.dataTables.min.css"0>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
</head>
<body>

    <?php include '../view/nav/nav.php'; ?>

    <div class="container mx-auto">
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-3 md:col-span-1 bg-gray-800 p-4 flex flex-col items-center">
                <!-- Modal toggle -->
                <h2 class="text-white mb-4">Modulo de estadistica</h2>
            </div>
            <div class="col-span-3 md:col-span-2 bg-white-800 p-4 flex flex-col items-center">
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-1 bg-red-300">
                        <h2 class="text-white mb-4 "></h2>
                        <div class="container mx-auto">

                            <div class="max-w-md mx-auto bg-white p-8 border border-gray-300 mt-8 rounded">
                                <h2 class="text-2xl font-bold mb-4">Venta realizada Hoy</h2>
                                <form action="" method="POST">
                                    <button type="submit"
                                        class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Enviar</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <h2 class="text-white mb-4">prueba 2</h2>

                        <?php
                        // Conexión a la base de datos MySQL
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "principal";

                        $conn = mysqli_connect($servername, $username, $password, $dbname);

                        // Consulta SQL para obtener los datos de ventas
                        $query = "SELECT  nombre, 
                                          precio,
                                          nombre   
                                  FROM ventasproducto
                                  
                                  ";
                        $result = mysqli_query($conn, $query);

                        // Crear arrays para almacenar los datos de productos y cantidades
                        $productos = array();
                        $cantidades = array();

                        // Recorrer los resultados de la consulta y almacenar los datos en los arrays
                        while ($row = mysqli_fetch_assoc($result)) {
                            $productos[] = $row['name_producto'];
                            $cantidades[] = $row['value_producto'];
                        }

                        // Cerrar la conexión a la base de datos
                        mysqli_close($conn);
                        ?>

                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                        <div style="position: relative; width: 100%; height: 0; padding-bottom: 56.25%;">
                            <canvas id="lineChart" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></canvas>
                        </div>

                        <script>
                            // Obtener los datos de PHP y convertirlos a formato JavaScript
                            var productos = <?php echo json_encode($productos); ?>;
                            var cantidades = <?php echo json_encode($cantidades); ?>;

                            // Crear el contexto del gráfico
                            var ctx = document.getElementById('lineChart').getContext('2d');

                            // Crear el gráfico de líneas utilizando Chart.js
                            var chart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: productos,
                                    datasets: [{
                                        label: 'Cantidad',
                                        data: cantidades,
                                        backgroundColor: 'rgba(0, 123, 255, 0.5)', // Color del área debajo de la línea
                                        borderColor: 'rgba(0, 123, 255, 1)', // Color de la línea
                                        borderWidth: 1, // Ancho de la línea
                                        pointBackgroundColor: 'rgba(0, 123, 255, 1)', // Color de los puntos
                                        pointRadius: 4, // Tamaño de los puntos
                                        pointHoverRadius: 6, // Tamaño de los puntos al pasar el cursor
                                        borderDash: [5, 5] // Patrón del límite
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        y: {
                                            beginAtZero: true // Comenzar el eje y desde cero
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>