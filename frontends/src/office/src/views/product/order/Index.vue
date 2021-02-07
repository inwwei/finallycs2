<template>
  <div>
    <panel title="รายการสั่งสินค้า">
      <index-order-table />
    </panel>

  </div>
</template>

<script>
import IndexOrderTable from './components/IndexOrderTable.vue'

export default {
  components: {
    IndexOrderTable,
  },

}
</script>

<style>

</style>
