<template>
  <b-card>
    <b-card-title>ข้อมูลส่วนตัวพนักงาน</b-card-title>
    <b-row>
      <b-col
        cols="21"
        xl="5"
        class="d-flex justify-content-between flex-column"
      >
        <b-row class="ml-2">
          <Attached
            :model-id="employee_info.id"
            read-only
          />
        </b-row>
        <div class="d-flex justify-content-start">
          <div class="d-flex flex-column ml-1">
            <div class="d-flex flex-wrap">
              <b-button
                variant="primary"
                @click="editEmployee(employee_id)"
              >
                แก้ไข
              </b-button>
              <b-button
                :to="{ name: 'employeeIndex', params: {} }"
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
        cols="12"
        xl="7"
      >
        <table class="mt-2 mt-xl-0 w-100 info mb-2">
          <tr>
            <th class="pb-50">
              <span class="font-weight-bold">ชื่อ</span>
            </th>
            <td class="pb-50">
              {{ employee_info.name }}
            </td>
          </tr>
          <tr>
            <th class="pb-50">
              <span class="font-weight-bold">เลขประจำตัวประชาชน</span>
            </th>
            <td class="pb-50 text-capitalize">
              {{ employee_info.identification_number }}
            </td>
          </tr>
          <tr>
            <th class="pb-50">
              <span class="font-weight-bold">ตำแหน่ง</span>
            </th>
            <td class="pb-50 text-capitalize">
              {{ employee_info_position }}
            </td>
          </tr>
          <tr>
            <th class="pb-50">
              <span class="font-weight-bold">วงเงิน</span>
            </th>
            <td class="pb-50">
              {{ employee_info.financial }}
            </td>
          </tr>
          <tr>
            <th>
              <span class="font-weight-bold">สาขา</span>
            </th>
            <td>
              {{ employee_info_branch }}
            </td>
          </tr>
        </table>
      </b-col>
    </b-row>
  </b-card>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
  computed: {
    ...mapState('employee', ['employee_info', 'employee_id', 'employee_info_position', 'employee_info_branch', 'dataModelName']),
  },
  methods: {
    ...mapActions('employee', ['setApi', 'setRefs', 'setId', 'queryEmployeeInfo', 'editEmployee']),
  },
  mounted() {
    this.setApi({ api: this.$http, self: this })
    this.setRefs({ refs: this.$refs })
    this.setId(this.$route.query.id)
    this.queryEmployeeInfo()
  },
}
</script>

<style>
.info{
    font-size: 16px;
}
</style>
