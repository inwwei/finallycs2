<template>
  <div>
    <!-- <pre>{{ modal_data_profile_add }}</pre> -->
    <b-col
      cols="12"
    >
      <b-button
        v-show="!company_data[0]"
        v-ripple.400="'rgba(255, 255, 255, 0.15)'"
        v-b-modal.modal-profile-add
        variant="primary"
        class="mt-2 mr-1"
        @click="getModalProfile(user_data)"
      >
        เพิ่มร้าน
      </b-button>
    </b-col>
    <br>
    <b-modal
      id="modal-profile-edit"
      cancel-variant="danger"
      ok-title="ยืนยัน"
      cancel-title="ยกเลิก"
      centered
      size="lg"
      @ok="edit_profile_edit"
    >

      <b-form>
        <validation-observer ref="edit">
          <b-row>
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

          </b-row>
          <b-row>
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

          </b-row>
          <b-row>
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
            </b-col>
          </b-row>
          <b-row>
            <b-col>
              <ThailandAutoComplete
                v-model="modal_data_profile_add.district"
                type="district"
                label="ตำบล"
                color="#42b883"
                size="medium"
                @select="select"
              />
              <ThailandAutoComplete
                v-model="modal_data_profile_add.amphoe"
                type="amphoe"
                label="อำเภอ"
                size="medium"
                @select="select"
              />
            </b-col>
          </b-row>
          <ThailandAutoComplete
            v-model="modal_data_profile_add.province"
            type="province"
            label="จังหวัด"
            size="medium"
            color="#35495e"
            @select="select"
          />

          <ThailandAutoComplete
            v-model="modal_data_profile_add.zipcode"
            type="zipcode"
            label="รหัสไปรษณีย์"
            size="medium"
            color="#00a4e4"
            @select="select"
          />
        </validation-observer></b-form>
    </b-modal>
    <b-modal
      id="modal-profile-add"
      cancel-variant="danger"
      ok-title="ยืนยัน"
      cancel-title="ยกเลิก"
      centered
      size="lg"
      @ok="edit_profile_add(address)"
    >
      <b-form>
        <validation-observer ref="add">
          <b-row>
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

          </b-row>
          <b-row>
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

          </b-row>
          <b-row>
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
            </b-col>
          </b-row>
          <b-row>
            <b-col>

              <ThailandAutoComplete
                v-model="district"
                type="district"
                label="ตำบล"
                color="#42b883"
                size="medium"
                @select="select"
              />
              <ThailandAutoComplete
                v-model="amphoe"
                type="amphoe"
                label="อำเภอ"
                size="medium"
                @select="select"
              />
            </b-col>
          </b-row>
          <ThailandAutoComplete
            v-model="province"
            type="province"
            label="จังหวัด"
            size="medium"
            color="#35495e"
            @select="select"
          />
          <ThailandAutoComplete
            v-model="zipcode"
            type="zipcode"
            label="รหัสไปรษณีย์"
            size="medium"
            color="#00a4e4"
            @select="select"
          />

        </validation-observer></b-form>
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
                    v-b-modal.modal-profile-edit
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
                  @click="selcectCompany(props.row.id)"
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
    <!-- <pre>{{ modal_data_profile }}</pre> -->
  </div>
</template>

<script>
import router from '@/router'
import ThailandAutoComplete from 'vue-thailand-address-autocomplete'

import { mapState, mapActions } from 'vuex'
import {
  LMap, LTileLayer, LMarker, LPopup,
} from 'vue2-leaflet'

import Ripple from 'vue-ripple-directive'

export default {
  components: {
    ThailandAutoComplete,

  },
  directives: {
    Ripple,
  },
  data() {
    return {
      address: '',
      district: '',
      amphoe: '',
      province: '',
      zipcode: '',

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
      'address',
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
  destroyed() {
    this.clear()
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
      'select',
      'clear',
    ]),
    select(address) {
      this.district = address.district
      this.amphoe = address.amphoe
      this.province = address.province
      this.zipcode = address.zipcode
      this.address = address
      console.log(this.address)
    },
    selcectCompany(id) {
      console.log(id)
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
