<template>
  <div>
    <panel
      v-show="show_edit==false"
      title="ข้อมูลร้าน"
    >
      <!-- <pre>{{ user_data }}</pre> -->
      <b-form class="mt-2">
        <b-row>
          <b-col sm="4">
            <b-form-group
              label="ชื่อร้าน"
              label-for="account-username"
            >
              <b-form-input
                v-model="user_data.name"
                disabled
                name="username"
              />
            </b-form-group>
          </b-col>
          <b-col sm="4">
            <b-form-group
              label="ชื่อผู้จัดการ"
              label-for="account-username"
            >
              <b-form-input
                v-model="user_data.ceo_firstname"
                disabled
                name="username"
              />
            </b-form-group>
          </b-col>
          <b-col sm="4">
            <b-form-group
              label="นามสกุลผู้จัดการ"
              label-for="account-name"
            >
              <b-form-input
                v-model="user_data.ceo_lastname"
                disabled
                name="name"
              />
            </b-form-group>
          </b-col>
          <b-col sm="4">
            <b-form-group
              label="อำเภอ"
              label-for="account-e-mail"
            >
              <b-form-input
                v-model="user_data.amphoe"
                disabled
                name="email"
              />

            </b-form-group>
          </b-col>
          <b-col sm="4">
            <b-form-group
              label="ตำบล"
              label-for="account-company"
            >
              <b-form-input
                v-model="user_data.district"
                disabled
                name="company"
              />
            </b-form-group>
          </b-col>
          <b-col sm="4">
            <b-form-group
              label="จังหวัด"
              label-for="account-company"
            >
              <b-form-input
                v-model="user_data.province"
                disabled
                name="company"
              />
            </b-form-group>
          </b-col>
          <b-col sm="4">
            <b-form-group
              label="รหัสไปรษณีย์"
              label-for="account-company"
            >
              <b-form-input
                v-model="user_data.postal_code"
                disabled
                name="company"
              />
            </b-form-group>
          </b-col>
          <b-col sm="4">
            <b-form-group
              label="อีเมล"
              label-for="account-company"
            >
              <b-form-input
                v-model="user_data.email"
                disabled
                name="company"
              />
            </b-form-group>
          </b-col>
          <b-col sm="4">
            <b-form-group
              label="เบอร์โทรติดต่อ"
              label-for="account-company"
            >
              <b-form-input
                v-model="user_data.company_tel"
                disabled
                name="company"
              />
            </b-form-group>
          </b-col>
          <b-col cols="12">
            <b-button
              v-ripple.400="'rgba(255, 255, 255, 0.15)'"
              v-b-modal.modal-profile
              variant="primary"
              class="mt-2 mr-1"
              @click="getModalProfile(user_data)"
            >
              แก้ไข
            </b-button>
          </b-col>
        </b-row>
      </b-form>
    </panel>
    <b-modal
      id="modal-profile"
      cancel-variant="danger"
      ok-title="ยืนยัน"
      cancel-title="ยกเลิก"
      centered
      @ok="edit_profile"
    >
      <b-form>
        <validation-observer ref="simpleRules">
          <!-- <pre>{{ modal_data_profile }}</pre> -->
          <b-col>
            <b-form-group
              label-for="number"
            >
              <form-input
                v-model="modal_data_profile.name"
                label="ชื่อร้าน"
                rules="required"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group
              label-for="number"
            >
              <form-input
                v-model="modal_data_profile.ceo_firstname"
                label="ชื่อผู้จัดการ"
                rules="required"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group
              label-for="number"
            >
              <form-input
                v-model="modal_data_profile.ceo_lastname"
                label="นามสกุลผู้จัดการ"
                rules="required"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group
              label-for="number"
            >
              <form-input
                v-model="modal_data_profile.district"
                label="ตำบล"
                rules="required"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group
              label-for="number"
            >
              <form-input
                v-model="modal_data_profile.amphoe"
                label="อำเภอ"
                rules="required"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group
              label-for="number"
            >
              <form-input
                v-model="modal_data_profile.province"
                label="จังหวัด"
                rules="required"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group
              label-for="number"
            >
              <form-input
                v-model="modal_data_profile.postal_code"
                label="รหัสไปรษณีย์"
                rules="required"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group
              label-for="number"
            >
              <form-input
                v-model="modal_data_profile.email"
                label="อีเมล"
                rules="required"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group
              label-for="number"
            >
              <form-input
                v-model="modal_data_profile.company_tel"
                label="เบอร์โทรติดต่อ"
                rules="required"
              />
            </b-form-group>
          </b-col>
        </validation-observer></b-form> </b-modal>
    <!-- <panel title="แผนที่">
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
    </panel> -->
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
    // LMap,
    // LTileLayer,
    // LMarker,
    // LPopup,
  },
  directives: {
    Ripple,
  },
  data() {
    return {
      show_edit: false,
      url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
      zoom: 8,
      center: [47.313220, -1.319482],
      markerLatLng: [47.313220, -1.319482, { draggable: 'true' }],
      dir: false,
      searchTerm: '',
    }
  },
  computed: {
    ...mapState('product', ['test', 'user_data', 'modal_data_profile']),
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
    this.getUser()
  },
  methods: {
    ...mapActions('product', ['setApi', 'getUser', 'edit_profile', 'getModalProfile']),
    edit() {
      this.show_edit = true
      console.log(this.show_edit)
    },
  },

}
</script>
<style lang="scss">
.vue2leaflet-map{
  &.leaflet-container{
    height: 350px;
  }
}
label {
  font-size: larger;
}
</style>
