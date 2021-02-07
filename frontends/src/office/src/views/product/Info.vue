<template>
  <b-card>
    <b-card-title>ข้อมูลสินค้า</b-card-title>
    <br>
    <b-row>
      <b-col
        cols="12"
        xl="7"
      >
        <table class="mt-2 mt-xl-0 w-100 info mb-2">
          <tr>
            <th class="pb-50">
              <span class="font-weight-bold">ชื่อ (TH)(EN) :</span>
            </th>
            <td class="pb-50">
              {{ product_info.name }}
            </td>

            <th class="pb-50">
              <span class="font-weight-bold">รหัส :</span>
            </th>
            <td class="pb-50 text-capitalize">
              {{ product_info.setting_master_product.code }}
            </td>

            <th class="pb-50">
              <span class="font-weight-bold">รายละเอียด :</span>
            </th>
            <td class="pb-50">
              {{ product_info.description }}
            </td>
          </tr>
          <tr>
            <th>
              <span class="font-weight-bold">ราคาส่ง :</span>
            </th>
            <td>
              {{ product_info.wholesale_price }} {{ "บาท" }}
            </td>

            <th>
              <span class="font-weight-bold">ราคาปลีก :</span>
            </th>
            <td>
              {{ product_info.retail_price }} {{ "บาท" }}
            </td>

            <th>
              <span class="font-weight-bold">แท๊ก :</span>
            </th>
            <td>
              {{ product_info.tags }}
            </td>
          </tr>
        </table>
      </b-col>
      <b-col
        cols="21"
        xl="5"
        class="d-flex justify-content-between flex-column"
      />
    </b-row>
    <b-row>
      <b-button
        :to="{ name: 'productIndex', params: {} }"
        variant="primary"
        class="ml-1"
      >

        ย้อนกลับ
      </b-button>
    </b-row>
    <!-- <pre>{{ product_info }}</pre> -->
  </b-card>
</template>

<script>
import { mapState, mapActions } from 'vuex'
import store from '@/store/index'

export default {
  computed: {
    ...mapState('product', ['product_info', 'product_id', 'products']),
  },
  methods: {
    ...mapActions('product', ['setApi', 'setId', 'queryProductInfo']),
  },
  mounted() {
    this.setId(this.$route.query.id)
    this.setApi({ api: this.$http, self: this, refs: this.$refs })
    this.queryProductInfo()
  },
}
</script>

<style scoped>
.info {
  font-size: 16px;
}
label{
   font-size:inherit
}
</style>
