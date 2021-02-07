<template>
  <div>
    <b-card id="invoice-container">
      <b-row>
        <b-col
          class="my-5"
          cols="4"
        >
          <img
            src="https://iseki.co.th/wp-content/uploads/2018/06/2000px-Iseki_company_logo.svg.png"
            width="80%"
            alt="logo"
          >
        </b-col>
        <b-col cols="6">
          <h4>{{ iseki.name }}</h4>
          <b>Tex ID :</b> <span>{{ iseki.tex_id }}</span><br>
          <b>Address :</b> <span>{{ iseki.title }}</span><br>
          <b>Tel :</b><span>{{ iseki.tel }}</span><br><br>
          <h4>{{ partner.name_en }}</h4>
          <b>Tex ID :</b> <span>{{ partner.customer.tax_id }}</span><br>
          <div v-if="partner_contacts.title !== null">
            <b>Address :</b> <span v-if="partner_contacts.title">{{ partner_contacts.title }}</span><br>
            <b>Tel :</b>
          </div>
          <div v-if="partner_contacts.value !== null">
            <b>Address :</b>
            <b>Tel :</b> <span>{{ partner_contacts.value }}</span>
          </div>
        </b-col>
        <b-col
          cols="2"
          style="text-align: center"
        >
          <p><b>Date : </b>{{ order.date }}</p>
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
      <b-row>
        <b-col>
          <b>Subject</b>
          <div
            v-if="order.type === 'ประจำเดือน'"
          >
            <b-form-checkbox
              v-model="checked"
              disabled
            ><b>Tractor and Imprement order</b></b-form-checkbox>
            <b-form-checkbox disabled>
              <b>Urgent order</b>
            </b-form-checkbox>
          </div>
          <div v-if="order.type === 'เร่งด่วน'">
            <b-form-checkbox
              disabled
            ><b>Tractor and Imprement order</b></b-form-checkbox>
            <b-form-checkbox
              v-model="checked"
              disabled
            ><b>Urgent order</b></b-form-checkbox>
          </div>
        </b-col>
      </b-row>
      <hr>
      <b-row>
        <b-col class="d-flex justify-content-center">
          <h5><b>Firm order (ใบสั่งซื้อ)</b></h5>
        </b-col>
      </b-row>
      <b-row class="ml-1 mr-1">
        <b-table
          :fields="columns_report"
          :items="order_details"
        /><br>
      </b-row>
      <b-row class="ml-3">
        <b-col cols="8">
          <b>Total price</b>
        </b-col>
        <b-col cols="4">
          <p style="padding-left:70px;">
            {{ order.total_price }}
          </p>
        </b-col>
      </b-row>
      <hr>
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
          <b>Date : </b><span> {{ order.date }}</span>
        </b-col>
      </b-row>
      <br>
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
        v-if="order.print==='ไม่สำเร็จ'"
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
import { mapState, mapActions } from 'vuex'
import { BTable } from 'bootstrap-vue'
import Ripple from 'vue-ripple-directive'

export default {
  components: {
    BTable,
  },
  directives: {
    Ripple,
  },
  computed: {
    ...mapState('orderProduct', ['edit', 'type', 'iseki', 'order', 'partner', 'partner_contacts', 'order_details', 'columns_report', 'checked']),
  },
  mounted() {
    this.setApi({ api: this.$http, self: this, refs: this.$refs })
    this.setId(this.$route.query.id)
    this.loadOrderData()
    this.loadOrderDetails()
    this.loadIsekiContact()
  },
  methods: {
    ...mapActions('orderProduct', ['setApi', 'setId', 'loadOrderData', 'loadOrderDetails', 'loadIsekiContact', 'printCopyInvoice', 'printOriginalInvoice', 'print']),
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
