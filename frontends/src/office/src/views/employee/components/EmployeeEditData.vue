<template>
  <panel title="แก้ไขข้อมูลพนักงาน">
    <b-form>
      <validation-observer ref="simpleRules">
        <b-row class="ml-1 mr-1">
          <form-input
            v-model="employee_info.name"
            col="4"
            label="ชื่อ-นามสกุล"
            placeholder="ชื่อ-นามสกุล"
            rules="required"
          />
          <form-input
            v-model="employee_info.identification_number"
            col="4"
            label="รหัสประจำตัวประชาชน"
            placeholder="รหัสประจำตัวประชาชน"
            rules="required"
          />
          <b-col class="tree">
            <custom-tree-select
              ref="tree"
              v-model="employee_info.setting_master_users_id"
              label="ตำแหน่ง"
              url="/api/setting/master/user"
              @node-select="nodeSelect"
            />
          </b-col>
        </b-row>
        <b-row class="ml-1 mr-1">
          <form-input
            v-model="employee_info.code"
            col="4"
            label="รหัสพนักงาน"
            placeholder="รหัสพนักงาน"
            rules="required"
          />
          <form-input
            v-model="employee_info.financial"
            col="4"
            disabled
            label="วงเงิน"
            placeholder="วงเงิน"
            rules="required"
          />
          <b-col class="vselect">
            <vue-select
              v-model="employee_info.setting_basic_branch"
              :option="branches"
              label="สาขา"
              label-placeholder="เลือกสาขา"
              title="branch_name"
            />
          </b-col>
        </b-row>
        <b-row class="ml-1 mr-1">
          <form-input
            v-model="employee_info.email"
            col="4"
            label="อีเมล"
            placeholder="อีเมล"
            rules="required"
          />
          <form-input
            v-model="employee_info.username"
            col="4"
            label="ชื่อบัญชีผู้ใช้"
            placeholder="ชื่อบัญชีผู้ใช้"
            rules="required"
          />
          <form-input
            v-model="employee_info.password"
            col="4"
            label="รหัสผ่าน"
            placeholder="รหัสผ่าน"
            rules="required"
          />
        </b-row>
        <b-row class="ml-3 mr-1">
          <Attached
            ref="employee_edit_attached"
            :model-id="employee_info.id"
            :model-name="dataModelName"
          />
        </b-row>
      </validation-observer>
    </b-form>
  </panel>
</template>

<script>
import { mapState, mapActions } from 'vuex'
import Ripple from 'vue-ripple-directive'

export default {
  directives: {
    Ripple,
  },
  computed: {
    ...mapState('editEmployee', ['employee_info', 'edit_employee', 'branches', 'dataModelId', 'dataModelName']),
  },
  methods: {
    ...mapActions('editEmployee', [
      'setApi',
      'setRefs',
      'setId',
      'queryEmployeeInfo',
      'loadBranch',
      'nodeSelect',
      'clearEditForm']),
  },
  destroyed() {
    this.clearEditForm()
  },
  mounted() {
    this.setApi({ api: this.$http, self: this })
    this.setRefs(this.$refs)
    this.setId(this.$route.query.id)
    setTimeout(() => {
      this.queryEmployeeInfo()
    }, 200)
    this.loadBranch()
  },
}
</script>

<style>
.tree{
    padding-top: 9px;
}
.vselect{
    padding-top: 25px;
}
</style>
