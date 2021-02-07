<template>
  <div>
    <panel title="รายการรับสำเร็จ">
      <div class="custom-search d-flex justify-content-end mb-1">
        <b-col cols="12">
          <vue-good-table
            :columns="columns_success"
            :rows="order_partner_success"
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
    <!-- <pre>{{ order_partner_success }}</pre> -->
  </div>
</template>

<script>
import vSelect from 'vue-select'
import { mapState, mapActions } from 'vuex'
import { VBModal, BModal, BFormDatepicker } from 'bootstrap-vue'
import Ripple from 'vue-ripple-directive'

export default {
  components: {
    BModal,
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
      'user',
      'object_recieve',
      'modal_data',
      'test',
      'Branch',
      'partner',
      'receive',
      'columns_success',
      'columns_selected',
      'pageLength',
      'order_partner_success',
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
    this.queryOrderPartnerSuccess()
  },
  methods: {
    ...mapActions('receive', [
      'setApi',
      'queryOrderPartnerSuccess',

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
