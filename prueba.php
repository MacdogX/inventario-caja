<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<script>
$(document).ready(function(){
    $("#name").autocomplete({
        source: "autocomplete.php",
        minLength: 2,
        select: function(event, ui) {
            // Obtener el valor seleccionado del campo de texto
            var selectedlabel = ui.item.label;

            // Autocompletar el campo textbox con el valor seleccionado
            setTimeout(function(){
                $("#name").val(selectedlabel);
            }, 0);
        }
    });
    
    $("#name").on("autocompleteselect", function(event, ui) {
        // Obtener el valor seleccionado del campo de texto
        var selectedValue = ui.item.value;

        // Asignar el valor seleccionado al campo textmax
        $("#description").val(selectedValue);
    });
});
</script>
<input id="name" class="full-width" />
<input id="description" class="full-width" />

<!DOCTYPE html>
<html>
<head>
    <title>Gráfico de Ventas</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div>
        <label for="fechaInicio">Fecha de inicio:</label>
        <input type="date" id="fechaInicio">
        <label for="fechaFin">Fecha de fin:</label>
        <input type="date" id="fechaFin">
        <button onclick="filtrarVentas()">Filtrar</button>
    </div>
    <canvas id="ventasChart" width="400" height="200"></canvas>

    <script>
        var ventasData = {
            labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
            datasets: [{
                label: 'Ventas',
                data: [12, 19, 8, 15, 22, 10],
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };

        var chartOptions = {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad de Ventas'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Día'
                    }
                }
            }
        };

        var ventasChart = new Chart(document.getElementById('ventasChart'), {
            type: 'bar',
            data: ventasData,
            options: chartOptions
        });

        function filtrarVentas() {
            var fechaInicio = document.getElementById('fechaInicio').value;
            var fechaFin = document.getElementById('fechaFin').value;

            // Aquí puedes realizar la lógica para obtener los datos de ventas filtrados por fecha
            // y actualizar el gráfico con los nuevos datos

            // Ejemplo de actualización del gráfico con datos filtrados
            var ventasFiltradas = [10, 8, 6, 12, 15, 9];
            ventasChart.data.datasets[0].data = ventasFiltradas;
            ventasChart.update();
        }
    </script>
</body>
</html>