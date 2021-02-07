<template>
  <div>
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
            variant="primary"
            style="width:210px;"
            class="mr-1"
            :to="{name:'employeeAdd'}"
          >
            เพิ่มข้อมูล
          </b-button>
        </div>
      </b-form-group>
    </div>
    <b-col cols="12">
      <vue-good-table
        :columns="columns"
        :rows="users"
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

          <!-- Column: Action -->
          <span v-if="props.column.field === 'action'">
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
                <b-dropdown-item @click="infoEmployee(props.row.id)">
                  <feather-icon
                    icon="SearchIcon"
                    class="mr-50"
                  />
                  <span>ดูข้อมูล</span>
                </b-dropdown-item>
                <b-dropdown-item @click="editEmployee(props.row.id)">
                  <feather-icon
                    icon="Edit2Icon"
                    class="mr-50"
                  />
                  <span>แก้ไข</span>
                </b-dropdown-item>
                <b-dropdown-item @click="deleteEmployee(props.row)">
                  <feather-icon
                    icon="TrashIcon"
                    class="mr-50"
                  />
                  <span>ลบ</span>
                </b-dropdown-item>
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
  </div>

</template>

<script>
import { mapActions, mapState } from 'vuex'
import store from '@/store/index'

export default {
  components: {
  },
  data() {
    return {
      dir: false,
      searchTerm: '',
    }
  },
  computed: {
    ...mapState('employee', ['pageLength', 'columns', 'rows', 'users']),
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
    ...mapActions('employee', ['setApi', 'setRefs', 'queryUserData', 'deleteEmployee', 'editEmployee', 'infoEmployee']),
  },
  mounted() {
    this.setApi({ api: this.$http, self: this })
    this.setRefs({ refs: this.$refs })
    this.queryUserData()
  },
}
</script>
