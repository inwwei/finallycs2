<template>
  <div>
    <panel title="ฟอร์มกรอกข้อมูลประกาศ">
      <!-- <pre>{{ form_add }}</pre> -->
      <b-form>
        <validation-observer ref="simpleRules">
          <b-row class="ml-1 mr-1">
            <b-col sm="4">
              <h6>ชื่อร้าน</h6>

              <b-form-group label-for="account-username">
                <b-form-input
                  v-model="form_add.company.name"
                  disabled
                  name="username"
                />
              </b-form-group>
            </b-col>
            <b-col class="tree">
              <h6>เลือกพืช</h6>
              <vue-select
                v-model="form_add.Plant_select"
                :option="Plants"
                title="name"
                rules="required"
              />
            </b-col>
            <b-col
              v-show="
                form_add.Plant_select.name == 'ข้าวหอมมะลิ' ||
                  form_add.Plant_select.name == 'ข้าวเหนียว'
              "
              md="6"
              xl="4"
            >
              <h6>หักความชื้น (ร้อยละ)</h6>
              <b-form-group label-for="number">
                <cleave
                  id="number"
                  v-model="form_add.moisture"
                  class="form-control"
                  :raw="false"
                  :options="options.number"
                  rules="required"
                />
              </b-form-group>
            </b-col>
            <b-col
              v-show="
                form_add.Plant_select.name == 'ข้าวหอมมะลิ' ||
                  form_add.Plant_select.name == 'ข้าวเหนียว'
              "
              md="6"
              xl="4"
            >
              <h6>ความชื้นต่ำสุด</h6>
              <b-form-group label-for="number">
                <cleave
                  id="number"
                  v-model="form_add.moisture_min"
                  class="form-control"
                  :raw="false"
                  :options="options.number"
                  rules="required"
                />
              </b-form-group>
            </b-col>
            <b-col
              v-show="
                form_add.Plant_select.name == 'ข้าวหอมมะลิ' ||
                  form_add.Plant_select.name == 'ข้าวเหนียว'
              "
              md="6"
              xl="4"
            >
              <h6>ความชื้นสูงสุด</h6>
              <b-form-group label-for="number">
                <cleave
                  id="number"
                  v-model="form_add.moisture_max"
                  class="form-control"
                  :raw="false"
                  :options="options.number"
                  rules="required"
                />
              </b-form-group>
            </b-col>
            <b-col
              v-show="
                form_add.Plant_select.name == 'ข้าวหอมมะลิ' ||
                  form_add.Plant_select.name == 'ข้าวเหนียว'
              "
              md="6"
              xl="4"
            >
              <h6>หักสิ่งแปลกปลอม (ร้อยละ)</h6>
              <b-form-group label-for="number">
                <cleave
                  id="number"
                  v-model="form_add.Foreign_matter"
                  class="form-control"
                  :raw="false"
                  :options="options.number"
                  rules="required"
                />
              </b-form-group>
            </b-col>
            <b-col
              md="6"
              xl="4"
            >
              <h6>ราคา</h6>
              <b-form-group label-for="number">
                <cleave
                  id="number"
                  v-model="form_add.price"
                  class="form-control"
                  :raw="false"
                  :options="options.number"
                  rules="required"
                />
              </b-form-group>
            </b-col>
            <b-col
              md="6"
              xl="4"
            >
              <h6>จำนวน</h6>
              <b-form-group label-for="number">
                <cleave
                  id="number"
                  v-model="form_add.amount"
                  class="form-control"
                  :raw="false"
                  :options="options.number"
                  rules="required"
                />
              </b-form-group>
            </b-col>
            <b-col
              md="6"
              xl="4"
            >
              <h6>หน่วย</h6>
              <b-form-select
                v-model="form_add.unit"
                :options="unit"
                rules="required"
              />
            </b-col>
          </b-row>
        </validation-observer>
        <b-row class="my-2 d-flex justify-content-end">
          <b-button
            v-ripple.400="'rgba(113, 102, 240, 0.15)'"
            v-b-modal.modal-success
            variant="primary"
            class="mr-1"
            @click="request_add(form_add)"
          >
            <span class="align-middle">ยืนยัน</span>
          </b-button>
        </b-row>
      </b-form>
    </panel>
    <panel title="รายการประกาศ">
      <div class="custom-search d-flex justify-content-end mb-1">
        <b-form-group>
          <div class="d-flex align-items-center">
            <label class="mr-1">ค้นหา</label>
            <b-form-input
              v-model="searchTerm"
              placeholder="ค้นหา"
              type="text"
              class="d-inline-block mr-1"
            />
          </div>
        </b-form-group>
      </div>
      <!-- <pre>{{ products }}</pre> -->
      <div class="custom-search d-flex justify-content-end mb-1">
        <b-col cols="12">
          <vue-good-table
            theme="nocturnal"
            :columns="columns_menu"
            :rows="products"
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
                      v-b-modal.modal-receive
                      @click="getModalId(props.row)"
                    >
                      <feather-icon
                        icon="Edit2Icon"
                        class="mr-50"
                      />
                      <span>แก้ไข</span>
                    </b-dropdown-item>
                    <b-dropdown-item @click="deleteProduct(props.row)">
                      <feather-icon
                        icon="TrashIcon"
                        class="mr-50"
                      />
                      <span>ลบ</span>
                    </b-dropdown-item></b-dropdown>
                </span>
              </span>
            </template>

            <template
              slot="pagination-bottom"
              slot-scope="props"
            >
              <b-modal
                id="modal-receive"
                cancel-variant="danger"
                ok-title="ยืนยัน"
                cancel-title="ยกเลิก"
                centered
                title="รายละเอียดการประกาศ"
                @ok="confirmEdit_menu"
              >
                <b-form>
                  <validation-observer ref="simpleRules">
                    <!-- <pre>{{ modal_data }}</pre> -->
                    <!-- <b-col>
                      <b-form-group>
                        <h6>ชื่อพืช</h6>
                        <form-input
                          v-model="modal_data.name"
                          disabled
                          rules="required"
                        />
                      </b-form-group>
                    </b-col> -->
                    <!-- <pre>{{ modal_data }}</pre> -->
                    <b-col
                      v-show="
                        modal_data.name == 'ข้าวหอมมะลิ' ||
                          modal_data.name == 'ข้าวเหนียว'
                      "
                    >
                      <h6>หักความชื้น (ร้อยละ)</h6>
                      <b-form-group label-for="number">
                        <cleave
                          id="number"
                          v-model="modal_data.moisture"
                          class="form-control"
                          :raw="false"
                          :options="options.number"
                        />
                      </b-form-group>
                    </b-col>
                    <b-col
                      v-show="
                        modal_data.name == 'ข้าวหอมมะลิ' ||
                          modal_data.name == 'ข้าวเหนียว'
                      "
                    >
                      <h6>ความชื้นต่ำสุด</h6>
                      <b-form-group label-for="number">
                        <cleave
                          id="number"
                          v-model="modal_data.moisture_min"
                          class="form-control"
                          :raw="false"
                          :options="options.number"
                        />
                      </b-form-group>
                    </b-col>
                    <b-col
                      v-show="
                        modal_data.name == 'ข้าวหอมมะลิ' ||
                          modal_data.name == 'ข้าวเหนียว'
                      "
                    >
                      <h6>ความชื้นสูงสุด</h6>
                      <b-form-group label-for="number">
                        <cleave
                          id="number"
                          v-model="modal_data.moisture_max"
                          class="form-control"
                          :raw="false"
                          :options="options.number"
                        />
                      </b-form-group>
                    </b-col>
                    <b-col
                      v-show="
                        modal_data.name == 'ข้าวหอมมะลิ' ||
                          modal_data.name == 'ข้าวเหนียว'
                      "
                    >
                      <h6>หักสิ่งแปลกปลอม (ร้อยละ)</h6>
                      <b-form-group label-for="number">
                        <cleave
                          id="number"
                          v-model="modal_data.Foreign_matter"
                          class="form-control"
                          :raw="false"
                          :options="options.number"
                        />
                      </b-form-group>
                    </b-col>
                    <b-col>
                      <h6>ราคา</h6>
                      <b-form-group label-for="number">
                        <cleave
                          id="number"
                          v-model="modal_data.price"
                          class="form-control"
                          :raw="false"
                          :options="options.number"
                        />
                      </b-form-group>
                    </b-col>

                    <b-col>
                      <h6>หน่วย</h6>
                      <b-form-select
                        v-model="modal_data.unit"
                        :options="unit"
                      />
                    </b-col>
                  </validation-observer></b-form>
              </b-modal>
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
                    @input="
                      (value) => props.pageChanged({ currentPage: value })
                    "
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
      <b-row />
    </panel>
  </div>
