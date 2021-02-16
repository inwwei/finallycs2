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
            text: ' ราคา (บาท)',
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
    }
  },

  computed: {

  },
  mounted() {
    this.loadData()
  },
  methods: {

    async loadData() {
      try {
        const { data: { data: RESULT } } = await this.$http.get('/api/Charts')
        await RESULT.forEach(item => {
          this.option.xaxis.categories.push(item.date)
          this.series[0].data.push(item.max_price)
        })
      } catch (error) {
        console.log(error)
      }
    },
  },
}
</script>
<style  scoped>
label{
    font-size: larger;
}
</style>
