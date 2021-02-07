<!-- =========================================================================================
    File Name: Login.vue
    Description: Login Page
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
  <div class="h-screen flex w-full bg-img vx-row no-gutter justify-center items-center">
    <div class="vx-col sm:w-1/2 md:w-1/2 lg:w-2/5 m-4">
      <vx-card>

        <div class="vx-card__title mb-6">
          <h2 class="text-center">
            ลงทะเบียน อุปกรณ์
          </h2>
        </div>

        <img
          src="@/assets/images/pages/graphic-2.png"
          alt="coming-soon"
          class="mx-auto mb-2"
          width="150"
        >

        <div class="count-down text-center" />

        <vs-divider position="center">
          อุปกรณ์นี้ยังไม่ได้รับอนุญาติ
        </vs-divider>

        <div class="subscription">

          <span>ท่านต้องลงทะเบียนอุปกรณ์ก่อนการใช้งาน <br> ติดต่อขอรหัสลงทะเบียนได้ที่ สำนักงานใหญ่</span>
          <form-input
            v-model="code"
            v-validate="`required`"
            label="Authorize Code"
            data-vv-as="Authorize Code"
            :col="12"
          />
          <vs-button
            class="w-full"
            @click="login()"
          >
            ลงทะเบียน
          </vs-button>

        </div>
      </vx-card>
    </div>
  </div>
</template>

<script>
export default {
  components: {
  },
  data() {
    return {
      code: '',
    }
  },
  methods: {
    async login() {
      const result = await this.$validator.validateAll()
      if (!result) {
        return ''
      }

      const self = this
      self.$store.dispatch('loginAuthorize', this.code)
    },
  },
}

</script>
