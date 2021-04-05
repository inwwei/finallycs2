<template>
  <div class="auth-wrapper auth-v2">
    <b-row class="auth-inner m-0">
      <!-- Brand logo-->
      <b-link class="brand-logo">
        <div class="demo-inline-spacing">
          <img
            src="@/assets/images/logo/logo.png"
            alt="login"
            class="mx-auto"
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
        lg="7"
        class="d-none d-lg-flex align-items-center p-5"
      >
        <div
          class="w-100 d-lg-flex align-items-center justify-content-center px-5"
        >
          <b-img
            fluid
            :src="imgUrl"
            alt="Login V2"
          />
        </div>
      </b-col>
      <!-- /Left Text-->

      <!-- Login-->
      <b-col
        lg="5"
        class="d-flex align-items-center auth-bg px-2 p-lg-5"
      >
        <b-col
          sm="8"
          md="6"
          lg="12"
          class="px-xl-2 mx-auto"
        >
          <b-card-title
            class="mb-1 font-weight-bold"
            title-tag="h2"
          >
            กรุณาเข้าสู่ระบบ
          </b-card-title>

          <div v-show="check==false">
            <b-alert
              show
              variant="danger"
            >
              <div class="alert-body">
                <feather-icon
                  icon="InfoIcon"
                  class="mr-50 mt-25"
                />
                กรอกข้อมูลไม่ถูกต้อง
              </div>
            </b-alert>
          </div>

          <!-- form -->
          <validation-observer
            ref="loginForm"
            #default="{ invalid }"
          >
            <b-form
              class="auth-login-form mt-2"
              @submit.prevent="login"
              @submit_guest.prevent="login_guest"
            >
              <!-- username -->
              <b-form-group
                label="ชื่อผู้ใช้"
                label-for="login-username"
              >
                <validation-provider
                  #default="{ errors }"
                  name="Username"
                  vid="username"
                  rules="required"
                >
                  <b-form-input
                    id="login-username"
                    v-model="userEmail"
                    :state="errors.length > 0 ? false : null"
                    name="login-userame"
                    placeholder="test"
                  />
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>

              <!-- forgot password -->
              <b-form-group label="รหัสผ่าน">
                <validation-provider
                  #default="{ errors }"
                  name="Password"
                  vid="password"
                  rules="required"
                >
                  <b-input-group
                    class="input-group-merge"
                    :class="errors.length > 0 ? 'is-invalid' : null"
                  >
                    <b-form-input
                      id="login-password"
                      v-model="password"
                      :state="errors.length > 0 ? false : null"
                      class="form-control-merge"
                      :type="passwordFieldType"
                      name="login-password"
                      placeholder="Password"
                    />
                    <b-input-group-append is-text>
                      <feather-icon
                        class="cursor-pointer"
                        :icon="passwordToggleIcon"
                        @click="togglePasswordVisibility"
                      />
                    </b-input-group-append>
                  </b-input-group>
                  <small class="text-danger">{{ errors[0] }}</small>
                </validation-provider>
              </b-form-group>
              <b-row>
                <b-col>
                  <b-button
                    type="submit"
                    variant="primary"
                    block
                    :disabled="invalid"
                  >
                    เข้าสู่ระบบ (สมาชิก)
                  </b-button>
                </b-col>
                <b-col>
                  <b-button
                    to="/Register"
                    variant="warning"
                    block
                  >
                    สมัครสมาชิก
                  </b-button>
                </b-col>
                <b-col>
                  <b-button
                    type="submit_guest"
                    variant="success"
                    block
                  >
                    เข้าสู่ระบบ (ผู้ใช้ทั่วไป)
                  </b-button>
                </b-col>

              </b-row>
              <br>
              <b-alert
                show
                variant="success"
              >
                <div class="alert-body">
                  <feather-icon
                    icon="InfoIcon"
                    class="mr-50 mt-25"
                  />
                  ยินดีต้อนรับ หากท่านคือผู้ใช้ทั่วไป ท่านไม่จำเป็นต้องลงทะเบียน
                  เลือก "ผู้ใช้ทั่วไป" ได้เลย
                </div>
              </b-alert>
            </b-form>
          </validation-observer>
          <!-- divider -->
          <!-- <div class="divider my-2">
            <div class="divider-text">
              Ver 1.0
            </div>
          </div> -->
        </b-col>
      </b-col>
      <!-- /Login-->
    </b-row>
  </div>
</template>

<script>
/* eslint-disable global-require */
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import {
  BRow,
  BAlert,
  BCol,
  BLink,
  BFormGroup,
  BFormInput,
  BInputGroupAppend,
  BInputGroup,
  BFormCheckbox,
  BCardText,
  BCardTitle,
  BImg,
  BForm,
  BButton,
  VBTooltip,
} from 'bootstrap-vue'
import useJwt from '@/auth/jwt/useJwt'
import { required, email } from '@validations'
import { togglePasswordVisibility } from '@core/mixins/ui/forms'
import store from '@/store/index'
import { getHomeRouteForLoggedInUser } from '@/auth/utils'

