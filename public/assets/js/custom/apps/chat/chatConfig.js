const totalMoneyLastMonthsText = document.getElementById('totalMoneyLastMonths')

let orders = ordersData || [];

const monthNames = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
const currentMonth = new Date().getMonth(); 

const monthsArray = [0, 1, 2, 3, 4, 5, 6, 7].map(i => monthNames[(currentMonth - i + 12) % 12]).reverse();

const groupedOrders = orders.reduce((acc, order) => {
  const date = new Date(order.created_at);
  const monthYear = `${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, '0')}`;
  const type = order.type_element;
  const price = parseFloat(order.price) || 0;
  const amount = parseInt(order.amount) || 0;

  if (!acc[monthYear]) {
    acc[monthYear] = { "Plate": 0, "Menu": 0, "PlateTotal": 0, "MenuTotal": 0, "PlateQty": 0, "MenuQty": 0 };
  }

  if (acc[monthYear][type] !== undefined) {
    acc[monthYear][`${type}Qty`] += amount;
    acc[monthYear][`${type}Total`] += price * amount;
  }

  return acc;
}, {});

const orderedMonthKeys = [0, 1, 2, 3, 4, 5, 6, 7].map(i => {
  const date = new Date();
  date.setMonth(currentMonth - i); 
  return `${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, '0')}`;
}).reverse(); 

const platesData = orderedMonthKeys.map(month => groupedOrders[month]?.["PlateQty"] || 0);
const menusData = orderedMonthKeys.map(month => groupedOrders[month]?.["MenuQty"] || 0);
const platesTotal = orderedMonthKeys.map(month => groupedOrders[month]?.["PlateTotal"] || 0);
const menusTotal = orderedMonthKeys.map(month => groupedOrders[month]?.["MenuTotal"] || 0);

const totalMoney = [...platesTotal, ...menusTotal].reduce((acc, currentValue) => acc + currentValue, 0)
totalMoneyLastMonthsText.innerText =  `${totalMoney} $`

var options = {
  series: [{
    name: 'Plates',
    data: platesData
  }, {
    name: 'Menus',
    data: menusData
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
      text: 'AMOUNT'
    }
  },
  fill: {
    opacity: 1
  },
  tooltip: {
    y: {
      formatter: function (val, { seriesIndex, dataPointIndex }) {
        const total = seriesIndex === 0 ? platesTotal[dataPointIndex] : menusTotal[dataPointIndex];
        return `$${(total || 0).toFixed(2)} Total for the month`;
      }
    }
  }
};

var chart = new ApexCharts(document.querySelector("#chartDuoColumns"), options);
chart.render();
