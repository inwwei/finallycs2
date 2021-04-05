<template>
  <div>
    <!-- <panel

      title="ข้อมูลร้าน"
    >
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
          <b-col
            cols="12"
          >
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
    </panel> -->
    <!-- <pre>{{ user_data }}</pre> -->
    <b-col cols="12">
      <b-button
        v-ripple.400="'rgba(255, 255, 255, 0.15)'"
        v-b-modal.modal-profile
        variant="primary"
        class="mt-2 mr-1"
        @click="getModalProfile(user_data)"
      >
        เพิ่มร้าน
      </b-button>
    </b-col>
    <br>
    <b-modal
      id="modal-profile"
      cancel-variant="danger"
      ok-title="ยืนยัน"
      cancel-title="ยกเลิก"
      centered
      @ok="edit_profile_add"
    >
      <b-form>
        <validation-observer ref="simpleRules">
          <!-- <pre>{{ modal_data_profile }}</pre> -->
          <b-col>
            <b-form-group label-for="number">
              <form-input
                v-model="modal_data_profile.name"
                label="ชื่อร้าน"
                rules="required"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label-for="number">
              <form-input
                v-model="modal_data_profile.branch"
                label="สาขา"
                rules="required"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label-for="number">
              <form-input
                v-model="modal_data_profile.ceo_firstname"
                label="ชื่อผู้จัดการ"
                rules="required"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label-for="number">
              <form-input
                v-model="modal_data_profile.ceo_lastname"
                label="นามสกุลผู้จัดการ"
                rules="required"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label-for="number">
              <form-input
                v-model="modal_data_profile.district"
                label="ตำบล"
                rules="required"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label-for="number">
              <form-input
                v-model="modal_data_profile.amphoe"
                label="อำเภอ"
                rules="required"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label-for="number">
              <form-input
                v-model="modal_data_profile.province"
                label="จังหวัด"
                rules="required"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label-for="number">
              <form-input
                v-model="modal_data_profile.postal_code"
                label="รหัสไปรษณีย์"
                rules="required"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label-for="number">
              <form-input
                v-model="modal_data_profile.email"
                label="อีเมล"
                rules="required"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label-for="number">
              <form-input
                v-model="modal_data_profile.company_tel"
                label="เบอร์โทรติดต่อ"
                rules="required"
              />
            </b-form-group>
          </b-col> </validation-observer></b-form>
    </b-modal>
    <b-modal
      id="modal-profile-add"
      cancel-variant="danger"
      ok-title="ยืนยัน"
      cancel-title="ยกเลิก"
      centered
      @ok="edit_profile_edit"
    >
      <b-form>
        <validation-observer ref="simpleRules">
          <!-- <pre>{{ modal_data_profile }}</pre> -->
          <b-col>
            <b-form-group label-for="number">
              <form-input
                v-model="modal_data_profile_add.name"
                label="ชื่อร้าน"
                rules="required"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label-for="number">
              <form-input
                v-model="modal_data_profile_add.branch"
                label="สาขา"
                rules="required"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label-for="number">
              <form-input
                v-model="modal_data_profile_add.ceo_firstname"
                label="ชื่อผู้จัดการ"
                rules="required"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label-for="number">
              <form-input
                v-model="modal_data_profile_add.ceo_lastname"
                label="นามสกุลผู้จัดการ"
                rules="required"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label-for="number">
              <form-input
                v-model="modal_data_profile_add.district"
                label="ตำบล"
                rules="required"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label-for="number">
              <form-input
                v-model="modal_data_profile_add.amphoe"
                label="อำเภอ"
                rules="required"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label-for="number">
              <form-input
                v-model="modal_data_profile_add.province"
                label="จังหวัด"
                rules="required"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label-for="number">
              <form-input
                v-model="modal_data_profile_add.postal_code"
                label="รหัสไปรษณีย์"
                rules="required"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label-for="number">
              <form-input
                v-model="modal_data_profile_add.email"
                label="อีเมล"
                rules="required"
              />
            </b-form-group>
          </b-col>
          <b-col>
            <b-form-group label-for="number">
              <form-input
                v-model="modal_data_profile_add.company_tel"
                label="เบอร์โทรติดต่อ"
                rules="required"
              />
            </b-form-group>
          </b-col> </validation-observer></b-form>
    </b-modal>
    <div class="custom-search d-flex justify-content-end mb-1">
      <b-col cols="12">
        <vue-good-table
          theme="nocturnal"
          :columns="columns_company"
          :rows="company_data"
          :rtl="direction"
          :search-options="{
            enabled: true,
            externalQuery: searchTerm,
          }"
          :pagination-options="{
            enabled: true,
            perPage: pageLength,
          }"
        >
          <div
            slot="emptystate"
            class="center"
          >
            ไม่พบข้อมูล
          </div>
          <template
            slot="table-row"
            slot-scope="props"
          >
            <!-- Column: Action -->
            <span v-if="props.column.field === 'manage'">
              <span>
                <b-dropdown
                  variant="link"
                  toggle-class="text-decoration-none"
                  no-caret
                >
                  <template v-slot:button-content>
                    <feather-icon
                      icon="MoreVerticalIcon"
                      size="16"
                      class="text-body align-middle mr-25"
                    />
                  </template>

                  <b-dropdown-item
                    v-b-modal.modal-profile-add
                    @click="getModalProfileList(props.row)"
                  >
                    <feather-icon
                      icon="Edit2Icon"
                      class="mr-50"
                    />
                    <span>แก้ไข</span>
                  </b-dropdown-item>
                  <b-dropdown-item @click="deletecompany(props.row)">
                    <feather-icon
                      icon="TrashIcon"
                      class="mr-50"
                    />
                    <span>ปิดกิจการ</span>
                  </b-dropdown-item></b-dropdown>
              </span>
            </span>
            <span v-else-if="props.column.field === 'company'">
              <span>
                <b-button
                  v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                  variant="primary"
                  @click="selcectCompany(modal_data_profile_add.id)"
                >
                  เลือก
                </b-button>
              </span>
            </span>
          </template>
          <template
            slot="pagination-bottom"
            slot-scope="props"
          >
            <div class="d-flex justify-content-between flex-wrap">
              <div class="d-flex align-items-center mb-0 mt-1">
                <span class="text-nowrap"> แสดง 1 ถึง </span>
                <b-form-select
                  v-model="pageLength"
                  :options="['3', '5', '10']"
                  class="mx-1"
                  @input="
                    (value) => props.perPageChanged({ currentPerPage: value })
                  "
                />
                <span class="text-nowrap"> ของ {{ props.total }} แถว </span>
              </div>
              <div>
                <b-pagination
                  :value="1"
                  :total-rows="props.total"
                  :per-page="pageLength"
                  first-number
                  last-number
                  align="right"
                  prev-class="prev-item"
                  next-class="next-item"
                  class="mt-1 mb-0"
                  @input="(value) => props.pageChanged({ currentPage: value })"
                >
                  <template #prev-text>
                    <feather-icon
                      icon="ChevronLeftIcon"
                      size="18"
                    />
                  </template>
                  <template #next-text>
                    <feather-icon
                      icon="ChevronRightIcon"
                      size="18"
                    />
                  </template>
                </b-pagination>
              </div>
            </div>
          </template>
        </vue-good-table>
      </b-col>
    </div>
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
import router from '@/router'

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
      url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
      zoom: 8,
      center: [47.31322, -1.319482],
      markerLatLng: [47.31322, -1.319482, { draggable: 'true' }],
      dir: false,
      searchTerm: '',
    }
  },
  computed: {
    ...mapState('product', [
      'user_data',
      'pageLength',
      'company_data',
      'columns_company',
      'modal_data_profile',
      'modal_data_profile_add',
    ]),
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
    this.getCompany() // มันคือ company
    this.getUser()
  },
  methods: {
    ...mapActions('product', [
      'setApi',
      'getModalProfileList',
      'getUser',
      'edit_profile_add',
      'edit_profile_edit',
      'getModalProfile',
      'getCompany',
      'deletecompany',
    ]),
    selcectCompany(id) {
      router.push({ name: 'Menu', query: { id } })
    },
  },
}
</script>
<style lang="scss">
.vue2leaflet-map {
  &.leaflet-container {
    height: 350px;
  }
}
label {
  font-size: larger;
}
.center {
  text-align: center;
}
</style>
