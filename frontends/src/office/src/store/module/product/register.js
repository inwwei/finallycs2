import router from '@/router'

const data = () => ({
  api: '',
  self: '',
  refs: '',
  test: 'ss',
  form_register: {
    status: '',
    username: '',
    userEmail: '',
    password: '',
  },
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

  },
  actions: {

    setApi({ commit }, { api, self, refs }) {
      commit('SET_API', { api, self, refs })
    },
    async register_add({ state, commit, dispatch }) {
      console.log('555')
      try {
        const result = await state.refs.simpleRules.validate()
        if (result) {
          if (state.form_add.price !== '' && state.form_add.Plant_select !== '') {
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
        if (state.modal_data.price !== '') {
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
