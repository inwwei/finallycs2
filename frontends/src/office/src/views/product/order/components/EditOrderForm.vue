<template>
  <div>
    <b-form>
      <validation-observer ref="orderEditForm">
        <b-row>
          <b-col>
            <form-input
              v-model="edit_order.code_ref"
              label="รหัสยืนยันใบสั่งสินค้า"
              rules="required"
            />
          </b-col>
          <b-col>
            <form-input
              v-model="edit_order.setting_master_customer.title"
              disabled
              label="คู่ค้า"
              rules="required"
            />
          </b-col>
          <b-col class="vselect">
            <vue-select
              v-model="edit_order.type"
              :option="type_data"
              title="name"
              label="ประเภทใบสั่งสินค้า"
              rules="required"
            />
          </b-col>
          <b-col>
            <form-input
              v-model="edit_order.setting_master_product.title"
              disabled
              label="ประเภทสินค้า"
              rules="required"
            />
          </b-col>
        </b-row>
      </validation-observer>
    </b-form>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'
import Ripple from 'vue-ripple-directive'

export default {
  directives: {
    Ripple,
  },
  computed: {
    ...mapState('orderProduct', ['edit_order', 'partners', 'type_data']),
  },
  mounted() {
    this.setApi({ api: this.$http, self: this, refs: this.$refs })
    this.setId(this.$route.query.id)
    this.queryOrderData()
    this.loadPartnerData()
  },
  methods: {
    ...mapActions('orderProduct', [
      'setApi',
      'setId',
      'queryOrderData',
      'loadPartnerData',
    ]),
  },
}
</script>

<style>
.vselect {
  padding-left: 12px;
  padding-right: 12px;
  padding-top: 25px;
}
</style>
