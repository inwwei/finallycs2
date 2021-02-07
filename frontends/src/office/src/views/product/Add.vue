<template>
  <panel title="เพิ่มข้อมูลสินค้า">
    <b-form>
      <validation-observer ref="simpleRules">
        <b-row class="ml-1 mr-1">
          <b-col class="tree">
            <custom-tree-select
              ref="tree"
              v-model="data"
              url="/api/setting/master/product"
              @node-select="typeProduct"
            />
          </b-col>

          <form-input
            v-model="form.setting_master_product.name_th"
            col="4"
            label="ชื่อสินค้า(TH)"
            placeholder="ชื่อสินค้า(TH)"
            rules="required"
          />

          <form-input
            v-model="form.setting_master_product.name_en"
            col="4"
            label="ชื่อสินค้า(EN)"
            placeholder="ชื่อสินค้า(EN)"
            rules="required"
          />

        </b-row>
        <b-row class="ml-1 mr-1">

          <form-input
            v-model="form.description"
            col="4"
            label="รายละเอียดสินค้า"
            placeholder="รายละเอียดสินค้า"
            rules="required"
          />

          <form-input
            v-model="form.wholesale_price"
            col="4"
            label="ราคาขายส่ง"
            placeholder="ราคาขายส่ง"
            rules="required"
          />

          <form-input
            v-model="form.retail_price"
            col="4"
            label="ราคาขายปลีก"
            placeholder="ราคาขายปลีก"
            rules="required"
          />

        </b-row>
        <!-- basic select -->
        <b-row class="ml-1 mr-1">
          <b-col
            class="vselect"
            cols="4"
          >
            <v-select
              v-model="form.Branch"

              placeholder="เพิ่มสินค้าไปที่สาขา"
              :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
              label="title"
              :options="Branch"
            />
          </b-col>

          <form-input
            v-if="form.type=='อะไหล่'"
            v-model="form.quantity"
            label="จำนวน"
            col="4"
            placeholder="จำนวน"
            rules="required"
          />

          <form-input
            v-if="form.type!=='อะไหล่'"
            v-model="form.vin"
            label="รหัสตัวถัง"
            col="4"
            placeholder="รหัสตัวถัง"
            rules="required"
          />

        </b-row>
        <!-- <b-row>
          <label
            for="example-datepicker"
          >ว / ด /ป ที่ผลิต</label>
          <b-form-datepicker
            id="example-datepicker"
            v-model="form.date"
            class="mb-1"
          />
        </b-row> -->
        <b-row class="my-2 d-flex justify-content-end">
          <b-button
            v-ripple.400="'rgba(113, 102, 240, 0.15)'"
            v-b-modal.modal-success
            variant="primary"
            class="mr-1"
            @click="setProductData(form)"
          >
            <span class="align-middle">เพิ่มสินค้า</span>
          </b-button>
        </b-row>

        <!-- <pre>{{ form }}</pre> -->
      </validation-observer></b-form></panel>
</template>

<script>
import { mapState, mapActions } from 'vuex'

import Ripple from 'vue-ripple-directive'

export default {

  directives: {
    Ripple,
  },
  data() {
    return {
      dir: false,
      searchTerm: '',
      data: [],
    }
  },
  computed: {
    ...mapState('addProduct', ['test', 'Branch', 'form']),
    direction() {
      if (this.$store.state.appConfig.isRTL) {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.dir = true
        return this.dir
      }
      // eslint-disable-next-line vue/no-side-effects-in-computed-properties
      this.dir = false
      return this.dir
    },
  },
  mounted() {
    this.setApi({ api: this.$http, self: this })
    this.getSettingBasicBranch()
    this.setRefs(this.$refs)
  },
  methods: {
    ...mapActions('addProduct', [
      'setApi',
      'getSettingBasicBranch',
      'addProduct',
      'setRefs',
      'typeProduct',
      'setProductData',
    ]),
  },

}
</script>
<style scoped>
.tree{
    padding-top: 9px;
}
.vselect{
    padding-top: 25px;
}
label{
    font-size: larger;
}
</style>
