<template>
  <div>
    <panel title="แก้ไขรายการสั่งสินค้า">
      <edit-order-form />
    </panel>
    <panel title="แก้ไขรายการสินค้า">
      <edit-order-table />
      <b-row class="my-2 d-flex justify-content-end">
        <b-button
          v-ripple.400="'rgba(113, 102, 240, 0.15)'"
          variant="primary"
          class="mr-1"
          @click="editOrderData()"
        >
          <span class="align-middle">ยืนยันรายการ</span>
        </b-button>
        <b-button
          v-ripple.400="'rgba(113, 102, 240, 0.15)'"
          variant="danger"
          class="mr-1"
          :to="{ name: 'orderIndex', query: {} }"
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
import EditOrderForm from './components/EditOrderForm.vue'
import EditOrderTable from './components/EditOrderTable.vue'

export default {
  directives: {
    Ripple,
  },
  components: {
    EditOrderForm,
    EditOrderTable,
  },
  computed: {
    ...mapState('orderProduct', ['edit_order', 'order_detail']),
  },
  mounted() {
    this.setApi({ api: this.$http, self: this, refs: this.$refs })
  },
  methods: {
    ...mapActions('orderProduct', ['setApi', 'editOrderData']),
  },

}
</script>

<style>

</style>
