<template>
  <b-card>
    <b-card-title>ข้อมูลส่วนตัวสมาชิก</b-card-title>
    <b-row>
      <b-col
        cols="4"
        xl="5"
        class="d-flex justify-content-between flex-column"
      >
        <div class="d-flex justify-content-start">
          <div class="d-flex flex-column ml-1">
            <b-row>
              <Attached
                ref="test_attached"
                :model-id="info.id"
                :model-name="dataModelName"
                read-only
              />
            </b-row>
            <div class="d-flex flex-wrap">
              <b-button
                variant="primary"
                @click="editCustomer(info.id)"
              >
                แก้ไข
              </b-button>
              <b-button
                :to="{ name: 'customerIndex', params: {} }"
                variant="danger"
                class="ml-1"
              >
                ย้อนกลับ
              </b-button>
            </div>
          </div>
        </div>
      </b-col>
      <b-col
        cols="8"
        xl="7"
      >
        <table class="mt-2 mt-xl-0 w-100 info mb-2">
          <tr>
            <th class="pb-50">
              <span class="font-weight-bold">ชื่อ</span>
            </th>
            <td class="pb-50">
              {{ info.customer_name }}
            </td>
          </tr>
          <tr>
            <th class="pb-50">
              <span class="font-weight-bold">หมายเลขเสียภาษี</span>
            </th>
            <td class="pb-50 text-capitalize">
              {{ info.tax_id }}
            </td>
          </tr>
          <tr>
            <th class="pb-50">
              <span class="font-weight-bold">เลขประจำตัวประชาชน</span>
            </th>
            <td class="pb-50 text-capitalize">
              {{ info.identification_number }}
            </td>
          </tr>
          <tr>
            <th>
              <span class="font-weight-bold">สาขา</span>
            </th>
            <td>
              {{ info.setting_basic_branch.branch_name }}
            </td>
          </tr>
          <tr>
            <th>
              <span class="font-weight-bold">ข้อมูลติดต่อสมาชิก</span>
            </th>
            <td>
              {{ info.customer_contacts[0].title }}
            </td>
          </tr>
        </table>
      </b-col>
    </b-row>
  </b-card>
</template>
<script>
import { mapActions, mapState } from 'vuex'

export default {
  computed: {
    ...mapState('infoCustomer', ['info', 'customer_contact', 'dataModelName']),
  },
  methods: {
    ...mapActions('infoCustomer', ['setApi', 'loadCustomer', 'clearInfo']),
    ...mapActions('customer', ['editCustomer']),
  },
  destroyed() {
    this.clearInfo()
  },
  mounted() {
    this.setApi({ api: this.$http, self: this })
    setTimeout(() => {
      this.loadCustomer(this.$route.query.id)
    }, 400)
  },
}
</script>
<style>
.info{
    font-size: 16px;
}
</style>
