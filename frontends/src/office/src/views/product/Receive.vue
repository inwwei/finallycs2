<template>
  <div>
    <panel title="ข้อมูลพื้นฐานการรับ">
      <b-row class="ml-1 mr-1">
        <form-input
          v-model="user.name"
          col="3"
          label="ชื่อผู้รับสินค้า"
          placeholder="ชื่อผู้รับสินค้า"
          rules="required"
        />
        <b-col
          class="vselect"
          cols="3"
        >
          <vue-select
            v-model="receive.partner"
            :option="partner"
            label="เลือกคู่ค้า"
            title="title"
          />

        </b-col>
        <b-col
          class="vselect"
          cols="3"
        >
          <vue-select
            v-model="receive.product_type"
            :option="option"
            label="ประเภทสินค้าที่รับเข้า"
            title="title"
          />
        </b-col>
        <!-- <b-col>
          <label for="example-datepicker">วันที่รับ</label>
          <b-form-datepicker
            id="example-datepicker"
            v-model="receive.receive_date"
            class="mb-1"
          />
        </b-col> -->
      </b-row>
      <b-row class="my-2 d-flex justify-content-end">
        <b-button
          v-ripple.400="'rgba(113, 102, 240, 0.15)'"
          v-b-modal.modal-success
          variant="primary"
          class="mr-1"
          @click="queryOrderPartner(receive.partner.id)"
        >
          <span class="align-middle">ยืนยัน</span>
        </b-button>
      </b-row>
    </panel>
    <panel title="รายการสินค้าที่สามารถรับได้">
      <div class="custom-search d-flex justify-content-end mb-1">
        <b-col cols="12">
          <vue-good-table
            :columns="columns"
            :rows="order_partner"
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
            <template
              slot="table-row"
              slot-scope="props"
            >
              <span v-if="props.column.field === 'manage'">
                <b-button
                  v-ripple.400="'rgba(113, 102, 240, 0.15)'"
                  v-b-modal.modal-receive
                  variant="success"
                  @click="getModalId(props.row)"
                >
                  รับ
                </b-button>
              </span>
            </template>

            <b-modal
              id="modal-select2"
              ok-title="submit"
              cancel-variant="outline-secondary"
            >
              <b-form />
            </b-modal>

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
                  <span class="text-nowrap"> จาก {{ props.total }} แถว </span>
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
    </panel>
    <!-- <pre>{{ modal_data }}</pre> -->
    <panel title="สินค้าที่เลือกรับ">
      <div class="custom-search d-flex justify-content-end mb-1">
        <b-col cols="12">
          <!-- <pre>{{ object_recieve }}</pre> -->
          <vue-good-table
            :columns="columns_selected"
            :rows="object_recieve"
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
            <template
              slot="table-row"
              slot-scope="props"
            >
              <span v-if="props.column.field === 'manage'">
                <span>
                  <b-dropdown variant="link">
                    <template v-slot:button-content>
                      <feather-icon
                        icon="MoreVerticalIcon"
                        size="16"
                        class="text-body align-middle mr-25"
                      />
                    </template>
                    <b-dropdown-item>
                      <feather-icon
                        icon="SearchIcon"
                        class="mr-50"
                      />
                      <span>ข้อมูล</span>
                    </b-dropdown-item>
                    <b-dropdown-item>
                      <feather-icon
                        icon="Edit2Icon"
                        class="mr-50"
                      />
                      <span>แก้ไข</span>
                    </b-dropdown-item>
                    <b-dropdown-item>
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
                  <span class="text-nowrap"> จาก {{ props.total }} แถว </span>
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
      <hr>
      <!-- <pre>{{ modal_data.shipping_price }}</pre> -->
      <b-row class="ml-1 mr-1">
        <!-- <pre>{{ price.shipping_price }}</pre> -->
        <form-input
          v-model="price.shipping_price"
          col="3"
          label="ค่าใช้จ่าย (ถ้ามี)"
        />
      </b-row>
      <b-row class="my-2 d-flex justify-content-end">
        <b-button
          v-ripple.400="'rgba(113, 102, 240, 0.15)'"
          variant="primary"
          class="mr-1"
          @click="conFirmReceive(object_recieve)"
        >
          <span class="align-middle">ยืนยันการรับ</span>
        </b-button>
        <!-- <pre>{{ object_recieve }}</pre> -->
      </b-row>
    </panel>
    <Received />
    <b-modal
      id="modal-receive"
      cancel-variant="danger"
      ok-title="เพิ่ม"
      cancel-title="ยกเลิก"
      centered
      title="กรอกรายละเอียดสินค้า"
      @ok="pushData"
    >
      <validation-observer ref="simpleRules">
        <b-form>
          <!-- <pre>{{ modal_data }}</pre> -->
          <b-form-group>
            <label>รายการสินค้า</label>
            <b-form-input v-model="modal_data.setting_master_product.title" />
            <hr>
            <label>รหัสสินค้า</label>
            <b-form-input v-model="modal_data.order.code" />
            <hr>
            <label v-show="modal_data.setting_master_product.type!=='อะไหล่'">รหัสตัวถัง</label>
            <b-form-input
              v-show="modal_data.setting_master_product.type!=='อะไหล่'"
              v-model="modal_data.vin"
            />
            <hr>
            <label>รายละเอียด</label>
            <b-form-input v-model="modal_data.description" />
            <hr>
            <label>ราคาขายส่ง</label>
            <b-form-input v-model="modal_data.wholesale_price" />
            <hr>
            <label v-show="modal_data.setting_master_product.type=='อะไหล่'">จำนวน</label>
            <b-form-input
              v-show="modal_data.setting_master_product.type=='อะไหล่'"
              v-model="modal_data.new_amount_recieve"
            />
            <hr v-show="modal_data.setting_master_product.type=='อะไหล่'">
            <label>ราคารับมา</label>
            <b-form-input
              v-model="modal_data.cost_price"
            />
            <!-- modal_data.setting_master_product.type -->
            <hr>
            <div v-show="modal_data.setting_master_product.type!=='อะไหล่'">
              <label>วันที่ผลิต</label>
              <b-form-datepicker
                id="example-datepicker"
                v-model="modal_data.date"
                class="mb-1"
              />
            </div>
            <b-row class="ml-1 mr-1">
              <b-col
                class="vselect"
              >
                <v-select
                  v-model="modal_data.branch"
                  placeholder="เพิ่มสินค้าไปที่สาขา"
                  :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
                  label="title"
                  :options="Branch"
                />
              </b-col>
            </b-row>
          </b-form-group>
        </b-form>
      </validation-observer>
    </b-modal>
    <!-- <pre>{{ object_recieve }}</pre> -->
    <pre>{{ modal_data.receiver }}</pre>

  </div>
