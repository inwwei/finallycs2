<template>
  <div>
    <b-row>
      <b-form ref="form">
        <validation-observer ref="Settingform">
          <b-row class="mr-5">
            <b-col cols="12">
              <form-input
                v-model="member_form.name_th"
                label="ชื่อ(TH)"
                data-vv-as="Title"
                :col="12"
                rules="required"
              />
            </b-col>
            <b-col cols="12">
              <form-input
                v-model="member_form.name_en"
                label="ชื่อ(EN)"
                data-vv-as="Title"
                :col="12"
                rules="required"
              />
            </b-col>
          </b-row>
        </validation-observer>
      </b-form>
    </b-row>
    <b-row class="ml-1 my-1">
      <b-button
        v-ripple.400="'rgba(255, 255, 255, 0.15)'"
        type="submit"
        variant="primary"
        class="mr-1"
        @click="SubmitSetting"
      >
        บันทึก
      </b-button>
      <b-button
        v-ripple.400="'rgba(186, 191, 199, 0.15)'"
        type="reset"
        variant="outline-secondary"
      >
        ยกเลิก
      </b-button>
    </b-row>
  </div>

</template>

<script>
import store from '@/store/index'
import { mapState, mapActions } from 'vuex'
import Ripple from 'vue-ripple-directive'

export default {
  components: {},
  directives: {
    Ripple,
  },
  computed: {
    ...mapState('setting', ['member_form']),
  },
  mounted() {
    this.setApi({ api: this.$http, self: this, refs: this.$refs })
  },
  methods: {
    ...mapActions('setting', ['setApi', 'clearform']),
    async SubmitSetting() {
      if (!this.member_form.id) {
        try {
          const result = this.$refs.Settingform.validate()
          if (result) {
            this.$swal({
              title: 'เพิ่มข้อมูลตั้งค่า',
              text: 'คุณต้องการเพิ่มข้อมูลหรือไม่',
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
                this.$http.post('/api/setting/master/customer/', this.member_form)
                this.$swal({
                  icon: 'success',
                  title: 'เพิ่มข้อมูลตั้งค่าสำเร็จ!',
                  text: 'ข้อมูลตั้งค่าถูกเพิ่มสำเร็จ',
                  confirmButtonText: 'ยืนยัน',
                  customClass: {
                    confirmButton: 'btn btn-success',
                  },
                }).then(result => {
                  if (result.isConfirmed) {
                    this.clearform()
                    this.$emit('clickSubmit', this.member_form)
                  }
                })
              }
            })
          }
        } catch (error) {
          throw error
        }
      } else {
        try {
          const result = this.$refs.Settingform.validate()
          if (result) {
            this.$swal({
              title: 'แก้ไขข้อมูลตั้งค่า',
              text: 'คุณต้องการแก้ไขข้อมูลหรือไม่',
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
                this.$http.put(`/api/setting/master/customer/${this.member_form.id}`, this.member_form)
                this.$swal({
                  icon: 'success',
                  title: 'แก้ไขข้อมูลตั้งค่าสำเร็จ!',
                  text: 'ข้อมูลตั้งค่าถูกแก้ไขสำเร็จ',
                  confirmButtonText: 'ยืนยัน',
                  customClass: {
                    confirmButton: 'btn btn-success',
                  },
                }).then(result => {
                  if (result.isConfirmed) {
                    this.clearform()
                    this.$emit('clickSubmit', this.member_form)
                  }
                })
              }
            })
          }
        } catch (error) {
          throw error
        }
      }
    },
  },
}
</script>

<style>
</style>
