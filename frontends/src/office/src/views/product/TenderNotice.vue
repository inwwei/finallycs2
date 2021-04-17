<template>
  <panel title="รายการประกาศรับซื้อผลผลิตทางการเกษตร">
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
    <!-- <pre>{{ data_with_company }}</pre> -->
    <div class="custom-search d-flex justify-content-end mb-1">
      <b-col cols="12">

        <vue-good-table
          theme="nocturnal"
          :columns="columns"
          :rows="data_with_company"
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

              <b-button
                @click="viewCompany(props.row.company_id)"
              >
                <feather-icon
                  icon="SearchIcon"
                  class="mr-50"
                />
                <span>ข้อมูล</span>
              </b-button>

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
      </b-col>
    </div>
    <b-row />
    <!-- <pre>{{ data_with_company }}</pre> -->
  </panel>
</template>

<script>
import { mapState, mapActions } from 'vuex'

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
    ...mapState('company', ['test', 'products', 'pageLength', 'columns', 'pageLength', 'data_with_company']),
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
    this.post_with_company()
  },
  methods: {
    ...mapActions('company', ['setApi', 'getData', 'post_with_company', 'deleteProduct', 'editProduct', 'viewCompany']),
  },

}
</script>
<style  scoped>
label{
    font-size: larger;
}
.center{
    text-align: center;
}
</style>