</template>

<script>
import vSelect from 'vue-select'
import { mapState, mapActions } from 'vuex'
import { VBModal, BModal, BFormDatepicker } from 'bootstrap-vue'
import Ripple from 'vue-ripple-directive'
import Received from './Received.vue'

export default {
  components: {
    BFormDatepicker,
    BModal,
    Received,
  },
  directives: {
    Ripple,
    'b-modal': VBModal,
  },
  data() {
    return {
      option: [{ title: 'ตัวรถ' }, { title: 'อะไหล่' }, { title: 'ต่อพ่วง' }],
      dir: false,
      searchTerm: '',
      data: [],
    }
  },
  computed: {
    ...mapState('receive', [
      'price',
      'user',
      'object_recieve',
      'modal_data',
      'test',
      'Branch',
      'partner',
      'order_partner',
      'receive',
      'columns',
      'columns_selected',
      'pageLength',
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
    this.setApi({ api: this.$http, self: this })
    this.getSettingBasicBranch()
    this.getPartner()
    this.getUser()
  },
  methods: {
    ...mapActions('receive', [
      'setApi',
      'getSettingBasicBranch',
      'getPartner',
      'queryOrderPartner',
      'getUser',
      'getModalId',
      'pushData',
      'conFirmReceive',
    ]),
  },
}
</script>
<style >
.tree {
  padding-top: 9px;
}
.vselect {
  padding-top: 22px;
}
label {
  font-size:inherit
}
</style>
