<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../controller/librery/librery.php';
    require_once '../controller/librery/database.php';
    
    ?>
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.dataTables.min.css"0>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
    <style>
        @media only screen and (max-width: 600px) {
            #chartContainer {
                padding-bottom: 100% !important;
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
            
            <div class="col-span-3 md:col-span-2 bg-white-800 p-4 flex flex-col items-center">
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-1 bg-red-300">
                        <h2 class="text-white mb-4 "></h2>
                        <div class="container mx-auto">
                            <div class="max-w-md mx-auto bg-white p-8 border border-gray-300 mt-8 rounded">
                                <h2 class="text-2xl font-bold mb-4">Venta realizada Hoy</h2>
                                <form action="../model/traerdatos.php" method="POST" class="max-w-sm mx-auto">
                                    <div class="mb-4">
                                        <label for="inicio" class="block mb-2">Inicio</label>
                                        <input type="date" id="inicio" name="inicio" class="w-full border border-gray-300 rounded px-4 py-2">
                                    </div>
                                    <div class="mb-4">
                                        <label for="final" class="block mb-2">Final</label>
                                        <input type="date" id="final" name="final" class="w-full border border-gray-300 rounded px-4 py-2">
                                    </div>
                                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Enviar</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-2">
                        <h2 class="text-white mb-4">Indicador de ganancias diarias</h2>


                        <?php
                                include '../model/traerdatos.php';
                                $ventasStats = new VentasStatistics($connection);
                                // Obtener las ventas por nombre utilizando el método obtenerVentasPorNombre()
                                $ventasPorNombre = $ventasStats->obtenerVentasPorNombre();
                                // Acceder a los resultados obtenidos
                                $nombres = $ventasPorNombre['nombres'];
                                $ganancias = $ventasPorNombre['ganancias'];
                        ?>
                        <table class="table-auto w-full">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-2">Nombre del producto</th>
                                            <th class="px-4 py-2">Ganancia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($nombres as $key => $nombre): ?>
                                            <tr>
                                                <td class="px-4 py-2"><?php echo $nombre; ?></td>
                                                <td class="px-4 py-2"><?php echo number_format($ganancias[$key], 0, ',', '.'); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                        <div id="chartContainer" style="position: relative; width: 100%; height: 0; padding-bottom: 56.25%;">
                            <canvas id="barChart" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></canvas>
                        </div>


                        <script>
                            // Obtener los datos de PHP y convertirlos a formato JavaScript
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
</html>