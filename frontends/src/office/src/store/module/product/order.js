import router from '@/router'

const data = () => ({
  reducer: (accumulator, currentValue) => accumulator + currentValue,
  api: '',
  self: '',
  refs: '',
  node: '',
  product_id: '',
  disable: false,
  modal_order: false,
  partners: [],
  type_data: [{ name: 'ประจำเดือน' }, { name: 'เร่งด่วน' }],
  active_user: '',
  form: {
    partner_id: '',
    type_1: 'ใบสั่งซื้อ',
    user_id: '',
    code: '',
    code_ref: '',
    total_price: '',
    name_th: '',
    type: '',
    status: 'รอยืนยัน',
    setting_master_product_id: '',
    product_details: [],
  },
  temp_order_detail: {
    product_title: '',
    setting_master_product_id: '',
    type: '',
    wholesale_price: '',
    total_price: '',
    amount: 1,
  },
  columns_order: [
    {
      label: 'ชื่อ',
      field: 'product_title',
    },
    {
      label: 'จำนวน',
      field: 'amount',
    },
    {
      label: 'ราคา/ชิ้น',
      field: 'wholesale_price',
    },
    {
      label: 'ราคารวม',
      field: 'total_price',
    },
    {
      label: 'จัดการ',
      field: 'action',
    },
  ],
  columns_order_index: [
    {
      label: 'รหัสใบสั่ง',
      field: 'code',
    },
    {
      label: 'ประเภทใบสั่ง',
      field: 'setting_master_product.title',
    },
    {
      label: 'ราคารวม',
      field: 'total_price',
    },
    {
      label: 'สถานะ',
      field: 'status',
    },
    {
      label: 'ผู้สั่ง',
      field: 'user.name',
    },
    {
      label: 'ผู้รับ',
      field: 'setting_master_customer.name_th',
    },
    {
      label: 'จัดการ',
      field: 'action',
    },
  ],
  columns_edit_order: [
    {
      label: 'ชื่อ',
      field: 'setting_master_product.title',
    },
    {
      label: 'จำนวน',
      field: 'amount',
    },
    {
      label: 'ราคา/ชิ้น',
      field: 'wholesale_price',
    },
    {
      label: 'ราคารวม',
      field: 'total_price',
    },
    {
      label: 'จัดการ',
      field: 'action',
    },
  ],
  temp: {
    selected: '',
    customer_data: [],
    type: [],
  },
  options: [],
  urlGetProduct: '',
  orders: [],
  order_id: '',
  edit_order: {},
  order_detail: [],
  temp_edit_order_detail: {
    order_id: '',
    product_title: '',
    setting_master_product_id: '',
    type: '',
    wholesale_price: '',
    total_price: '',
    amount: 1,
  },
  order: [],
  order_details: [],
  edit: {
    partner_id: '',
    user_id: '',
    setting_master_product_id: '',
    print: '',
  },
  iseki: {},
  partner: {
    customer: {
      customer_contacts: [],
    },
  },
  partner_contacts: '',
  type: '',
  columns_report: [
    {
      label: 'ชื่อ',
      key: 'setting_master_product.title',
    },
    {
      label: 'จำนวน',
      key: 'amount',
    },
    {
      label: 'ราคา/ชิ้น',
      key: 'wholesale_price',
    },
    {
      label: 'ราคารวม',
      key: 'total_price',
    },
  ],
  checked: true,
})
export default {
  namespaced: true,
  state: data(),
  getters: {},
  mutations: {
    SET_API(state, { api, self, refs }) {
      state.api = api
      state.self = self
      state.refs = refs
    },
    SET_ID(state, id) {
      state.order_id = id
    },
    SET_PRODUCT_SETTING(state, data) {
      state.options = data
    },
    SET_PARTNER_DATA(state, data) {
      state.partners = data
    },
    SET_ACTIVE_USER(state, data) {
      state.active_user = data
    },
    SET_ORDER_FORM(state) {
      state.disable = true
      state.form.type = state.temp.type.name
      state.form.name_th = state.temp.selected.name_th
      state.form.user_id = state.active_user.id
      state.form.partner_id = state.temp.customer_data.id
      state.form.setting_master_product_id = state.temp.selected.id
      state.urlGetProduct = `/api/getProduct/${state.form.setting_master_product_id}`
      setTimeout(() => {
        state.modal_order = true
      }, 400)
    },
    SET_EDIT_ORDER_FORM(state) {
      state.urlGetProduct = `/api/getProduct/${state.edit_order.setting_master_product_id}`
      setTimeout(() => {
        state.modal_order = true
      }, 400)
    },
    SET_NODE(state, node) {
      state.node = node
      state.temp_order_detail.wholesale_price = node.retail_price
    },
    SET_EDIT_NODE(state, node) {
      state.node = node
      state.temp_edit_order_detail.wholesale_price = node.retail_price
    },
    SET_TEMP_ORDER_DETAIL(state) {
      state.temp_order_detail.product_title = state.node.title
      state.temp_order_detail.setting_master_product_id = state.node.id
      state.temp_order_detail.total_price = state.temp_order_detail.wholesale_price * state.temp_order_detail.amount
      state.temp_order_detail.type = 'สั่ง'
      state.form.product_details.push({ ...state.temp_order_detail })
    },
    CLEAR_FORM(state) {
      state.modal_order = false
      state.temp_order_detail = data().temp_order_detail
      state.temp_edit_order_detail = data().temp_edit_order_detail
    },
    SET_ORDER_TOTAL_PRICE(state) {
    /* eslint radix: ["error", "as-needed"] */
      state.form.total_price = state.form.product_details.reduce((carry, item) => carry + parseInt(item.total_price), 0)
    },
    CLEAR_ORDER(state) {
      state.temp = data().temp
      state.form = data().form
      state.disable = false
    },
    DELETE_ORDER_DETAIL(state, index) {
      state.form.product_details.splice(index, 1)
    },
    SET_ORDER_DATA(state, data) {
      state.orders = data
    },
    SET_EDIT_ORDER_DATA(state, data) {
      state.edit_order = data
    },
    SET_EDIT_PRODUCT_ORDER(state, data) {
      state.order_detail = data
    },
    SET_ORDER_ID(state) {
      state.modal_order = false
      state.temp_edit_order_detail.order_id = state.order_id
      state.temp_edit_order_detail.setting_master_product_id = state.node.id
      state.temp_edit_order_detail.total_price = state.temp_edit_order_detail.wholesale_price * state.temp_edit_order_detail.amount
      // eslint-disable-next-line operator-assignment
      state.edit_order.total_price = parseInt(state.edit_order.total_price) + parseInt(state.temp_edit_order_detail.total_price)
    //   console.log(state.edit_order.total_price)
    },
    SET_EDIT_ORDER(state) {
      if (state.edit_order.code_ref !== null && state.edit_order.code_ref !== '') {
        state.edit_order.status = 'ยืนยัน'
      }
      state.edit_order.type = state.edit_order.type.name
    },
    DELETE_PRODUCT(state, product) {
      // eslint-disable-next-line operator-assignment
      state.edit_order.total_price = parseInt(state.edit_order.total_price) - parseInt(product.total_price)
      console.log(state.edit_order.total_price)
    },
    SET_EDIT_PRINT(state) {
      state.edit.partner_id = state.order.partner_id
      state.edit.user_id = state.order.user_id
      state.edit.setting_master_product_id = state.order.setting_master_product_id
      state.edit.print = 'สำเร็จ'
    },
    SET_PRINT_COPPY(state) {
      state.type = 'copy'
    },
    SET_PRINT_ORIGINAL(state) {
      state.type = 'original'
    },
    SET_ISEKI_DATA(state, data) {
      state.iseki = data
    },
    SET_PRINT_ORDER(state, data) {
      state.order = data
    },
    SET_PRINT_PARTNER(state, data) {
      state.partner = data
      // eslint-disable-next-line prefer-destructuring
      state.partner_contacts = data.customer.customer_contacts[0]
    },
    SET_PRINT_ORDER_DETAIL(state, data) {
      state.order_details = data
    },
  },
  actions: {
    setApi({ commit }, { api, self, refs }) {
      commit('SET_API', { api, self, refs })
    },
    setId({ commit }, id) {
      commit('SET_ID', id)
    },
    async loadPartnerData({ state, commit }) {
      try {
        const { data } = await state.api.get('/api/partner')
        commit('SET_PARTNER_DATA', data.data)
      } catch (error) {
        throw error
      }
    },
    async getSettingProducts({ state, commit }) {
      try {
        const { data } = await state.api.get('/api/getSetting')
        commit('SET_PRODUCT_SETTING', data.data)
      } catch (error) {
        throw error
      }
    },
    async getLoginUser({ state, commit }) {
      try {
        const { data } = await state.api.get('/api/getLoginUser')
        commit('SET_ACTIVE_USER', data)
      } catch (error) {
        throw error
      }
    },
    async loadProduct({ commit, state }) {
      try {
        if (state.temp.selected !== '' && state.temp.customer_data !== '' && state.temp.type !== '') {
          commit('SET_ORDER_FORM')
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
    nodeSelect({ commit }, node) {
      commit('SET_NODE', node)
    },
    nodeSelectEdit({ commit }, node) {
      commit('SET_EDIT_NODE', node)
    },
    async addOrderDetail({ commit, dispatch }) {
      try {
        commit('SET_TEMP_ORDER_DETAIL')
        dispatch('clearForm')
      } catch (error) {
        throw error
      }
    },
    clearForm({ state, commit }) {
      commit('CLEAR_FORM')
    },
    clearOrder({ commit }) {
      commit('CLEAR_ORDER')
      router.push({ name: 'orderIndex', query: {} })
    },
    async addOrder({ state, commit }) {
      try {
        commit('SET_ORDER_TOTAL_PRICE')
        state.self.$swal({
          title: 'เพิ่มข้อมูลรายการสั่งสินค้า',
          text: `คุณต้องการเพิ่มข้อมูลรายการสั่งสินค้า ${state.form.name_th} ใช่หรือไม่?`,
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
            state.api.post('/api/productorder', state.form)
            state.self.$swal({
              icon: 'success',
              title: 'เพิ่มข้อมูลรายการสั่งสินค้า!',
              text: `ข้อมูลรายการสั่งสินค้า ${state.form.name_th} ถูกเพิ่มสำเร็จ`,
              confirmButtonText: 'ยืนยัน',
              customClass: {
                confirmButton: 'btn btn-success',
              },
            }).then(result => {
              if (result.isConfirmed) {
                commit('CLEAR_ORDER')
                router.push({ name: 'orderIndex', query: {} })
              }
            })
          }
        })
      } catch (error) {
        throw error
      }
    },
    deleteOrderDetail({ commit, state }, index) {
      state.self.$swal({
        title: 'ลบรายการสินค้า',
        text: `คุณต้องการลบรายการสินค้า ${state.form.product_details[index].product_title} ใช่หรือไม่?`,
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
          commit('DELETE_ORDER_DETAIL', index)
          state.self.$swal({
            icon: 'success',
            title: 'ลบรายการสินค้า!',
            text: `ข้อมูลรายการสินค้า ${state.form.product_details[index].product_title} ถูกลบสำเร็จ`,
            confirmButtonText: 'ยืนยัน',
            customClass: {
              confirmButton: 'btn btn-success',
            },
          })
        }
      })
    },
    async loadOrder({ state, commit }) {
      try {
        const { data } = await state.api.get('/api/productorder')
        commit('SET_ORDER_DATA', data.data)
      } catch (error) {
        throw error
      }
    },
    async deleteOrder({ state, dispatch }, order) {
      try {
        state.self.$swal({
          title: 'ลบรายการสินค้า',
          text: `คุณต้องการลบรายการสั่งสินค้ารหัส ${order.code} ใช่หรือไม่?`,
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
            state.api.delete(`/api/productorder/${order.id}`)
            state.self.$swal({
              icon: 'success',
              title: 'ลบรายการสั่งสินค้า!',
              text: `ข้อมูลรายการสั่งสินค้ารหัส ${order.code} ถูกลบสำเร็จ`,
              confirmButtonText: 'ยืนยัน',
              customClass: {
                confirmButton: 'btn btn-success',
              },
            }).then(result => {
              if (result.isConfirmed) {
                dispatch('loadOrder')
              }
            })
          }
        })
      } catch (error) {
        throw error
      }
    },
    async editOrder({ commit }, id) {
      try {
        router.push({ name: 'orderEdit', query: { id } })
      } catch (error) {
        throw error
      }
    },
    async queryOrderData({ state, commit }) {
      try {
        const { data } = await state.api.get(`/api/productorder/${state.order_id}`)
        commit('SET_EDIT_ORDER_DATA', data.data)
      } catch (error) {
        throw error
      }
    },
    async loadProductOrder({ state, commit }) {
      try {
        const { data } = await state.api.get(
          `/api/productorder_detail/${state.order_id}`,
        )
        commit('SET_EDIT_PRODUCT_ORDER', data.data)
      } catch (error) {
        throw error
      }
    },
    async deleteProductOrder({ state, dispatch, commit }, product) {
      try {
        state.self.$swal({
          title: 'ลบรายการสินค้า',
          text: `คุณต้องการลบรายการสินค้า ${product.setting_master_product.title} ใช่หรือไม่?`,
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
            commit('DELETE_PRODUCT', product)
            state.api.delete(
              `/api/productorder_detail/${state.order_id}/${product.id}`,
            )
            state.api.put(`/api/productorder/${state.order_id}`, state.edit_order)
            state.self.$swal({
              icon: 'success',
              title: 'ลบรายการสินค้า!',
              text: `ข้อมูลรายการสินค้า ${product.setting_master_product.title} ถูกลบสำเร็จ`,
              confirmButtonText: 'ยืนยัน',
              customClass: {
                confirmButton: 'btn btn-success',
              },
            }).then(result => {
              if (result.isConfirmed) {
                dispatch('loadProductOrder')
              }
            })
          }
        })
      } catch (error) {
        throw error
      }
    },
    loadEditProduct({ commit }) {
      commit('SET_EDIT_ORDER_FORM')
    },
    async addOrderProduct({ state, dispatch, commit }) {
      try {
        await commit('SET_ORDER_ID')
        await state.api.post(
          `/api/productorder_detail/${state.order_id}`,
          state.temp_edit_order_detail,
        )
        await state.api.put(`/api/productorder/${state.order_id}`, state.edit_order)
        await dispatch('clearForm')
        await dispatch('loadProductOrder')
      } catch (error) {
        throw error
      }
    },
    editOrderData({ state, commit }) {
      try {
        commit('SET_EDIT_ORDER')
        state.self.$swal({
          title: 'แก้ไขข้อมูลรายการสั่งสินค้า',
          text: `คุณต้องการแก้ไขข้อมูลรายการสั่งสินค้ารหัส ${state.edit_order.code} ใช่หรือไม่?`,
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
            state.api.patch(`/api/productorder/${state.order_id}`, state.edit_order)
            state.self.$swal({
              icon: 'success',
              title: 'แก้ไขข้อมูลรายการสั่งสินค้า!',
              text: `ข้อมูลรายการสั่งสินค้ารหัส ${state.edit_order.code} ถูกแก้ไขสำเร็จ`,
              confirmButtonText: 'ยืนยัน',
              customClass: {
                confirmButton: 'btn btn-success',
              },
            }).then(result => {
              if (result.isConfirmed) {
                router.push({ name: 'orderIndex', query: {} })
              }
            })
          }
        })
      } catch (error) {
        throw error
      }
    },
    async printOrder({ commit }, id) {
      try {
        router.push({ name: 'orderReport', query: { id } })
      } catch (error) {
        throw error
      }
    },
    async print({ state, commit, dispatch }) {
      commit('SET_PRINT_ORIGINAL')
      if (state.order.print === 'ไม่สำเร็จ') {
        state.self.$swal({
          title: 'พิมพ์ใบสั่งสินค้า',
          text: 'ใบสั่งต้นฉบับจะสามารถพิมพ์ได้เพียงครั้งเดียว คุณต้องการพิมพ์ใบสั่งสินค้าต้นฉบับใช่หรือไม่?',
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
            dispatch('printOriginalInvoice')
            dispatch('loadOrderData')
            setTimeout(() => {
              window.print()
            }, 400)
          }
        })
      }
    },
    async printOriginalInvoice({ state, commit }) {
      try {
        commit('SET_EDIT_PRINT')
        await state.api.put(`/api/productorder/${state.order_id}`, state.edit)
      } catch (error) {
        throw error
      }
    },
    async printCopyInvoice({ commit }) {
      try {
        commit('SET_PRINT_COPPY')
        setTimeout(() => {
          window.print()
        }, 400)
      } catch (error) {
        throw error
      }
    },
    async loadIsekiContact({ state, commit }) {
      try {
        const { data } = await state.api.get('/api/setting/basic/company')
        commit('SET_ISEKI_DATA', data.data[0])
      } catch (error) {
        throw error
      }
    },
    async loadOrderData({ state, commit }) {
      try {
        const { data } = await state.api.get(`/api/productorder/${state.order_id}`)
        commit('SET_PRINT_ORDER', data.data)
        commit('SET_PRINT_PARTNER', data.data.setting_master_customer)
      } catch (error) {
        throw error
      }
    },
    async loadOrderDetails({ state, commit }) {
      try {
        const { data } = await state.api.get(
          `/api/productorder_detail/${state.order_id}`,
        )
        commit('SET_PRINT_ORDER_DETAIL', data.data)
      } catch (error) {
        throw error
      }
    },
  },
}
