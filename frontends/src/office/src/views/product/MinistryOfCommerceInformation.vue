<template>
  <div>
    <panel title="สินค้าคงเหลือ">
      <b-form>
        <validation-observer ref="simpleRules">
          <b-row class="ml-1 mr-1">
            <b-col class="tree">
              <label>เลือกพืช</label>
              <vue-select
                v-model="form.Plant_select"
                :option="Plants"
                title="name"
              />
            </b-col>
            <b-col class="tree">
              <label>ตั้งแต่วันที่</label>
              <b-form-datepicker
                id="example-datepicker"
                v-model="form.first_date"
                class="mb-1"
              />
            </b-col>
            <b-col class="tree">
              <label>ถึงวันที่</label>
              <b-form-datepicker
                id="example-datepicker"
                v-model="form.end_date"
                class="mb-1"
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
            @click="request(form)"
          >
            <span class="align-middle">ยืนยัน</span>
          </b-button>
        </b-row>
      </b-form>
    </panel>
    <panel>
      <b-form>
        <b-row class="ml-1 mr-1">

          <form-input
            v-model="request_detail.product_name"
            disabled
            col="4"
            label="ชื่อสินค้า"
            rules="required"
          />

          <form-input
            v-model="request_detail.category_name"
            disabled
            col="4"
            label="ลักษณะ"
            rules="required"
          />
          <form-input
            v-model="request_detail.unit"
            disabled
            col="4"
            label="หน่วย"
            placeholder="ชื่อสินค้า(EN)"
            rules="required"
          />
        </b-row>
      </b-form>

      <div class="custom-search d-flex justify-content-end mb-1">
        <b-col cols="12">
          <vue-good-table
            theme="nocturnal"
            :columns="columns"
            :rows="request_data"
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
              ไม่มีข้อมูล
            </div>
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
                  <span class="text-nowrap">
                    ของ {{ props.total }} แถว
                  </span>
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
      <!-- <pre>{{ request_detail }}</pre> -->
    </panel>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'
import { BFormDatepicker } from 'bootstrap-vue'
import Ripple from 'vue-ripple-directive'

export default {
  components: {
    BFormDatepicker,
  },
  directives: {
    Ripple,
  },
  data() {
    return {
      dir: false,
      searchTerm: '',
    }
  },
  computed: {
    ...mapState('product', [
      'test',
      'products',
      'columns',
      'pageLength',
      'Plants',
      'form',
      'request_data',
      'request_detail',
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
    this.getPlants()
  },
  methods: {
    ...mapActions('product', ['setApi', 'getPlants', 'request']),
  },
}
</script>
<style scoped>
.tree {
  padding-top: 3px;
}
.vselect {
  padding-top: 20px;
}
label {
  font-size: larger;
}
.center{
    text-align: center;
}
</style>
