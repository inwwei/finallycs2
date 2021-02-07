<template>
  <panel class="col-sm-5">
    <div class="demo-inline-spacing ">
      <vue-good-table
        class="col-sm-12"
        :columns="order_columns"
        :rows="form.saleTables"
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
          <!-- Column: Action -->
          <span v-if="props.column.field === 'action'">
            <span>
              <b-button
                v-ripple.400="'rgba(40, 199, 111, 0.15)'"
                variant="flat-danger"
                class="btn-icon"
                @click="deleteOrder(props.row)"
              >
                <feather-icon icon="TrashIcon" />
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
    </div>
    <div class="custom-search d-flex justify-content-end  my-1">
      <b-button
        v-ripple.400="'rgba(113, 102, 240, 0.15)'"
        variant="primary"
        @click="insertSaleOrder()"
      >
        สร้างรายการ
      </b-button>
    </div>
  </panel>
</template>
<script>
import { mapActions, mapState } from 'vuex'
import store from '@/store/index'
import Ripple from 'vue-ripple-directive'

export default {
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
    ...mapState('saleProduct', ['form', 'saleTables', 'order_columns', 'pageLength']),
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
    ...mapActions('saleProduct', ['addProduct', 'deleteOrder', 'createProductOrder', 'insertSaleOrder']),
  },
}
</script>
