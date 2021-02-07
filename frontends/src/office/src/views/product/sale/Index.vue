<template>
  <panel title="รายการขายทั้งหมด">
    <!-- search input -->
    <div class="custom-search d-flex justify-content-end">
      <b-form-group>
        <div class="d-flex align-items-center">
          <label class="mr-1">ค้นหา</label>
          <b-form-input
            v-model="searchTerm"
            placeholder="ค้นหา"
            type="text"
            class="d-inline-block mr-1"
          />
          <b-button
            v-ripple.400="'rgba(113, 102, 240, 0.15)'"
            variant="primary"
            style="width:210px;"
            :to="{name:'productSale',params:{}}"
          >
            <span class="align-middle">เพิ่มรายการ</span>
          </b-button>
        </div>
      </b-form-group>
    </div>
    <!-- table -->
    <b-col cols="12">
      <vue-good-table
        :columns="columns"
        :rows="sale_products"
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
            v-if="props.column.field === 'customer_contacts'"
            class="text-nowrap"
          >
            <span class="text-nowrap">{{ hasCustomerContacts(props.row) }}</span>
          </span>

          <!-- Column: Action -->
          <span v-else-if="props.column.field === 'action'">
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
                <template v-slot:button-content>
                  <feather-icon
                    icon="MoreVerticalIcon"
                    size="16"
                    class="text-body align-middle mr-25"
                  />
                </template>
                <div>
                  <b-dropdown-item
                    @click="printSaleProductReport(props.row.id)"
                  >
                    <feather-icon
                      icon="PrinterIcon"
                      class="mr-50"
                    />
                    <span>พิมพ์</span>
                  </b-dropdown-item>
                  <b-dropdown-item
                    @click="cancelSaleOrder(props.row)"
                  >
                    <feather-icon
                      icon="SlashIcon"
                      class="mr-50"
                    />
                    <span>ยกเลิก</span>
                  </b-dropdown-item>
                </div>

              </b-dropdown>
            </span>
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
import { mapActions, mapState } from 'vuex'
import store from '@/store/index'
import Ripple from 'vue-ripple-directive'

export default {
  components: {
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
    ...mapState('saleProduct', ['pageLength', 'columns', 'rows', 'sale_products', 'status']),
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
  },
  methods: {
    ...mapActions('saleProduct', ['setApi', 'cancelSaleOrder', 'querySaleProductData', 'printSaleProductReport', 'editSaleProduct']),
  },
  mounted() {
    this.setApi({ api: this.$http, self: this })
    this.querySaleProductData()
  },
}
</script>
<style scoped>
.topIndex{
    top:-20px;
}
</style>
