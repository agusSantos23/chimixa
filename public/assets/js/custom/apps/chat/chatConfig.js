

const monthNames = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
const currentMonth = new Date().getMonth()
let monthsArray = []

for (let i = 0; i < 8; i++) {
  const monthIndex = (currentMonth - i + 12) % 12
  monthsArray.unshift(monthNames[monthIndex])
}



var options = {
  series: [{
  name: 'Platos',
  data: [44, 55, 30, 40, 55, 58, 52, 60]
}, {
  name: 'Menus',
  data: [20, 50, 40, 50, 30, 50, 10, 50]
}],
  chart: {
  type: 'bar',
  height: 150
},
plotOptions: {
  bar: {
    horizontal: false,
    columnWidth: '55%',
    borderRadius: 5,
    borderRadiusApplication: 'end'
  },
},
dataLabels: {
  enabled: false
},
stroke: {
  show: true,
  width: 2,
  colors: ['transparent']
},
xaxis: {
  categories: monthsArray,
},
yaxis: {
  title: {
    text: 'CANTIDAD'
  }
},
fill: {
  opacity: 1
},
tooltip: {
  y: {
    formatter: function (val) {
      return val + "$ Total del mes"
    }
  }
}
}

var chart = new ApexCharts(document.querySelector("#chartDuoColumns"), options)
chart.render()