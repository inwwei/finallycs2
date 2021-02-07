<template>
  <panel title="แก้ไขสินค้า">
    <b-form>
      <validation-observer ref="simpleRules">
        <b-row class="ml-1 mr-1">
          <b-col class="tree">
            <custom-tree-select
              ref="tree"
              v-model="product_info.setting_master_product_id"
              url="/api/setting/master/product"
              @node-select="nodeSelect"
            />
          </b-col>

          <form-input
            v-model="product_info.setting_master_product.name_th"
            label="ชื่อสินค้า(TH)"
            placeholder="ชื่อสินค้า(TH)"
            rules="required"
          />

          <form-input
            v-model="product_info.setting_master_product.name_en"
            col="4"
            label="ชื่อสินค้า(EN)"
            placeholder="ชื่อสินค้า(EN)"
            rules="required"
          />

        </b-row>
        <b-row class="ml-1 mr-1">
          <form-input
            v-model="product_info.description"
            col="4"
            label="รายละเอียดสินค้า"
            placeholder="รายละเอียดสินค้า"
            rules="required"
          />
          <form-input
            v-model="product_info.wholesale_price"
            col="4"
            label="ราคาขายส่ง"
            placeholder="ราคาขายส่ง"
            rules="required"
          />

          <form-input
            v-model="product_info.retail_price"
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
              v-model="product_info.setting_basic_branch"
              placeholder="เพิ่มสินค้าไปที่สาขา"
              :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
              label="title"
              col="4"
              :options="Branch"
            />
          </b-col>

          <form-input
            v-if="product_info.type == 'อะไหล่'"
            v-model="product_info.quantity"
            label="จำนวน"
            placeholder="จำนวน"
            col="4"
            rules="required"
          />

          <form-input
            v-if="product_info.type !== 'อะไหล่'"
            v-model="product_info.vin"
            placeholder="รหัสตัวถัง"
            label="รหัสตัวถัง"
            col="4"
            rules="required"
          />

        </b-row>
        <b-row class="my-2 d-flex justify-content-end">
          <b-button
            v-ripple.400="'rgba(113, 102, 240, 0.15)'"
            v-b-modal.modal-success
            variant="primary"
            class="mr-1"
            @click="setEditData(product_info)"
          >
            <span class="align-middle">ยืนยัน</span>
          </b-button>
        </b-row>

        <!-- <pre>{{ product_info }}</pre> -->
      </validation-observer></b-form></panel>
</template>

<script>
export default {}
</script>
<script>
import { BDropdown, BDropdownItem } from "bootstrap-vue";
import { mapState, mapActions } from "vuex";
import store from "@/store/index";
import Ripple from "vue-ripple-directive";

export default {
  components: {
    BDropdown,
    BDropdownItem,
  },
  directives: {
    Ripple,
  },
  data() {
    return {
      dir: false,
      searchTerm: "",
      data: [],
    };
  },
  computed: {
    ...mapState("product", ["test", "Branch", "product_info","Branch"]),

  },
  methods: {
    ...mapActions("product", [
      "setApi",
      "nodeSelect",
      "setRefs",
      "queryProductInfo",
      "setId",
      "getSettingBasicBranch",
      "setEditData"

    ]),
  },
  mounted() {
    this.setApi({ api: this.$http, self: this });
    this.setId(this.$route.query.id)
 setTimeout(() => {
           this.queryProductInfo();
        }, 100)
    this.getSettingBasicBranch();
  },
};
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
