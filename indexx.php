<!DOCTYPE html>
<html>
<head>
    <title>Consulta de Productos por Fecha</title>
</head>
<body>
    <h1>Consulta de Productos por Fecha</h1>
    <form id="consultaForm">
        <label for="fechaInicio">Fecha de inicio:</label>
        <input type="date" id="fechaInicio" name="fechaInicio" required>
        <label for="fechaFin">Fecha de fin:</label>
        <input type="date" id="fechaFin" name="fechaFin" required>
        <button type="submit" id="btnConsultar">Consultar</button>
    </form>

    <div id="resultado">
        <!-- Aquí se mostrará la tabla con los productos -->
    </div>

    <script>
        document.getElementById("consultaForm").addEventListener("submit", function (event) {
            event.preventDefault();
            const fechaInicio = document.getElementById("fechaInicio").value;
            const fechaFin = document.getElementById("fechaFin").value;
            obtenerProductosPorFecha(fechaInicio, fechaFin);
        });

        function obtenerProductosPorFecha(fechaInicio, fechaFin) {
            fetch(`consulta.php?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`)
                .then(response => response.json())
                .then(data => mostrarProductos(data.productos))
                .catch(error => console.error('Error al obtener los datos:', error));
        }

        function mostrarProductos(productos) {
            const resultadoDiv = document.getElementById("resultado");
            resultadoDiv.innerHTML = "";

            if (productos.length === 0) {
                resultadoDiv.textContent = "No se encontraron productos en las fechas seleccionadas.";
                return;
            }

            const table = document.createElement("table");
            table.classList.add("table-auto", "w-full", "border", "border-gray-300", "text-center");

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
                tdPrecio.textContent = producto.precio;
                tdPrecio.classList.add("px-4", "py-2", "border", "border-gray-300");

                tr.appendChild(tdNombre);
                tr.appendChild(tdPrecio);
                tbody.appendChild(tr);
            });

            table.appendChild(thead);
            table.appendChild(tbody);
            resultadoDiv.appendChild(table);
        }
    </script>
</body>
</html>