
// Define un array de colores para cada barra
var colores = [

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
];

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
        backgroundColor: colores, // Color de las barras
        borderColor: 'rgba(0, 123, 255, 1)', // Color del borde de las barras
        borderWidth: 1, // Ancho del borde de las barras
        indexLabelFontSize: 20
      }]
    },
    options: {
      responsive: true,
      scales: {
        x: {
          beginAtZero: true, // Comenzar el eje x desde cero
          ticks: {
            font: {
              size: 18, // Ajustar el tamaño de la fuente en el eje x
              family: 'Lato', // Cambiar el tipo de fuente
            
              style:'normal'
            },
            maxRotation: 80, // Rotar las etiquetas en un ángulo de 45 grados
            minRotation: 80 // Rotar las etiquetas en un ángulo de 45 grados
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
          fontSize: 16 // Tamaño de la letra del título
        }
      },
      // Ajusta el ancho de las barras
      barPercentage: 0.8, // Controla el ancho de las barras
      categoryPercentage: 0.8, // Controla el espacio entre las barras
      // Ajustes para el cuadro de información al pasar el mouse sobre las barras
      hover: {
        mode: 'nearest',
        intersect: true
      },
      tooltips: {
        mode: 'index',
        intersect: false,
        titleFontSize: 18, // Tamaño de la fuente del título del cuadro
        bodyFontSize: 18, // Tamaño de la fuente del contenido del cuadro
        bodySpacing: 8, // Espaciado entre líneas en el cuadro
        padding: 12, // Padding del cuadro
        displayColors: false // No mostrar los cuadros de color de la leyenda
      }
    }
  });