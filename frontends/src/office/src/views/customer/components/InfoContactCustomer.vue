<template>
  <panel title="เพิ่มข้อมูลติดต่อ">
    <!-- search input -->
    <div class="custom-search d-flex justify-content-end">
      <b-form-group>
        <div class="d-flex align-items-center">
          <label class="mr-1">ค้นหา</label>
          <b-form-input
            v-model="searchTerm"
            placeholder="ค้นหา"
            type="text"
            class="d-inline-block"
          />
        </div>
      </b-form-group>
    </div>
    <!-- table -->
    <b-col cols="12">
      <vue-good-table
        :columns="columns_customer_contact"
        :rows="customer_contact"
        :rtl="direction"
        :search-options="{
          enabled: true,
          externalQuery: searchTerm }"
        :pagination-options="{
          enabled: true,
          perPage:pageLength
        }"
      >
        <template
          slot="table-row"
          slot-scope="props"
        >
          <!-- Column: Name -->
          <span
            v-if="props.column.field === 'value'"
            class="text-nowrap"
          >
            <span class="text-nowrap">{{ props.row.value }} {{ props.row.house_number }} {{ props.row.district }} {{ props.row.amphure }} {{ props.row.province }} {{ props.row.postal_code }}</span>
          </span>
          <!-- Column: Action -->
          <!-- Column: Common -->
          <span v-else>
            {{ props.formattedRow[props.column.field] }}
          </span>
        </template>

        <!-- pagination -->
        <template
          slot="pagination-bottom"
          slot-scope="props"
        >
          <div class="d-flex justify-content-between flex-wrap">
            <div class="d-flex align-items-center mb-0 mt-1">
              <span class="text-nowrap ">
                Showing 1 to
              </span>
              <b-form-select
                v-model="pageLength"
                :options="['3','5','10']"
                class="mx-1"
                @input="(value)=>props.perPageChanged({currentPerPage:value})"
              />
              <span class="text-nowrap"> of {{ props.total }} entries </span>
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
                @input="(value)=>props.pageChanged({currentPage:value})"
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
  </panel>
</template>
<script>
import { VBModal } from 'bootstrap-vue'
import { mapActions, mapState } from 'vuex'
import store from '@/store/index'
import Ripple from 'vue-ripple-directive'

export default {
  components: {
  },
  directives: {
    'b-modal': VBModal,
    Ripple,
  },
  data() {
    return {
      dir: false,
      searchTerm: '',
    }
  },
  computed: {
    ...mapState('infoCustomer', ['info', 'pageLength', 'show_modal', 'columns_customer_contact', 'customer_contact']),
    direction() {
      if (store.state.appConfig.isRTL) {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.dir = true
        return this.dir
      }
      // eslint-disable-next-line vue/no-side-effects-in-computed-properties
      this.dir = false
      return this.dir
    },
    hasCustomerContacts(customer) {
      if (customer.customer_contacts[0]) {
        const value = `${customer.customer_contacts[0].value ?? ` ${customer.customer_contacts[0].house_name ?? ''} ${customer.customer_contacts[0].district ?? ''} ${customer.customer_contacts[0].amphore ?? ''}  ${customer.customer_contacts[0].province ?? ''} ${customer.customer_contacts[0].postal_code ?? ''}`} ${customer.customer_contacts[0].house_name ?? ''} `
        return customer.customer_contacts[0] ? value : 'ไม่มีข้อมูลติดต่อ'
      }
      return 'ไม่มีข้อมูลติดต่อ'
    },
  },
  mounted() {
  },
  methods: {
  },
}
</script>
