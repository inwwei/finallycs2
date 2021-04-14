<template>
  <div>
    <panel title="ข้อมูลร้าน">
      <!-- <pre>{{ company_info }}</pre> -->
      <b-form class="mt-2">
        <b-row>
          <b-col sm="4">
            <b-form-group
              label="ชื่อร้าน"
              label-for="account-username"
            >
              <b-form-input
                v-model="company_info.name"
                disabled
                name="username"
              />
            </b-form-group>
          </b-col>
          <b-col sm="4">
            <b-form-group
              label="ชื่อผู้จัดการ"
              label-for="account-username"
            >
              <b-form-input
                v-model="company_info.ceo_firstname"
                disabled
                name="username"
              />
            </b-form-group>
          </b-col>
          <b-col sm="4">
            <b-form-group
              label="นามสกุลผู้จัดการ"
              label-for="account-name"
            >
              <b-form-input
                v-model="company_info.ceo_lastname"
                disabled
                name="name"
              />
            </b-form-group>
          </b-col>
          <b-col sm="4">
            <b-form-group
              label="อำเภอ"
              label-for="account-e-mail"
            >
              <b-form-input
                v-model="company_info.amphoe"
                disabled
                name="email"
              />
            </b-form-group>
          </b-col>
          <b-col sm="4">
            <b-form-group
              label="ตำบล"
              label-for="account-company"
            >
              <b-form-input
                v-model="company_info.district"
                disabled
                name="company"
              />
            </b-form-group>
          </b-col>
          <b-col sm="4">
            <b-form-group
              label="จังหวัด"
              label-for="account-company"
            >
              <b-form-input
                v-model="company_info.province"
                disabled
                name="company"
              />
            </b-form-group>
          </b-col>
          <b-col sm="4">
            <b-form-group
              label="รหัสไปรษณีย์"
              label-for="account-company"
            >
              <b-form-input
                v-model="company_info.postal_code"
                disabled
                name="company"
              />
            </b-form-group>
          </b-col>
          <b-col sm="4">
            <b-form-group
              label="อีเมล"
              label-for="account-company"
            >
              <b-form-input
                v-model="company_info.email"
                disabled
                name="company"
              />
            </b-form-group>
          </b-col>
          <b-col sm="4">
            <b-form-group
              label="เบอร์โทรติดต่อ"
              label-for="account-company"
            >
              <b-form-input
                v-model="company_info.company_tel"
                disabled
                name="company"
              />
            </b-form-group>
          </b-col>
        </b-row>
        <b-row>
          <b-button
            :to="{ name: 'CompanyRegistered', params: {} }"
            variant="primary"
            class="ml-1"
          >
            ย้อนกลับ
          </b-button>
        </b-row>
      </b-form>
    </panel>
    <panel title="รายการประกาศ">
      <div class="custom-search d-flex justify-content-end mb-1">
        <b-col cols="12">
          <vue-good-table
            theme="nocturnal"
            :columns="columns_menu"
            :rows="company_sub_data"
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
              slot="pagination-bottom"
              slot-scope="props"
            >
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-center mb-0 mt-1">
                  <span class="text-nowrap ">
                    แสดง 1 ถึง
                  </span>
                  <b-form-select
                    v-model="pageLength"
                    :options="['3','5','10']"
                    class="mx-1"
                    @input="(value)=>props.perPageChanged({currentPerPage:value})"
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
      <!-- <pre>{{ company_info }}</pre> -->
    </panel>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
  computed: {
    ...mapState('company', [
      'company_info',
      'product_id',
      'company_sub_data',
      'columns_menu',
    ]),
  },
  mounted() {
    this.setId(this.$route.query.id)
    this.setApi({ api: this.$http, self: this, refs: this.$refs })
    this.queryCompanyInfo()
  },
  methods: {
    ...mapActions('company', ['setApi', 'setId', 'queryCompanyInfo']),
  },
}
</script>

<style scoped>

label {
  font-size: inherit;
}
</style>
