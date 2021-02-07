<template>
  <div>
    <panel title="รายละเอียดใบสั่งซื้อ">
      <add-order-form />
    </panel>
    <panel title="รายละเอียดสินค้า">
      <add-order-table />
      <b-row class="my-2 d-flex justify-content-end">
        <b-button
          v-ripple.400="'rgba(113, 102, 240, 0.15)'"
          variant="primary"
          class="mr-1"
          @click="addOrder()"
        >
          <span class="align-middle">ยืนยันรายการ</span>
        </b-button>
        <b-button
          v-ripple.400="'rgba(113, 102, 240, 0.15)'"
          variant="danger"
          class="mr-1"
          @click="clearOrder()"
        >
          <span class="align-middle">ย้อนกลับ</span>
        </b-button>
      </b-row>
    </panel>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'
import Ripple from 'vue-ripple-directive'
import Panel from '@/@core/components/Panel.vue'
import AddOrderForm from './components/AddOrderForm.vue'
import AddOrderTable from './components/AddOrderTable.vue'

export default {
  directives: {
    Ripple,
  },
  components: { Panel, AddOrderForm, AddOrderTable },
  computed: {
    ...mapState('orderProduct', ['form']),
  },
  mounted() {
    this.setApi({ api: this.$http, self: this, refs: this.$refs })
  },
  methods: {
    ...mapActions('orderProduct', ['setApi', 'addOrder', 'clearOrder']),
  },
}
</script>

<style>
</style>
