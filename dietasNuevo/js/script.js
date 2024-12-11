const ctx = document.getElementById('chartIngresos');
new Chart(ctx, {
    type: 'line',
    data: {
      labels: [
        'Enero',    'Febrero', 'Marzo', 
        'Abril',    'Mayo',     'Junio',
        'Julio',    'Agosto',   'Septiembre',
        'Octubre',  'Noviembre', 'Diciembre',
    ],
    datasets: [{
        label: 'Ganancias por mes',
        data: [
            30000,25625,12451, 32254, 12505, 12458,
            78954,45785,13578, 89457, 45725, 124555,

        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

const ctx2 = document.getElementById('chartCategorias');
new Chart(ctx2, {
    type: 'pie',
    data: {
      labels: [
        'Desayunos', 'Comidas', 'Cenas', 'Snacks',   
    ],
    datasets: [{
        label: 'Dietas por categorias',
        data: [20,25,30,10],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });