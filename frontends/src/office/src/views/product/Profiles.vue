<template>
  <div>
    <panel title="สินค้าคงเหลือ">
      <b-form class="mt-2">
        <b-row>
          <b-col sm="6">
            <b-form-group
              label="Username"
              label-for="account-username"
            >
              <b-form-input
                v-model="test"
                disabled
                name="username"
              />
            </b-form-group>
          </b-col>
          <b-col sm="6">
            <b-form-group
              label="Name"
              label-for="account-name"
            >
              <b-form-input
                v-model="test"
                disabled
                name="name"
              />
            </b-form-group>
          </b-col>
          <b-col sm="6">
            <b-form-group
              label="E-mail"
              label-for="account-e-mail"
            >
              <b-form-input
                v-model="test"
                disabled
                name="email"
              />

            </b-form-group>
          </b-col>
          <b-col sm="6">
            <b-form-group
              label="Company"
              label-for="account-company"
            >
              <b-form-input
                v-model="test"
                disabled
                name="company"
              />
            </b-form-group>
          </b-col>

          <!-- alert -->
          <b-col
            cols="12"
            class="mt-75"
          >
            <b-alert
              show
              variant="warning"
              class="mb-50"
            >
              <h4 class="alert-heading">
                Your email is not confirmed. Please check your inbox.
              </h4>
              <div class="alert-body">
                <b-link class="alert-link">
                  Resend confirmation
                </b-link>
              </div>
            </b-alert>
          </b-col>
          <!--/ alert -->

          <b-col cols="12">
            <b-button
              v-ripple.400="'rgba(255, 255, 255, 0.15)'"
              variant="primary"
              class="mt-2 mr-1"
            >
              Save changes
            </b-button>
            <b-button
              v-ripple.400="'rgba(186, 191, 199, 0.15)'"
              variant="outline-secondary"
              type="reset"
              class="mt-2"
              @click.prevent="resetForm"
            >
              Reset
            </b-button>
          </b-col>
        </b-row>
      </b-form>
    </panel>
    <panel title="แผนที่">
      <b-row>
        <l-map
          :zoom="zoom"
          :center="center"
        >
          <l-tile-layer :url="url" />
          <l-marker :lat-lng="markerLatLng">
            <l-popup>You're here!</l-popup>
          </l-marker>
        </l-map>
      </b-row>
    </panel>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'
import {
  LMap, LTileLayer, LMarker, LPopup,
} from 'vue2-leaflet'

import Ripple from 'vue-ripple-directive'

export default {
  components: {
    LMap,
    LTileLayer,
    LMarker,
    LPopup,
  },
  directives: {
    Ripple,
  },
  data() {
    return {
      url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
      zoom: 8,
      center: [47.313220, -1.319482],
      markerLatLng: [47.313220, -1.319482, { draggable: 'true' }],
      dir: false,
      searchTerm: '',
    }
  },
  computed: {
    ...mapState('product', ['test', 'products', 'columns', 'pageLength']),
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
    this.setApi({ api: this.$http, self: this, refs: this.$refs })
    this.getData()
  },
  methods: {
    ...mapActions('product', ['setApi', 'getData', 'queryProductInfo', 'infoProduct', 'deleteProduct', 'editProduct']),
  },

}
</script>
<style lang="scss">
.vue2leaflet-map{
  &.leaflet-container{
    height: 350px;
  }
}
</style>
