<template>
  <div class="auth-wrapper auth-v2">
    <b-row class="auth-inner m-0">
      <!-- Brand logo-->
      <b-link class="brand-logo">
        <div class="demo-inline-spacing">
          <img
            src="@/assets/images/logo/logo.png"
            alt="login"
            class="mx-1"
            width="50px"
          >
          <h2 class="brand-text text-primary ml-1">
            AOM
          </h2>
        </div>
      </b-link>
      <!-- /Brand logo-->

      <!-- Left Text-->
      <b-col
        lg="8"
        class="d-none d-lg-flex align-items-center p-5"
      >
        <div
          class="w-100 d-lg-flex align-items-center justify-content-center px-5"
        >
          <b-img
            fluid
            :src="imgUrl"
            alt="Forgot password V2"
          />
        </div>
      </b-col>
      <!-- /Left Text-->

      <!-- Forgot password-->
      <b-col
        lg="4"
        class="d-flex align-items-center auth-bg px-2 p-lg-5"
      >
        <b-col
          sm="8"
          md="6"
          lg="12"
          class="px-xl-2 mx-auto"
        >
          <b-card-title
            title-tag="h2"
            class="font-weight-bold mb-1"
          >
            ลงทะเบียน อุปกรณ์
          </b-card-title>
          <b-card-text class="mb-2">
            <span>ท่านต้องลงทะเบียนอุปกรณ์ก่อนการใช้งาน ติดต่อขอรหัสลงทะเบียนได้ที่
              สำนักงานใหญ่</span>
          </b-card-text>

          <!-- form -->
          <validation-observer ref="simpleRules">
            <b-form
              class="auth-forgot-password-form mt-2"
              @submit.prevent="validationForm"
            >
              <b-form-group
                label="Authorize Code"
                label-for="forgot-authorize-code"
              >
                <validation-provider
                  #default="{ errors }"
                  name="code"
                  rules="required"
                >
                  <b-form-input
                    id="forgot-authorize-code"
                    v-model="code"
                    :state="errors.length > 0 ? false : null"
                    name="forgot-authorize-code"
                    placeholder="Code"
                  />
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>

              <b-button
                type="submit"
                variant="primary"
                block
              >
                ลงทะเบียน
              </b-button>
            </b-form>
          </validation-observer>
        </b-col>
      </b-col>
      <!-- /Forgot password-->
    </b-row>
  </div>
</template>

<script>
/* eslint-disable global-require */
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import {
  BRow, BCol, BLink, BCardTitle, BCardText, BImg, BForm, BFormGroup, BFormInput, BButton,
} from 'bootstrap-vue'
import { required, email } from '@validations'
import store from '@/store/index'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default {
  components: {
    BRow,
    BCol,
    BLink,
    BImg,
    BForm,
    BButton,
    BFormGroup,
    BFormInput,
    BCardTitle,
    BCardText,
    ValidationProvider,
    ValidationObserver,
  },
  data() {
    return {
      code: '',
      sideImg: require('@/assets/images/pages/forgot-password-v2.svg'),
      // validation
      required,
      email,
    }
  },
  computed: {
    imgUrl() {
      if (store.state.appConfig.layout.skin === 'dark') {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.sideImg = require('@/assets/images/pages/forgot-password-v2-dark.svg')
        return this.sideImg
      }
      return this.sideImg
    },
  },
  methods: {
    async validationForm() {
      try {
        const success = await this.$refs.simpleRules.validate()
        if (!success) return ''

        this.$toast({
          component: ToastificationContent,
          props: {
            title: 'ลงทะเบียนอุปกรณ์ เรียบร้อย',
            icon: 'EditIcon',
            variant: 'success',
          },
        })

        this.$store.dispatch('loginAuthorize', this.code)
        return ''
      } catch (error) {
        throw error
      }
    },
  },
}
</script>

<style lang="scss">
@import "@core/scss/vue/pages/page-auth.scss";
</style>
