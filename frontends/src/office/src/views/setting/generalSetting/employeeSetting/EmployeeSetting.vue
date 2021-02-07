<template>
  <b-row>
    <b-col cols="6">
      <custom-tree
        ref="tree"
        url="/api/setting/master/user"
        @onClick="onClickEmployeeSetting"
        @onDelete="onDelete"
      />
    </b-col>
    <b-col
      v-show="open_employee_form"
      cols="6"
    >
      <employee-setting-form
        ref="form"
        @clickSubmit="clickSubmit"
      />
    </b-col>
  </b-row>
</template>

<script>
import { mapState, mapActions } from 'vuex'
import EmployeeSettingForm from './EmployeeSettingForm.vue'

export default {
  components: {
    EmployeeSettingForm,
  },
  computed: {
    ...mapState('setting', ['open_employee_form']),
  },
  methods: {
    ...mapActions('setting', ['setApi', 'onClickEmployeeSetting', 'clearform']),
    onDelete(node, parent, index) {
      this.node = node
      this.parent = parent
      this.index = index
      this.$swal({
        title: 'ลบข้อมูลตั้งค่า',
        text: 'คุณต้องการลบข้อมูลหรือไม่',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-outline-danger ml-1',
        },
        buttonsStyling: false,
      }).then(result => {
        if (result.isConfirmed) {
          this.$http.delete(`/api/setting/master/user/${this.node.id}`)
          this.$swal({
            icon: 'success',
            title: 'ลบข้อมูลตั้งค่าสำเร็จ!',
            text: 'ข้อมูลตั้งค่าถูกลบสำเร็จ',
            confirmButtonText: 'ยืนยัน',
            customClass: {
              confirmButton: 'btn btn-success',
            },
          }).then(result => {
            if (result.isConfirmed) {
              this.clearform()
              this.$refs.tree.removeNode(this.node, this.parent, this.index)
            }
          })
        }
      })
    },
    clickSubmit() {
      this.$refs.tree.refresh()
    },
  },
}
</script>

<style>
</style>
