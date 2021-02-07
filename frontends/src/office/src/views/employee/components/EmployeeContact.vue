<template>
  <b-card>
    <b-card-title>ข้อมูลติดต่อ</b-card-title>
    <b-col cols="12">
      <vue-good-table
        :columns="infoContacts"
        :rows="employee_contact"
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
            v-if="props.column.field === 'type'"
            class="text-nowrap"
          >
            <span class="text-nowrap">{{ props.row.setting_master_contact.name_th }}</span>
          </span>

          <!-- Column: Name -->
          <span
            v-if="props.column.field === 'value'"
            class="text-nowrap"
          >
            <span class="text-nowrap">{{ props.row.value }}
              {{ props.row.house_number }}
              {{ props.row.district }}
              {{ props.row.amphure }}
              {{ props.row.province }}
              {{ props.row.postal_code }}</span>
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
  </b-card>
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
    ...mapState('employee', ['pageLength', 'infoContacts', 'rows', 'employee_contact']),
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
    ...mapActions('employee', ['setApi', 'setRefs', 'setId', 'loadEmployeeContact']),
  },
  mounted() {
    this.setApi({ api: this.$http, self: this })
    this.setRefs({ refs: this.$refs })
    this.setId(this.$route.query.id)
    this.loadEmployeeContact()
  },
}
</script>
