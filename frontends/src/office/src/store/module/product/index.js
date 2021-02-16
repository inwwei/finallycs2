import router from '@/router'

const data = () => ({
  api: '',
  self: '',
  refs: '',
  test: '',
  request_data: [],
  request_detail: [],
  products: [],
  product_id: '',
  Plants: [],
  form_add: {
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
  user_data: {},
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
  columns_menu: [
    {
      label: 'ชื่อ',
      field: 'name',
    },
    {
      label: 'ราคา/กก.',
      field: 'price_per_kk',
    },
    {
      label: 'หักความชื้น (ร้อยละ)',
      field: 'moisture',
    },
    {
      label: 'ความชื้นต่ำสุด',
      field: 'moisture_min',
    },
    {
      label: 'ความชื้นสูงสุด',
      field: 'moisture_max',
    },
    {
      label: 'หักสิ่งแปลกปลอม (ร้อยละ)',
      field: 'Foreign_matter',
    },
    {
      label: 'จัดการ',
      field: 'manage',
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
    SET_DATA(state, products) {
      state.products = products
    },
    SET_NAME(state) {
      state.form_add.name = state.form_add.Plant_select.name
    },
    SET_USER(state, data) {
      state.user_data = data
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
    SET_MODAL_DATA_EDIT_PROFILE(state, data) {
      // set ข้อมูลที่มาจากหน้าบ้านในส่วนของ modal ให้เข้าไปในตัวแปร modal_data
      state.modal_data_profile = data
    },

  },
  actions: {
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
                if (result.isConfirmed) {
                  dispatch('getData')
                }
              })
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
        console.log(state.form.Plant_select.code)
        console.log(state.form.first_date)
        console.log(state.form.end_date)
        const { data } = await state.api.get(`https://dataapi.moc.go.th/gis-product-prices?product_id=${state.form.Plant_select.code}&from_date=${state.form.first_date}&to_date=${state.form.end_date}`)
        commit('SET_DATA_REQUEST', data)
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
    async getData({ commit, state }) {
      try {
        const { data } = await state.api.get('/api/product')
        commit('SET_DATA', data.data)
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
    // async editProduct({ state }, id) {
    //   try {
    //     router.push({ name: 'productEdit', query: { id } })
    //   } catch (error) {
    //     throw error
    //   }
    // },
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
    async pushData({ commit, state }) {
      // method นี้ คลิ๊กที่หน้าบ้าน แล้วมันจะเลือกสินค้าลงไปในตารางที่ 2
      commit('SET_ARRAY_DATA')
    },

    getModalId({ commit }, data) {
      // เมื่อกด "รับ" เอาข้อมูลไปเติมใน modal
      commit('SET_MODAL_DATA', data)
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

    async edit_profile({ state, commit, dispatch }) {
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
            title: 'แก้ไขประกาศ',
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
              state.api.put(`/api/user_data/${state.user_data.id}`, state.user_data)
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

  },
}
