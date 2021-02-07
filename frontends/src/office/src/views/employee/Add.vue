<template>
  <div>
    <panel title="เพิ่มข้อมูลพนักงาน">
      <b-form>
        <validation-observer ref="simpleRules">
          <b-row class="ml-1 mr-1">
            <form-input
              v-model="add_employee.name"
              col="4"
              label="ชื่อ-นามสกุล"
              placeholder="ชื่อ-นามสกุล"
              rules="required"
            />
            <form-input
              v-model="add_employee.identification_number"
              col="4"
              label="รหัสประจำตัวประชาชน"
              placeholder="รหัสประจำตัวประชาชน"
              rules="required"
            />
            <b-col class="tree">
              <custom-tree-select
                ref="tree"
                v-model="add_employee.setting_master_users_id"
                label="ตำแหน่ง"
                url="/api/setting/master/user"
                @node-select="nodeSelect"
              />
            </b-col>
          </b-row>
          <b-row class="ml-1 mr-1">
            <form-input
              v-model="add_employee.code"
              col="4"
              label="รหัสพนักงาน"
              placeholder="รหัสพนักงาน"
              rules="required"
            />
            <form-input
              v-model="add_employee.financial"
              col="4"
              disabled
              label="วงเงิน"
              placeholder="วงเงิน"
              rules="required"
            />
            <b-col class="vselect">
              <vue-select
                v-model="add_employee.branch_selected"
                :option="branches"
                label="สาขา"
                title="branch_name"
              />
            </b-col>
          </b-row>
          <b-row class="ml-1 mr-1">
            <form-input
              v-model="add_employee.email"
              col="4"
              label="อีเมล"
              placeholder="อีเมล"
              rules="required"
            />
            <form-input
              v-model="add_employee.username"
              col="4"
              label="ชื่อบัญชีผู้ใช้"
              placeholder="ชื่อบัญชีผู้ใช้"
              rules="required"
            />
            <form-input
              v-model="add_employee.password"
              col="4"
              label="รหัสผ่าน"
              placeholder="รหัสผ่าน"
              rules="required"
            />
          </b-row>
          <b-row class="ml-3 mr-1">
            <Attached
              ref="test_attached"
              :model-id="dataModelId"
              :model-name="dataModelName"
            />
          </b-row>

        </validation-observer>
      </b-form>
    </panel>
    <panel title="ข้อมูลติดต่อ">
      <contact-table />
      <b-row class="my-2 d-flex justify-content-end">
        <b-button
          v-ripple.400="'rgba(113, 102, 240, 0.15)'"
          v-b-modal.modal-select2
          variant="outline-primary"
          class="mr-1"
        >
          <feather-icon
            icon="PhoneIcon"
            class="mr-50"
          />
          <span class="align-middle">เพิ่มข้อมูลติดต่อ</span>
        </b-button>
        <b-button
          v-ripple.400="'rgba(113, 102, 240, 0.15)'"
          v-b-modal.modal-success
          variant="primary"
          class="mr-1"
          @click="setEmployeeData(add_employee)"
        >
          <span class="align-middle">เพิ่มข้อมูลพนักงาน</span>
        </b-button>
        <b-button
          v-ripple.400="'rgba(113, 102, 240, 0.15)'"
          variant="danger"
          class="mr-1"
          :to="{ name: 'orderIndex', query: {} }"
        >
          <span class="align-middle">ย้อนกลับ</span>
        </b-button>
      </b-row>
    </panel>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex'
import Ripple from 'vue-ripple-directive'
import ContactTable from './components/ContactTable.vue'

export default {

  components: {
    ContactTable,
  },
  directives: {
    Ripple,
  },
  computed: {
    ...mapState('employee', ['add_employee', 'branches', 'tempContact', 'dataModelId', 'dataModelName']),
  },
  methods: {
    ...mapActions('employee', ['setApi', 'setRefs', 'setEmployeeData', 'loadBranch', 'nodeSelect', 'addEmployee', 'testUpload']),
  },
  mounted() {
    this.setApi({ api: this.$http, self: this })
    this.setRefs(this.$refs)
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
