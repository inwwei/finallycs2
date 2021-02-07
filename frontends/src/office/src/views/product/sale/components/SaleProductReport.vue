<template>
  <div>
    <b-card id="invoice-container">
      <b-row>
        <b-col
          class="my-5"
          cols="5"
        >
          <img
            src="https://iseki.co.th/wp-content/uploads/2018/06/2000px-Iseki_company_logo.svg.png"
            width="80%"
            alt="logo"
          >
        </b-col>
        <b-col cols="4">
          <h4>{{ iseki.name }}</h4>
          <b>Tex ID :</b> <span>{{ iseki.tex_id }}</span><br>
          <b>Address :</b> <span>{{ iseki.title }}</span><br>
          <b>Tel :</b><span>{{ iseki.tel }}</span><br><br>
          <h4>{{ customerData.customer_name }}</h4>
          <b>tax_id :</b> <span>{{ customerData.tax_id }}</span><br>
          <b>Address :</b> <span>{{ reportTitle }}</span><br>
          <b>Tel :</b> <span>{{ reportValue }}</span>
        </b-col>
        <b-col
          cols="2"
          style="text-align: center"
        >
          <p><b>Date : </b>{{ saleProductData.date }}</p>
          <br>
          <div>
            <div v-if="type === 'original'">
              <h4>ต้นฉบับ</h4>
              <h6>ORIGINAL</h6>
            </div>
            <div v-if="type === 'copy'">
              <h4>สำเนา</h4>
              <h6>COPY</h6>
            </div>
          </div>
        </b-col>
      </b-row>
      <hr>
      <b-row>
        <b-col class="d-flex justify-content-center">
          <p> <b>ใบเสร็จรับเงิน</b><br>(RECEIPT)</p>
        </b-col>
      </b-row>
      <b-row class="ml-1 mr-1">
        <b-table
          :fields="columns_report"
          :items="saleProductDetail"
        /><br>
      </b-row>
      <b-row class="ml-1 mr-1">
        <b>Payment medthod</b>
      </b-row>
      <hr><br>
      <b-row class="ml-1">
        <b-col cols="1">
          <b>ผู้สั่งซื้อ</b>
        </b-col>
        <b-col cols="3">
          <hr>
        </b-col>
        <b-col cols="2">
          <b>ประทับตราบริษัท</b>
        </b-col>
        <b-col cols="3">
          <hr>
        </b-col>
        <b-col cols="3">
          <b>Date : </b><span />
        </b-col>
      </b-row>
      <div class="border border-dark mt-3">
        <b-row class="ml-1 mr-1 mt-1">
          <b-col cols="3">
            <b>Acknowledged by</b>
          </b-col>
          <b-col cols="9">
            <hr>
          </b-col>
        </b-row>
        <b-row class="ml-1 mr-1 mt-1">
          <b-col cols="3">
            <b>referrence number</b>
          </b-col>
          <b-col cols="4">
            <hr>
          </b-col>
          <b-col cols="1">
            <b>Date</b>
          </b-col>
          <b-col cols="4">
            <hr>
          </b-col>
        </b-row>
        <b-row class="ml-1 mr-1 mt-1 mb-1">
          <b-col cols="2">
            <b>Remarks</b>
          </b-col>
          <b-col cols="10">
            <hr>
          </b-col>
        </b-row>
      </div>
    </b-card>
    <b-row class="my-2 d-flex justify-content-end mb-5">
      <b-button
        v-if="saleProductData.print ==='ไม่สำเร็จ'"
        v-ripple.400="'rgba(113, 102, 240, 0.15)'"
        variant="primary"
        class="mr-1"
        @click="print()"
      >
        <span class="align-middle">พิมพ์ต้นฉบับ</span>
      </b-button>
      <b-button
        v-ripple.400="'rgba(113, 102, 240, 0.15)'"
        variant="primary"
        class="mr-1"
        @click="printCopyInvoice()"
      >
        <span class="align-middle">พิมพ์สำเนา</span>
      </b-button>
      <b-button
        v-ripple.400="'rgba(113, 102, 240, 0.15)'"
        variant="danger"
        class="mr-1"
        :to="{name:'orderIndex'}"
      >
        <span class="align-middle">ยกเลิก</span>
      </b-button>
    </b-row>
  </div>
</template>
<script>
import { mapActions, mapState } from 'vuex'
import store from '@/store/index'
import Ripple from 'vue-ripple-directive'

export default {
  directives: {
    Ripple,
  },
  data() {
    return {
      dir: false,
      searchTerm: '',
    }
  },
  computed: {
    ...mapState('printSaleProduct', ['saleProductData', 'type', 'saleProductDetail', 'pageLength', 'iseki', 'customerData', 'reportTitle', 'reportValue', 'columns_report']),
    direction() {
      if (store.state.appConfig.isRTL) {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.dir = true
        return this.dir
      }
      // eslint-disable-next-line vue/no-side-effects-in-computed-properties
      this.dir = false
      return this.dir
    },
  },
  methods: {
    ...mapActions('printSaleProduct', ['loadSaleProductDetail', 'setId', 'loadCustomerContact', 'setApi', 'loadSaleDetails', 'loadIsekiContact', 'print', 'printCopyInvoice', '']),
    customerValue(address) {
      const value = address.find(
        address => address.value,
      )
      return value.value
    },
  },
  mounted() {
    this.setApi({ api: this.$http, self: this })
    this.loadSaleProductDetail(this.$route.query.id)
    this.loadSaleDetails()
    this.loadIsekiContact()
    setTimeout(() => {
      this.loadCustomerContact()
    }, 300)
  },
}
</script>
<style lang="scss">
b {
  font-size: 16px;
}
p {
  font-size: 14px;
}

@media print {
  body * {
    visibility: hidden;
  }
    #content-area {
      margin: 0 !important;
    }
    #invoice-container,
    #invoice-container * {
      visibility: visible;
    }
    #invoice-container {
      position: absolute;
      left: 0;
      top: 0;
      box-shadow: none;
    }
}
</style>
