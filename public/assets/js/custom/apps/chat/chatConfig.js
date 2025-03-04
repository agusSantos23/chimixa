const totalMoneyLastMonthsText = document.getElementById('totalMoneyLastMonths');
const orders = ordersData || [];

const monthNames = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
const currentMonth = new Date().getMonth();
const monthsArray = [...Array(8)].map((_, i) => monthNames[(currentMonth - i + 12) % 12]).reverse();


const groupOrdersByDate = orders.reduce((acc, { created_at, type_element, price, amount }) => {
  const date = new Date(created_at);
  const monthYear = `${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, '0')}`;
  const parsedPrice = parseFloat(price) || 0;
  const parsedAmount = parseInt(amount) || 0;

  if (!acc[monthYear]) {
    acc[monthYear] = { Plate: 0, Menu: 0, PlateTotal: 0, MenuTotal: 0, PlateQty: 0, MenuQty: 0 };
  }

  if (acc[monthYear][type_element] !== undefined) {
    acc[monthYear][`${type_element}Qty`] += parsedAmount;
    acc[monthYear][`${type_element}Total`] += parsedPrice * parsedAmount;
  }

  return acc;
}, {});

const orderedMonthKeys = [...Array(8)].map((_, i) => {
  const date = new Date();
  date.setMonth(currentMonth - i);
  return `${date.getFullYear()}-${(date.getMonth() + 1).toString().padStart(2, '0')}`;
  
}).reverse();


const getMonthData = (key) => orderedMonthKeys.map(month => groupOrdersByDate[month]?.[key] || 0);

const platesData = getMonthData('PlateQty');
const menusData = getMonthData('MenuQty');
const platesTotal = getMonthData('PlateTotal');
const menusTotal = getMonthData('MenuTotal');

const totalMoney = [...platesTotal, ...menusTotal].reduce((acc, value) => acc + value, 0);
totalMoneyLastMonthsText.innerText = `${totalMoney} $`;

const chartDuoColumnsOptions = {
  series: [
    {
      name: 'Plates',
      data: platesData
    },
    {
      name: 'Menus',
      data: menusData
    }
  ],
  chart: {
    type: 'bar',
    height: 150
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '55%',
      borderRadius: 5
    }
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
    categories: monthsArray
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
      formatter: (val, { seriesIndex, dataPointIndex }) => {
        return `${(seriesIndex === 0 ? platesTotal : menusTotal)[dataPointIndex].toFixed(2)} $ Total for the month`
      }
    }
  }
  
};

new ApexCharts(document.querySelector("#chartDuoColumns"), chartDuoColumnsOptions).render();


const totalPlates = platesTotal.reduce((acc, value) => acc + value, 0);
const totalMenus = menusTotal.reduce((acc, value) => acc + value, 0);
const chartCircleData = [totalPlates, totalMenus];
const chartCircleLabels = ['Plates', 'Menus'];

const chartCircleOptions = {
  series: chartCircleData,
  chart: {
    width: 300,
    type: 'pie'
  },
  labels: chartCircleLabels,
  donut: {
    size: '60%'
  },
  responsive: [
    {
      breakpoint: 480,
      options: {
        chart: {
          width: 200
        },
        legend: {
          position: 'bottom'
        }
      }
    }
  ],
  colors: ['#ff6384', '#36a2eb'],
  dataLabels: {
    enabled: true,
    formatter: val => `${val.toFixed(2)} %`
  },
  tooltip: {
    enabled: false
  }
};

new ApexCharts(document.querySelector("#chartCircle"), chartCircleOptions).render();


const groupedByTypeAndPrice = orders.reduce((acc, { type_element, price, amount }) => {
  const parsedPrice = parseFloat(price) || 0;
  const parsedAmount = parseInt(amount) || 0;

  if (!acc[parsedPrice]) {
    acc[parsedPrice] = { Plate: 0, Menu: 0 };
  }

  acc[parsedPrice][type_element] += parsedAmount;

  return acc;
}, {});

const allPrices = [...new Set(orders.map(order => parseFloat(order.price)))].sort((a, b) => a - b);

const heatMapData = ['Menu', 'Plate'].map(type => {
  const row = allPrices.map(price => groupedByTypeAndPrice[price] ? groupedByTypeAndPrice[price][type] || 0 : 0);
  return { name: type, data: row };
});

const chartheatMapOptions = {
  series: heatMapData,
  chart: {
    height: 350,
    type: 'heatmap'
  },
  dataLabels: {
    enabled: false
  },
  colors: ["#FF6347", "#36A2EB", "#8BC34A", "#FFEB3B"],
  title: {
    text: undefined
  },
  xaxis: {
    categories: allPrices.map(price => `$${price.toFixed(2)}`)
  },
  yaxis: {
    categories: ['Menu', 'Plate'],
    title: {
      text: 'Element Type'
    }
  },
  tooltip: {
    y: {
      formatter: (val) => `${val} units sold`
    }
  }
};

new ApexCharts(document.querySelector("#chartHeatMap"), chartheatMapOptions).render();
