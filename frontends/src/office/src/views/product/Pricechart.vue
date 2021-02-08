<template>
  <b-card>
    <b-card-body>
      <vue-apex-charts
        ref="testharts"
        type="bar"
        height="350"
        :options="option"
        :series="series"
      />

      <!-- <vue-apex-charts
        ref="testharts"
        type="bar"
        height="350"
        :options="option"
        :series="series"
      /> -->

      <!-- <vue-apex-charts
        type="area"
        height="650"
        :options="lineAreaChartSpline.chartOptions"
        :series="lineAreaChartSpline.series"
      /> -->
    </b-card-body>
  </b-card>
</template>

<script>
// import { mapState, mapActions } from 'vuex'

// import Ripple from 'vue-ripple-directive'
import {
  BCard, BCardBody,
} from 'bootstrap-vue'
import VueApexCharts from 'vue-apexcharts'

const chartColors = {

  area: {
    series3: '#a4f8cd',
    series2: '#60f2ca',
    series1: '#2bdac7',
  },
}

export default {
  components: {
    BCard,
    VueApexCharts,
    BCardBody,
  },
  directives: {
    // Ripple,
  },
  data() {
    return {
      dir: false,
      searchTerm: '',
      option: {
        colors: ['#7367F0', '#28C76F', '#EA5455', '#FF9F43', '#1E1E1E'],
        plotOptions: {
          bar: {
            horizontal: false,
            endingShape: 'rounded',
            columnWidth: '50%',
          },
        },
        dataLabels: {
          enabled: false,
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent'],
        },
        xaxis: {
          categories: [],
          convertedCatToNumeric: false,
        },
        yaxis: {
          title: {
            text: '$ (thousands)',
          },
        },
        fill: {
          opacity: 1,
        },
        tooltip: {
          y: {},
        },
      },
      series: [
        {
          name: 'Sales',
          data: [],
        },
      ],
    //   lineAreaChartSpline: {
    //     // series: [
    //     //   {
    //     //     name: 'Sales',
    //     //     data: [],
    //     //   },
    //     // ],
    //     chartOptions: {
    //       chart: {
    //         toolbar: {
    //           show: false,
    //         },
    //       },
    //       dataLabels: {
    //         enabled: false,
    //       },
    //       stroke: {
    //         show: false,
    //         curve: 'straight',
    //       },
    //       legend: {
    //         show: true,
    //         position: 'top',
    //         horizontalAlign: 'left',
    //         fontSize: '14px',
    //         fontFamily: 'Montserrat',
    //       },
    //       grid: {
    //         xaxis: {
    //           lines: {
    //             show: true,
    //           },
    //         },
    //       },
    //       xaxis: {
    //         categories: [],
    //       },
    //       yaxis: {
    //         // opposite: isRtl
    //       },
    //       fill: {
    //         opacity: 1,
    //         type: 'solid',
    //       },
    //       tooltip: {
    //         shared: false,
    //       },
    //       colors: [chartColors.area.series3, chartColors.area.series2, chartColors.area.series1],
    //     },
    //   },
    }
  },

  computed: {

    // ...mapState('product', ['test', 'products', 'columns', 'pageLength']),
    // direction() {
    //   if (this.$store.state.appConfig.isRTL) {
    //     // eslint-disable-next-line vue/no-side-effects-in-computed-properties
    //     this.dir = true
    //     return this.dir
    //   }
    //   // eslint-disable-next-line vue/no-side-effects-in-computed-properties
    //   this.dir = false
    //   return this.dir
    // },
  },
  mounted() {
    this.loadData()
    // this.setApi({ api: this.$http, self: this, refs: this.$refs })
    // this.getData()
  },
  methods: {

    // async loadDatasss() {
    //   try {
    //     const { data: { data: RESULT } } = await this.$http.get('/api/test_chart')
    //     for (const index in RESULT) {
    //       this.option.xaxis.categories.push(RESULT[index].name)
    //       this.series[0].data.push(RESULT[index].value)
    //     }
    //     this.$refs.testharts.refresh()
    //     console.log('================================')
    //   } catch (error) {
    //     throw error
    //   }
    // },

    async loadData() {
      try {
        const { data: { data: RESULT } } = await this.$http.get('/api/Charts')
        console.log(this.option)
        console.log(this.series)
        RESULT.forEach(item => {
        //   this.lineAreaChartSpline.chartOptions.xaxis.categories.push(item.date)
        //   this.lineAreaChartSpline.series[0].data.push(item.max_price)
          this.option.xaxis.categories.push(item.date)
          this.series[0].data.push(item.max_price)
        })

        //   this.option.xaxis.categories.push(RESULT[keys].name)
        //   this.series[0].data.push(RESULT[keys].value)
        // })

        // Object.keys(RESULT).forEach(keys => {
        //   this.option.xaxis.categories.push(RESULT[keys].name)
        //   this.series[0].data.push(RESULT[keys].value)
        // })

        // console.log(RESULT)
      } catch (error) {
        console.log(error)
      }
    },
    // ...mapActions('product', ['setApi', 'getData', 'queryProductInfo', 'infoProduct', 'deleteProduct', 'editProduct']),
  },
}
</script>
<style  scoped>
label{
    font-size: larger;
}
</style>
