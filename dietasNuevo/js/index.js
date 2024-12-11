const ctx = document.getElementById('chartIngresos');
new Chart(ctx, {
  type: 'line',
  data: {
    labels: [
        'Enero', 'Febrero', 'Marzo', 'Abril', 
        'Mayo', 'Junio','Julio','Agosto','Septiembre',
        'Octubre','Noviembre','Diciembre'
    ],
    datasets: [{
        label: 'Ingresos por mes',
        data: [
            200000, 300000, 400000, 500000, 205000,304000, 
            200000, 400000, 100000, 300000, 25000,4000, 
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

const ctx1 = document.getElementById('chartCategorias');
new Chart(ctx1, {
  type: 'pie',
  data: {
    labels: ['Desayunos', 'Comidas', 'Cenas', 'Snacks'],
    datasets: [{
      label: '# of Votes',
      data: [12, 19, 3, 5],
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
