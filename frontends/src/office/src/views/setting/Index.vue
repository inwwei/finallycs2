<template>
  <b-card>
    <b-tabs>
      <b-tab title="ตั้งค่าทั่วไป">
        <b-tabs
          vertical
          nav-wrapper-class="nav-vertical"
        >
          <b-tab title="ตั้งค่าพนักงาน">
            <b-row>
              <b-col>
                <employee-setting />
              </b-col>
            </b-row>
          </b-tab>
          <b-tab title="ตั้งค่าสมาชิก">
            <b-row>
              <b-col>
                <member-setting />
              </b-col>
            </b-row>
          </b-tab>
          <b-tab title="ตั้งค่าสินค้า">
            <b-row>
              <b-col>
                <product-setting />
              </b-col>
            </b-row>
          </b-tab>
          <b-tab title="ตั้งค่าข้อมูลติดต่อ">
            <b-row>
              <b-col>
                <contact-setting />
              </b-col>
            </b-row>
          </b-tab>
        </b-tabs>
      </b-tab>
      <b-tab title="ตั้งค่าพื้นฐาน">
        <b-tabs
          vertical
          nav-wrapper-class="nav-vertical"
        >
          <b-tab title="ตั้งค่ารหัสคุม">
            <code-basic />
          </b-tab>
          <b-tab title="ตั้งค่าบริษัท">
            <company-basic />
          </b-tab>
          <b-tab title="ตั้งค่าสาขา">
            <branch-basic />
          </b-tab>
          <b-tab title="ตั้งค่าการเข้าถึงระบบ">
            <device-basic />
          </b-tab>
        </b-tabs>
      </b-tab>
    </b-tabs>
  </b-card>
</template>

<script>
import { BTabs, BTab } from 'bootstrap-vue'
import CompanyBasic from './basicSetting/companySetting/CompanySetting.vue'
import CodeBasic from './basicSetting/codeSetting/CodeSetting.vue'
import BranchBasic from './basicSetting/branchSetting/BranchSetting.vue'
import DeviceBasic from './basicSetting/deviceSetting/DeviceSetting.vue'

import EmployeeSetting from './generalSetting/employeeSetting/EmployeeSetting.vue'
import ContactSetting from './generalSetting/contactSetting/ContactSetting.vue'
import MemberSetting from './generalSetting/memberSetting/MemberSetting.vue'
import ProductSetting from './generalSetting/productSetting/ProductSetting.vue'

export default {
  components: {
    BTabs,
    BTab,
    CompanyBasic,
    CodeBasic,
    BranchBasic,
    DeviceBasic,
    EmployeeSetting,
    ContactSetting,
    MemberSetting,
    ProductSetting,
  },
}
</script>
