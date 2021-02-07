<template>
  <div>
    <b-form ref="orderForm">
      <validation-observer ref="orderForm">
        <b-row class="ml-1 mr-1">
          <b-col class="vselect">
            <vue-select
              v-model="temp.customer_data"
              :option="partners"
              title="title"
              label="คู่ค้า"
              rules="required"
            />
          </b-col>
          <b-col class="vselect">
            <vue-select
              v-model="temp.type"
              :option="type_data"
              title="name"
              label="ประเภทใบสั่งสินค้า"
              rules="required"
            />
          </b-col>
          <b-col v-if="disable === true">
            <form-input
              v-model="temp.selected.title"
              disabled
              label="ประเภทสินค้า"
              rules="required"
            />
          </b-col>
          <b-col v-else class="vselect">
            <vue-select
              v-model="temp.selected"
              :option="options"
              title="title"
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
    ...mapState('orderProduct', [
      'partners',
      'type_data',
      'options',
      'active_user',
      'temp',
      'disable',
    ]),
  },
  mounted() {
    this.setApi({ api: this.$http, self: this, refs: this.$refs })
    this.loadPartnerData()
    this.getSettingProducts()
    this.getLoginUser()
  },
  methods: {
    ...mapActions('orderProduct', [
      'setApi',
      'getSettingProducts',
      'loadPartnerData',
      'getLoginUser',
    ]),
  },
}
</script>

<style>
.vselect {
  padding-left: 15px;
  padding-right: 15px;
  padding-top: 18px;
}
</style>
