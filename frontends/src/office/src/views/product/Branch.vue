<template>
  <div>
    <panel title="ร้าน">
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
                  <b-button
                    v-ripple.400="'rgba(255, 255, 255, 0.15)'"
                    v-b-modal.modal-profile
                    variant="primary"
                    @click="getModalProfile(user_data)"
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
                      (value) =>
                        props.perPageChanged({ currentPerPage: value })
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
        </b-col></div>
    </panel>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'
import {
  BRow,
  BCol,
  BFormGroup,
  BInputGroupPrepend,
  BInputGroup,
} from 'bootstrap-vue'
import Cleave from 'vue-cleave-component'
// eslint-disable-next-line import/no-extraneous-dependencies
import 'cleave.js/dist/addons/cleave-phone.us'
import Ripple from 'vue-ripple-directive'

export default {
  components: {
    BCol,
  },
  directives: {
    Ripple,
  },
  data() {
    return {
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
    ...mapState('branch', [
      'pageLength',
      'company_data',
      'columns_company',
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
    this.getData()
    this.getPlants()
  },
  methods: {
    ...mapActions('branch', [
      'getModalProfileList',
      'getCompany',
      'setApi',
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