import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default {
  directives: {
    'b-tooltip': VBTooltip,
  },
  components: {
    BRow,
    BCol,
    BLink,
    BFormGroup,
    BFormInput,
    BInputGroupAppend,
    BInputGroup,
    // BFormCheckbox,
    BAlert,
    BCardTitle,
    BImg,
    BForm,
    BButton,
    ValidationProvider,
    ValidationObserver,
  },
  mixins: [togglePasswordVisibility],
  data() {
    return {
      check: true,
      status: '',
      userEmail: '',
      password: '',
      userUsername: 'test',
      sideImg: require('@/assets/images/pages/login-v2.svg'),

      // validation rules
      required,
      email,
    }
  },
  computed: {
    passwordToggleIcon() {
      return this.passwordFieldType === 'password' ? 'EyeIcon' : 'EyeOffIcon'
    },
    imgUrl() {
      if (store.state.appConfig.layout.skin === 'dark') {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.sideImg = require('@/assets/images/pages/login-v2-dark.svg')
        return this.sideImg
      }
      return this.sideImg
    },
  },
  methods: {
    login() {
      this.$refs.loginForm.validate().then(success => {
        if (success) {
          useJwt
            .login({
              username: this.userEmail,
              password: this.password,
            //   username: 'test',
            //   password: 'password',
            }).then(
              this.check = false,
            )
            .then(response => {
              const { token, name } = response.data.data
              // FIXME: หน้าบ้านต้องส่งมา
              this.check = true
              const userData = {
                role: 'admin', // src\auth\utils.js
                fullName: name,
                username: name,
                ability: [{ action: 'manage', subject: 'all' }], // ไม่มี การทำงาน
              }
              useJwt.setToken(token)
              useJwt.setRefreshToken(token)
              localStorage.setItem('userData', JSON.stringify(userData))
              this.$ability.update(userData.ability)

              // ? This is just for demo purpose as well.
              // ? Because we are showing eCommerce app's cart items count in navbar
              //   this.$store.commit('app-ecommerce/UPDATE_CART_ITEMS_COUNT', userData.extras.eCommerceCartItemsCount)

              // ? This is just for demo purpose. Don't think CASL is role based in this case, we used role in if condition just for ease
              this.$router
                .push(getHomeRouteForLoggedInUser(userData.role))
                .then(() => {
                  this.$toast({
                    component: ToastificationContent,
                    position: 'top-right',
                    props: {
                      title: `สวัสดี ${
                        userData.fullName || userData.username
                      }`,
                      icon: 'CoffeeIcon',
                      variant: 'success',
                    //   text: `You have successfully logged in as ${userData.role}. Now you can start to explore!`,
                    },
                  })
                })
                .catch(error => {
                  this.$refs.loginForm.setErrors(error.response.data.error)
                })
            })
        }
      })
    },
    login_guest() {
      this.$refs.loginForm.validate().then(success => {
        if (success) {
          useJwt
            .login({
            //   username: this.userEmail,
            //   password: this.password,
              username: 'guest',
              password: 'password',
            })
            .then(response => {
              const { token, name } = response.data.data
              // FIXME: หน้าบ้านต้องส่งมา
              const userData = {
                role: 'admin', // src\auth\utils.js
                fullName: name,
                username: name,
                ability: [{ action: 'manage', subject: 'all' }], // ไม่มี การทำงาน
              }

              useJwt.setToken(token)
              useJwt.setRefreshToken(token)
              localStorage.setItem('userData', JSON.stringify(userData))
              this.$ability.update(userData.ability)

              // ? This is just for demo purpose as well.
              // ? Because we are showing eCommerce app's cart items count in navbar
              //   this.$store.commit('app-ecommerce/UPDATE_CART_ITEMS_COUNT', userData.extras.eCommerceCartItemsCount)

              // ? This is just for demo purpose. Don't think CASL is role based in this case, we used role in if condition just for ease
              this.$router
                .push(getHomeRouteForLoggedInUser(userData.role))
                .then(() => {
                  this.$toast({
                    component: ToastificationContent,
                    position: 'top-right',
                    props: {
                      title: `Welcome ${
                        userData.fullName || userData.username
                      }`,
                      icon: 'CoffeeIcon',
                      variant: 'success',
                      text: `You have successfully logged in as ${userData.role}. Now you can start to explore!`,
                    },
                  })
                })
                .catch(error => {
                  this.$refs.loginForm.setErrors(error.response.data.error)
                })
            })
        } else {
          console.log(111)
        }
      })
    },
  },
}
</script>

<style lang="scss">
@import "@core/scss/vue/pages/page-auth.scss";
</style>
