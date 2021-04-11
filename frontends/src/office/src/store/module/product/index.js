import router from '@/router'

const data = () => ({
  company: '',
  api: '',
  self: '',
  refs: '',
  test: 'ss',
  request_data: [],
  request_detail: [],
  products: [],
  product_id: '',
  Plants: [],
  company_data: '',
  form_add: {
    company_id: '',
    first_date: '',
    end_date: '',
    name: '',
    moisture: '',
    moisture_min: '',
    moisture_max: '',
    Foreign_matter: '',
    price_per_kk: '',
    price_per_ton: '',
    Plant_select: '',
    company: '',
  },
  form: {
    Plant_select: '',
    first_date: '',
    end_date: '',
  },
  modal_data: {
    id: '',
    user_id: '123456789',
    Plant_select: '',
    first_date: '',
    end_date: '',
    name: '',
    moisture: '',
    moisture_min: '',
    moisture_max: '',
    Foreign_matter: '',
    price_per_kk: '',
    price_per_ton: '',
  },
  modal_data_profile: {},
  company_data_select: {},
  modal_data_profile_add: {},
  user_data: {},
  user_data_edit: {},
  columns: [
    {
      label: 'ณ วันที่',
      field: 'date',
    },
    {
      label: 'ราคาเฉลี่ยต่ำสุด',
      field: 'price_min',
    },
    {
      label: 'ราคาเฉลี่ยสูงสุด',
      field: 'price_max',
    },

  ],

  pageLength: 5,
  columns_menu: [
    {
      label: 'ชื่อ',
      field: 'name',
      sortable: false,
    },
    {
      label: 'ราคา/กก.',
      field: 'price_per_kk',
      type: 'number',
    },
    {
      label: 'หักความชื้น (ร้อยละ)',
      field: 'moisture',
      type: 'number',
    },
    {
      label: 'ความชื้นต่ำสุด',
      field: 'moisture_min',
      type: 'number',
    },
    {
      label: 'ความชื้นสูงสุด',
      field: 'moisture_max',
      type: 'number',
    },
    {
      label: 'หักสิ่งแปลกปลอม (ร้อยละ)',
      field: 'Foreign_matter',
      type: 'number',
    },
    {
      label: 'จัดการ',
      field: 'manage',
      sortable: false,
    },

  ],
  columns_company: [
    {
      label: 'ชื่อ',
      field: 'name',
    },
    {
      label: 'ชื่อ/สาขา',
      field: 'branch',
    },
    {
      label: 'โทร',
      field: 'company_tel',
      sortable: false,
    },
    {
      label: 'ที่อยู่',
      field: 'address',
      sortable: false,
    },
    {
      label: 'จัดการ',
      field: 'manage',
      sortable: false,
    },
    {
      label: 'เข้าใช้งาน',
      field: 'company',
      sortable: false,
    },
  ],
})
export default {
  namespaced: true,
  state: data(),
  getters: {
  },
  mutations: {

    SET_ARRAY_DATA_EDIT_PROFILE(state, data) {
      state.modal_data_profile = data
    },
    SET_ARRAY_DATA_EDIT_PROFILE_ADD(state, data) {
      state.modal_data_profile_add = data
    },
    SET_API(state, {
      api, self, refs,
    }) {
      state.api = api
      state.self = self
      state.refs = refs
    },
    SET_DATA_REQUEST(state, data) {
      state.request_data = data.price_list
      state.request_detail = data
    },
    SET_COMPANY_SELECT(state, data) {
      state.form_add.company = data
      state.form_add.company_id = state.form_add.company.id
    },
    SET_DATA(state, products) {
      state.products = products
    },
    SET_NAME(state) {
      state.form_add.name = state.form_add.Plant_select.name
    },
    CLEAR(state) {
      state.form_add = data().form_add
    },
    SET_USER(state, data) {
      state.user_data = data
    },
    SET_COMPANY(state, data) {
      state.company_data = data
    },
    CLEAR_FORM_ADD(state) {
      state.form_add.name = ''
      state.form_add.moisture = ''
      state.form_add.moisture_min = ''
      state.form_add.moisture_max = ''
      state.form_add.Foreign_matter = ''
      state.form_add.price_per_kk = ''
      state.form_add.price_per_ton = ''
      state.form_add.Plant_select = ''
    },
    SET_COMPANY_DATA(state, data) {
      state.company_data_select = data
    },
    SET_ID(state, id) {
      state.product_id = id
    },
    SET_PLANT(state, data) {
      state.Plants = data
    },
    SET_BRANCH_ID(state, product_info) {
      state.product_info.setting_basic_branch_id = product_info.setting_basic_branch.id
    },
    SET_MODAL_DATA(state, data) {
      // set ข้อมูลที่มาจากหน้าบ้านในส่วนของ modal ให้เข้าไปในตัวแปร modal_data
      state.modal_data = data
    },
    SET_MODAL_DATA_PROFILE_ADD(state, data) {
      // set ข้อมูลที่มาจากหน้าบ้านในส่วนของ modal ให้เข้าไปในตัวแปร modal_data
      state.modal_data_profile_add = data
    },
    SET_MODAL_DATA_EDIT_PROFILE(state, data) {
      // set ข้อมูลที่มาจากหน้าบ้านในส่วนของ modal ให้เข้าไปในตัวแปร modal_data
      state.modal_data_profile = data
    },

  },
  actions: {
    clear({ commit }) {
      commit('CLEAR')
    },
    setEditData({ commit, dispatch }, product_info) {
      commit('SET_PLANT_ID', product_info)
    //   dispatch('editProductData')
    },
    nodeSelect({ commit }, node) {
      commit('SET_NODE', node)
    },
    setId({ commit }, id) {
      commit('SET_ID', id)
    },
    setApi({ commit }, { api, self, refs }) {
      commit('SET_API', { api, self, refs })
    },
    async request_add({ state, commit, dispatch }) {
      console.log('555')
      try {
        const result = await state.refs.simpleRules.validate()
        if (result) {
          if (state.form_add.price_per_kk !== '' && state.form_add.Plant_select !== '') {
            commit('SET_NAME')
            state.self.$swal({
              title: 'เพิ่มข้อมูลสินค้า',
              text: 'คุณต้องการเพิ่มข้อมูลใช่หรือไม่?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: 'ยืนยัน',
              cancelButtonText: 'ยกเลิก',
              customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-danger ml-1',
              },
              buttonsStyling: false,
            }).then(result => {
              if (result.isConfirmed) {
                state.api.post('/api/product', state.form_add)
                state.self.$swal({
                  icon: 'success',
                  title: 'เพิ่มข้อมูลสำเร็จ!',
                  text: `ข้อมูลสินค้า ${state.form_add.Plant_select.name} ถูกเพิ่มสำเร็จ`,
                  confirmButtonText: 'ยืนยัน',
                  customClass: {
                    confirmButton: 'btn btn-success',
                  },
                }).then(result => {
                  if (result) {
                    dispatch('getData')
                    commit('CLEAR_FORM_ADD')
                  }
                })
              }
            })
          } else {
            state.self.$swal({
              title: 'ผิดพลาด!',
              text: ' กรุณากรอกข้อมูลให้ครบถ้วน',
              icon: 'error',
              confirmButtonText: 'ยืนยัน',
              cancelButtonText: 'ยกเลิก',
              customClass: {
                confirmButton: 'btn btn-danger',
              },
              buttonsStyling: false,
            })
          }
        } else {
          state.self.$swal({
            title: 'ผิดพลาด!',
            text: ' กรุณากรอกข้อมูลให้ครบถ้วน',
            icon: 'error',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
            customClass: {
              confirmButton: 'btn btn-danger',
            },
            buttonsStyling: false,
          })
        }
      } catch (error) {
        throw error
      }
    },
    async request({ commit, state }) {
      try {
        if (state.form.Plant_select.code !== undefined && state.form.first_date !== '' && state.form.end_date !== '') {
          state.self.$swal({
            icon: 'success',
            title: 'เรียบร้อย!',
            confirmButtonText: 'ยืนยัน',
            customClass: {
              confirmButton: 'btn btn-success',
            },
          })

          console.log(state.form.Plant_select.code)
          console.log(state.form.first_date)
          console.log(state.form.end_date)
          const { data } = await state.api.get(`https://dataapi.moc.go.th/gis-product-prices?product_id=${state.form.Plant_select.code}&from_date=${state.form.first_date}&to_date=${state.form.end_date}`)
          commit('SET_DATA_REQUEST', data)
        } else {
          state.self.$swal({
            icon: 'warning',
            title: 'กรุณากรอกข้อมูลให้ครบถ้วน!',
            confirmButtonText: 'ยืนยัน',
            customClass: {
              confirmButton: 'btn btn-danger',
            },
          })
        }
      } catch (error) {
        throw error
      }
    },
    async getPlants({ commit, state }) {
      try {
        const { data } = await state.api.get(
          '/api/Plants',
        )
        commit('SET_PLANT', data.data)
      } catch (error) {
        throw error
      }
    },
    async loadCompany({ commit, state }, id) {
      const company_id = id
      //   console.log(company_id)
      try {
        const { data } = await state.api.get(
          `/api/company/${company_id}`,
        )
        commit('SET_COMPANY_DATA', data.data)
      } catch (error) {
        throw error
      }
    },
    selcectCompany({ commit, state }, id) {
      router.push({ name: 'Menu', query: { id } })
    },
    async getData({ commit, state, dispatch }) {
      console.log('id ปัจจุบัน')
      console.log(state.form_add.company_id)
      console.log('จบ')
      try {
        const { data } = await state.api.get(`/api/product/show_announce/${state.form_add.company_id} `)
        await commit('SET_DATA', data.data)
      } catch (error) {
        throw error
      }
    },
    async queryProductInfo({ state, commit }) {
      try {
        const { data } = await state.api.get(
          `/api/product/${state.product_id}`,
        )
        commit('SET_PRODUCT_INFO', data.data)
      } catch (error) {
        throw error
      }
    },
    async infoProduct({ state }, id) {
      try {
        router.push({ name: 'productInfo', query: { id } })
      } catch (error) {
        throw error
      }
    },
    async confirmEdit_menu({ state, commit, dispatch }) {
      try {
        if (state.modal_data.price_per_kk !== '') {
          state.self.$swal({
            title: 'แก้ไขประกาศ',
            text: `คุณต้องการแก้ไขข้อมูลสินค้า ${state.modal_data.name} ใช่หรือไม่?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
            customClass: {
              confirmButton: 'btn btn-primary',
              cancelButton: 'btn btn-danger ml-1',
            },
            buttonsStyling: false,
          }).then(result => {
            if (result.isConfirmed) {
              state.api.put(`/api/product/${state.modal_data.id}`, state.modal_data)
              state.self.$swal({
                icon: 'success',
                title: 'แก้ไขข้อมูลสำเร็จ!',
                text: `ข้อมูล ${state.modal_data.name} ถูกแก้ไขสำเร็จ`,
                confirmButtonText: 'ยืนยัน',
                customClass: {
                  confirmButton: 'btn btn-success',
                },
              }).then(result => {
                if (result.isConfirmed) {
                  dispatch('getData')
                }
              })
            }
          })
        } else {
          state.self.$swal({
            title: 'ผิดพลาด!',
            text: ' กรุณากรอกข้อมูลให้ครบถ้วน',
            icon: 'error',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
            customClass: {
              confirmButton: 'btn btn-danger',
            },
            buttonsStyling: false,
          })
        }
      } catch (error) {
        throw error
      }
    },
    async deleteProduct({ state, dispatch }, product) {
      try {
        state.self.$swal({
          title: 'ลบข้อมูลสินค้า',
          text: 'ยืนยันการลบสินค้า',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'ยืนยัน',
          cancelButtonText: 'ยกเลิก',
          customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-danger ml-1',
          },
          buttonsStyling: false,
        }).then(result => {
          if (result.isConfirmed) {
            state.api.delete(
              `/api/product/${product.id}`,
            )
            state.self.$swal({
              icon: 'success',
              title: 'ลบข้อมูลสำเร็จ!',
              confirmButtonText: 'ยืนยัน',
              customClass: {
                confirmButton: 'btn btn-success',
              },
            }).then(result => {
              if (result.isConfirmed) {
                dispatch('getData')
              }
            })
          }
        })
      } catch (error) {
        throw error
      }
    },
    async deletecompany({ commit, state, dispatch }, data) {
      commit('SET_MODAL_DATA_PROFILE_ADD', data)
      try {
        state.self.$swal({
          title: 'ปิดกิจการ',
          text: 'ท่านจะไม่สามารถกลับมาเปิดได้อีก ยืนยันที่จะปิดกิจการหรือไม่ ?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'ยืนยัน',
          cancelButtonText: 'ยกเลิก',
          customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-danger ml-1',
          },
          buttonsStyling: false,
        }).then(result => {
          if (result.isConfirmed) {
            state.api.delete(
              `/api/company/${state.modal_data_profile_add.id}`,
            )
            state.self.$swal({
              icon: 'success',
              title: 'ปิดกิจการสำเร็จ!',
              confirmButtonText: 'ยืนยัน',
              customClass: {
                confirmButton: 'btn btn-success',
              },
            }).then(result => {
              if (result.isConfirmed) {
                dispatch('getCompany')
              }
            })
          }
        })
      } catch (error) {
        throw error
      }
    },
    async pushData({ commit, state }) {
      // method นี้ คลิ๊กที่หน้าบ้าน แล้วมันจะเลือกสินค้าลงไปในตารางที่ 2
      commit('SET_ARRAY_DATA')
    },
    getModalId({ commit }, data) {
      // เมื่อกด "รับ" เอาข้อมูลไปเติมใน modal
      commit('SET_MODAL_DATA', data)
    },
    getModalProfileList({ commit }, data) {
      // เมื่อกด "รับ" เอาข้อมูลไปเติมใน modal
      commit('SET_MODAL_DATA_PROFILE_ADD', data)
    },
    getModalProfile({ commit }, data) {
      // เมื่อกด "รับ" เอาข้อมูลไปเติมใน modal
      commit('SET_MODAL_DATA_EDIT_PROFILE', data)
    },
    async getUser({ commit, state }) {
      try {
        const { data } = await state.api.get(
          '/api/user_data',
        )
        commit('SET_USER', data.data)
      } catch (error) {
        throw error
      }
    },
    async getCompany({ commit, state }) {
      try {
        const { data } = await state.api.get(
          '/api/company',
        )
        commit('SET_COMPANY', data.data)
      } catch (error) {
        throw error
      }
    },
    async edit_profile_add({ state, commit, dispatch }) {
      try {
        if (state.user_data.name !== ''
        && state.user_data.email !== ''
        && state.user_data.ceo_firstname !== ''
        && state.user_data.ceo_lastname !== ''
        && state.user_data.company_tel !== ''
        && state.user_data.amphoe !== ''
        && state.user_data.district !== ''
        && state.user_data.province !== ''
        && state.user_data.postal_code !== ''
        ) {
          state.self.$swal({
            title: 'แก้ไขข้อมูลร้าน',
            text: `คุณต้องการแก้ไขข้อมูลร้าน ${state.user_data.name} ใช่หรือไม่?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
            customClass: {
              confirmButton: 'btn btn-primary',
              cancelButton: 'btn btn-danger ml-1',
            },
            buttonsStyling: false,
          }).then(result => {
            if (result.isConfirmed) {
              state.api.post('/api/company', state.user_data)
              state.self.$swal({
                icon: 'success',
                title: 'แก้ไขข้อมูลสำเร็จ!',
                text: `ข้อมูล ${state.user_data.name} ถูกแก้ไขสำเร็จ`,
                confirmButtonText: 'ยืนยัน',
                customClass: {
                  confirmButton: 'btn btn-success',
                },
              }).then(result => {
                if (result.isConfirmed) {
                  dispatch('getCompany')
                }
              })
            }
          })
        } else {
          state.self.$swal({
            title: 'ผิดพลาด!',
            text: ' กรุณากรอกข้อมูลให้ครบถ้วน',
            icon: 'error',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
            customClass: {
              confirmButton: 'btn btn-danger',
            },
            buttonsStyling: false,
          })
        }
      } catch (error) {
        throw error
      }
    },
    async edit_profile_edit({ state, commit, dispatch }) {
      try {
        if (state.modal_data_profile_add.name !== ''
        && state.modal_data_profile_add.email !== ''
        && state.modal_data_profile_add.ceo_firstname !== ''
        && state.modal_data_profile_add.ceo_lastname !== ''
        && state.modal_data_profile_add.company_tel !== ''
        && state.modal_data_profile_add.amphoe !== ''
        && state.modal_data_profile_add.district !== ''
        && state.modal_data_profile_add.province !== ''
        && state.modal_data_profile_add.postal_code !== ''
        ) {
          state.self.$swal({
            title: 'แก้ไขข้อมูลร้าน',
            text: `คุณต้องการแก้ไขข้อมูลร้าน ${state.modal_data_profile_add.name} ใช่หรือไม่?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
            customClass: {
              confirmButton: 'btn btn-primary',
              cancelButton: 'btn btn-danger ml-1',
            },
            buttonsStyling: false,
          }).then(result => {
            if (result.isConfirmed) {
              state.api.put(`/api/company/${state.modal_data_profile_add.id}`, state.modal_data_profile_add)
              state.self.$swal({
                icon: 'success',
                title: 'แก้ไขข้อมูลสำเร็จ!',
                text: `ข้อมูล ${state.modal_data_profile_add.name} ถูกแก้ไขสำเร็จ`,
                confirmButtonText: 'ยืนยัน',
                customClass: {
                  confirmButton: 'btn btn-success',
                },
              }).then(result => {
                if (result.isConfirmed) {
                  dispatch('getCompany')
                }
              })
            }
          })
        } else {
          state.self.$swal({
            title: 'ผิดพลาด!',
            text: ' กรุณากรอกข้อมูลให้ครบถ้วน',
            icon: 'error',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
            customClass: {
              confirmButton: 'btn btn-danger',
            },
            buttonsStyling: false,
          })
        }
      } catch (error) {
        throw error
      }
    },
    async loadCompanys({ state, commit }, id) {
      try {
        const { data } = await state.api.get(`/api/company/${id}`)
        commit('SET_COMPANY_SELECT', data.data)
      } catch (error) {
        throw error
      }
    },
  },
}
