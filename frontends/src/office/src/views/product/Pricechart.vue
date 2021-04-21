<template>
  <div>
    <panel>
      <validation-observer ref="simpleRules">
        <b-row class="ml-1 mr-1">
          <b-col
            class="tree"
          >
            <!-- <pre>{{ form.Plant_select.title }}</pre> -->
            <label>เลือกพืช</label>
            <vue-select
              v-model="form.Plant_select"
              :option="selected"
              title="title"
              col="4"
            />
          </b-col>

        </b-row>
        <b-row class="my-2 d-flex justify-content-end">
          <b-button
            v-ripple.400="'rgba(113, 102, 240, 0.15)'"
            v-b-modal.modal-success
            variant="primary"
            class="mr-1"
            @click="loadData()"
          >
            <span class="align-middle">ยืนยัน</span>
          </b-button>
        </b-row>
      </validation-observer></panel>
    <b-card>

      <b-card-body>
        <vue-apex-charts
          ref="testharts"
          type="bar"
          height="350"
          :options="option"
          :series="series"
        />
      </b-card-body>
    </b-card>
  </div>
</template>

<script>
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
      selected: [
        { title: 'พริกสดชี้ฟ้า' },
        { title: 'ข้าวหอมมะลิ 100% ชั้น 1' },
        { title: 'ข้าวโพดฝักอ่อน' },
      ],
      form: {
        Plant_select: '',
        first_date: '',
        end_date: '',
      },
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
    // this.loadData()
  },
  methods: {

    async loadData() {
      try {
        const { data: { data: RESULT } } = await this.$http.post(`/api/Charts/${this.form.Plant_select.title}`, this.form)
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
