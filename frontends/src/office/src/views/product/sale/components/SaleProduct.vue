<template>
  <panel class="col-sm-7">
    <div class="demo-inline-spacing">
      <div
        v-for="product in products"
        :key="product.id"
      >
        <div v-if="product.maxQuantity > 0">
          <b-card>
            <h5
              class="mb-2"
              align="center"
            >
              {{ product.setting_master_product.name_th }}
            </h5>
            <b-row>
              <b-col>
                <b-form-spinbutton
                  id="sb-maxmin"
                  v-model="product.setQuantity"
                  size="sm"
                  min="1"
                  :max="product.maxQuantity"
                />
              </b-col>
              <b-col>
                <b-button
                  v-ripple.400="'rgba(113, 102, 240, 0.15)'"
                  size="sm"
                  variant="primary"
                  @click="addProduct(product)"
                >
                  เลือก
                </b-button>
              </b-col>
            </b-row>
          </b-card>
        </div>
        <div v-else>
          <b-card>
            <h5
              class="mb-2"
              align="center"
            >
              {{ product.setting_master_product.name_th }}
            </h5>
            <b-row>
              <b-col>
                <b-form-spinbutton
                  id="sb-maxmin"
                  v-model="product.setQuantity"
                  disabled
                  size="sm"
                  min="1"
                  :max="product.maxQuantity"
                />
              </b-col>
              <b-col>
                <b-button
                  v-ripple.400="'rgba(113, 102, 240, 0.15)'"
                  disabled
                  size="sm"
                  variant="primary"
                  @click="addProduct(product)"
                >
                  เลือก
                </b-button>
              </b-col>
            </b-row>
          </b-card>
        </div>
      </div>
    </div>
  </panel>

</template>
<script>
import { mapActions, mapState } from 'vuex'
import Ripple from 'vue-ripple-directive'

export default {
  directives: {
    Ripple,
  },
  computed: {
    ...mapState('saleProduct', ['products', 'saleTables']),
  },
  mounted() {
    setTimeout(() => {
      this.loadProduct()
    }, 500)
  },
  methods: {
    ...mapActions('saleProduct', ['loadProduct', 'addProduct', 'queryProductData']),
  },
}
</script>
