<template>
  <div>
    <panel title="ระบบขายสินค้า">
      <b-row>
        <div class="demo-inline-spacing mb-1">
          <b-form-radio
            v-model="selected"
            name="some-radios"
            value="ลูกค้าสมาชิก"
          >
            ลูกค้าสมาชิก
          </b-form-radio>
          <b-form-radio
            v-model="selected"
            name="some-radios"
            value="ลูกค้าทั่วไป"
          >
            ลูกค้าทั่วไป
          </b-form-radio>
        </div>
      </b-row>
      <div v-if="selected ==='ลูกค้าสมาชิก'">
        <b-form>
          <validation-observer ref="simpleRules">
            <b-row>
              <form-input
                v-model="user.name"
                disabled
                col="4"
                label="ชื่อผู้ขาย"
                placeholder="ชื่อผู้ขาย"
                rules="required"
              />
              <b-col
                md="4"
              >
                <b-form-group>
                  <label for="example-datepicker">วันที่ขายสินค้า</label>
                  <b-form-datepicker
                    v-model="value"
                    :min="min"
                    :max="max"
                    placeholder="เลือกวันที่"
                    locale="th"
                  />
                </b-form-group>
              </b-col>
              <b-col
                md="4"
                class="my-2"
              >
                <vue-select
                  v-model="form.customer"
                  :option="customers"
                  label="ลูกค้า"
                  title="customer_name"
                />
              </b-col>
            </b-row>
          </validation-observer>
        </b-form>
      </div>
      <div v-else>
        <b-form>
          <validation-observer ref="simpleRules">
            <b-row>
              <form-input
                v-model="user.name"
                disabled
                col="4"
                label="ชื่อผู้ขาย"
                placeholder="ชื่อผู้ขาย"
                rules="required"
              />
              <b-col
                md="4"
              >
                <b-form-group>
                  <label for="example-datepicker">วันที่ขายสินค้า</label>
                  <b-form-datepicker
                    v-model="value"
                    :min="min"
                    :max="max"
                    placeholder="เลือกวันที่"
                    locale="th"
                  />
                </b-form-group>
              </b-col>
              <form-input
                v-model="customer_general.customer_name"
                col="4"
                label="ชื่อลูกค้า"
                placeholder="ชื่อลูกค้า"
                rules="required"
              />
              <form-input
                v-model="customer_general.value"
                col="4"
                label="เบอร์ติดต่อ"
                placeholder="เบอร์ติดต่อ"
                rules="required"
              />
              <form-input
                v-model="customer_general.address"
                col="4"
                label="ที่อยู่"
                placeholder="ที่อยู่"
                rules="required"
              />
            </b-row>
          </validation-observer>
        </b-form>
      </div>
    </panel>
    <b-row>
      <sale-product />
      <sale-product-table />
    </b-row>
  </div>

</template>
<script>
import { mapActions, mapState } from 'vuex'

export default {
  components: {
    SaleProduct: () => import('./components/SaleProduct'),
    SaleProductTable: () => import('./components/SaleProductTable'),
  },
  data() {
    const now = new Date()
    const today = new Date(now.getFullYear(), now.getMonth(), now.getDate())
    // 15th two months prior
    const minDate = new Date(today)
    minDate.setMonth(minDate.getMonth())
    minDate.setDate(today.getDate())
    // 15th in two months
    const maxDate = new Date(today)
    maxDate.setMonth(maxDate.getMonth() + 2)
    maxDate.setDate(15)
    return {
      selected: 'ลูกค้าสมาชิก',
      value: now,
      min: minDate,
      max: maxDate,
    }
  },
  watch: {
    selected(val) {
      this.setSelected(val)
    },
  },
  computed: {
    ...mapState('saleProduct', ['form', 'customers', 'user', 'customer_general', 'language', 'languages', 'customer_type']),
  },
  mounted() {
    this.setApi({ api: this.$http, self: this })
    this.loadCustomer()
    this.setUserId()
    setTimeout(() => {
      this.loadUser()
    }, 350)
  },
  methods: {
    ...mapActions('saleProduct', ['loadCustomer', 'loadUser', 'setApi', 'setUserId']),
  },

}
</script>
