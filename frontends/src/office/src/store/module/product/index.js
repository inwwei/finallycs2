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
  form: {
    Plant_select: '',
    first_date: '',
    end_date: '',
  },
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
})
export default {
  namespaced: true,
  state: data(),
  getters: {
  },
  mutations: {
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
    SET_ID(state, id) {
      state.product_id = id
    },
    SET_PLANT(state, data) {
      state.Plants = data
    },
    SET_BRANCH_ID(state, product_info) {
      state.product_info.setting_basic_branch_id = product_info.setting_basic_branch.id
    },
  },
  actions: {
    setEditData({ commit, dispatch }, product_info) {
      commit('SET_PLANT_ID', product_info)
      dispatch('editProductData')
    },
    nodeSelect({ commit }, node) {
      commit('SET_NODE', node)
    },
    setId({ commit }, id) {
    //   console.log(id)
      commit('SET_ID', id)
    },
    setApi({ commit }, { api, self, refs }) {
      commit('SET_API', { api, self, refs })
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
        // console.log(data.data)
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
    async editProduct({ state }, id) {
      try {
        router.push({ name: 'productEdit', query: { id } })
      } catch (error) {
        throw error
      }
    },

    async editProductData({ state, commit }) {
      try {
        if (state.product_info.setting_master_product_id !== '' && state.product_info.setting_basic_branch_id !== '') {
          state.self.$swal({
            title: 'แก้ไขข้อมูลสินค้า',
            text: `คุณต้องการแก้ไขข้อมูลสินค้า ${state.product_info.name} ใช่หรือไม่?`,
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
              state.api.put(`/api/product/${state.product_info.id}`, state.product_info)
              state.self.$swal({
                icon: 'success',
                title: 'แก้ไขข้อมูลสินค้าสำเร็จ!',
                text: `ข้อมูลสินค้า ${state.product_info.name} ถูกแก้ไขสำเร็จ`,
                confirmButtonText: 'ยืนยัน',
                customClass: {
                  confirmButton: 'btn btn-success',
                },
              }).then(result => {
                if (result.isConfirmed) {
                  commit('SET_USER_DATA_NULL')
                  router.push({ name: 'productIndex', query: {} })
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
  },
}
