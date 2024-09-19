<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
     // , {
     //                name: 'series2',
     //                data: [11, 32, 45, 32, 34, 52, 41]
     //           }

     const getUserPreferredScheme = () => {
          return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
     };

     const userScheme = getUserPreferredScheme();

     let options = {
          series: [
               {
                    name: 'Registered students',
                    data: [31, 40, 28, 51, 42, 10, 89]
               }
          ],
          chart: {
               height: 350,
               type: 'area',
               background: userScheme === 'dark' ? '#374151' : '#ffffff',
               foreColor: userScheme === 'dark' ? '#ffffff' : '#333333',
          },
          dataLabels: {
               enabled: false
          },
          colors: ['#ff0000'],
          markers: {
               colors: [userScheme === 'dark' ? '#F59E0B' : '#F44336']
          },
          fill: {
               colors: ['#ff0000']
          },
          stroke: {
               curve: 'smooth'
          },
          xaxis: {
               categories: ['a', 'b', 'c', 'd', 'e', 'f', 'g']
          },
          tooltip: {
               theme: userScheme,
          },
     };

     const chart = new ApexCharts(document.querySelector("#chart-area"), options);
     chart.render();
</script>