</template>

<script>
import {
  BFormSelect,
  BRow,
  BCol,
  BFormGroup,
  BInputGroupPrepend,
  BInputGroup,
} from 'bootstrap-vue'
import { mapState, mapActions } from 'vuex'

import Cleave from 'vue-cleave-component'
// eslint-disable-next-line import/no-extraneous-dependencies
import 'cleave.js/dist/addons/cleave-phone.us'
import Ripple from 'vue-ripple-directive'

export default {
  components: {
    // BCardCode,
    BFormSelect,
    BFormGroup,
    Cleave,
    BRow,
    BCol,
  },
  directives: {
    Ripple,
  },
  data() {
    return {
      unit: [
        { value: 'กิโลกรัม', text: 'กิโลกรัม' },
        { value: 'ขีด', text: 'ขีด' },
        { value: 'ตัน', text: 'ตัน' },
        { value: 'กรัม', text: 'กรัม' },
      ],
      dir: false,
      searchTerm: '',
      options: {
        number: {
          numeral: true,
          numeralPositiveOnly: true,
        },
      },
    }
  },
  computed: {
    ...mapState('product', [
      'modal_data',
      'company_data_select',
      'columns_menu',
      'Plants',
      'test',
      'products',
      'columns',
      'form_add',
      'pageLength',
      'products_data_table',
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
  //   destroyed() {
  //     this.clear()
  //   },
  async mounted() {
    await this.setApi({ api: this.$http, self: this, refs: this.$refs })
    await this.loadCompanys(this.$route.query.id)
    await this.getData()
    await this.getPlants()
    // setTimeout(() => {
    //   console.log('before', this.$route.query.id)
    //   console.log('=====ไอดีที่ส่งมา=====')
    //   console.log('after', this.$route.query.id)
    // }, 100)
  },
  methods: {
    ...mapActions('product', [
      'clear',
      'getModalId',
      'pushData',
      'request_add',
      'getPlants',
      'setApi',
      'getData',
      'queryProductInfo',
      'confirmEdit_menu',
      'deleteProduct',
      'loadCompanys',
    ]),

  },
}
</script>
<style  scoped>
label {
  font-size: larger;
}
.center {
  text-align: center;
}
</style>
