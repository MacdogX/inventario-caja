<!DOCTYPE html>
<html>
<head>
<style>
  table {
    border-collapse: collapse;
    width: 100%; /* Ajusta el ancho de la tabla según tus necesidades */
  }

  table, th, td {
    border: 1px solid black; /* Agrega bordes a la tabla, encabezados y celdas */
    padding: 8px; /* Espacio interno para mejorar la legibilidad */
  }

  td {
    white-space: nowrap; /* Impide que los datos se envuelvan */
    overflow: hidden; /* Oculta el contenido que desborda */
    text-overflow: ellipsis; /* Agrega puntos suspensivos (...) si el contenido es demasiado ancho */
  }
  .table-wrapper {
    width: 100%;
    /* max-width: 500px; */
    overflow-x: auto;
  }
</style>
</head>
<body>
<div  class="table-wrapper" >
<table>
  <tr>
    <th>Columna 1</th>
    <th>Columna 2</th>
    <th>Columna 3</th>
  </tr>
  <tr>
    <td>Dato largo que se ajustará automáticamente al ancho de la columna</td>
    <td>Otro dato largo que se ajustará automáticamente al ancho de la columna</td>
    <td>Este también se ajustará automáticamente</td>
  </tr>
</table>
</div>
</body>
</html>