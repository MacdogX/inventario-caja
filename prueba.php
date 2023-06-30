<!DOCTYPE html>
<html>
<head>
  <title>Ejemplo de abrir y cerrar un div con jQuery</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    #informacion {
      display: none;
    }
  </style>
</head>
<body>
  <button id="botonInformacion">Abrir/Cerrar Información</button>
  
  <div id="informacion">
    <h2>Contenido a mostrar</h2>
    <p>Este es el contenido que se muestra al hacer clic en el botón "Abrir/Cerrar Información".</p>
  </div>
  
  <script>
    $(document).ready(function() {
      $('#botonInformacion').click(function() {
        $('#informacion').toggle();
      });
    });
  </script>
</body>
</html>



<!--FORM PARA CONSULTAR FECHA DE LO VENDIDO-->

<form action="../model/traerdatos.php" method="POST" class="max-w-sm mx-auto" >
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



<style>
    .chart-container {
  position: relative;
  width: 100%;
  height: 0;
  padding-bottom: 75%; /* Ajusta el valor para cambiar la relación de aspecto de la gráfica */
}

canvas {
  position: absolute;
  width: 100% !important;
  height: 100% !important;
}
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="chart-container">
   <canvas id="myChart"></canvas>
</div>

<script>
// Obtener el contexto del lienzo
var ctx = document.getElementById('myChart').getContext('2d');

// Crear los datos de ejemplo
var data = {
  labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo'],
  datasets: [{
    label: 'Ventas',
    data: [12, 19, 3, 5, 2, 3,5,7,5],
    backgroundColor: 'rgba(54, 162, 235, 0.5)',
    borderColor: 'rgba(54, 162, 235, 1)',
    borderWidth: 1
  }]
};

// Configurar las opciones de la gráfica
var options = {
  responsive: true, // Hace que la gráfica sea responsiva
  maintainAspectRatio: false, // Desactiva el mantenimiento del aspecto para permitir que se ajuste al contenedor
};

// Crear la gráfica
var myChart = new Chart(ctx, {
  type: 'bar',
  data: data,
  options: options
});

</script>