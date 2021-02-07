import router from '@/router'

const master = () => ({
  api: '',
  self: '',
  refs: '',
  customer_type: 'ลูกค้าสมาชิก',
  customer_general: {
    customer_name: '',
    value: '',
    address: '',
    setting_master_contact_id: '920AFDE1-A6E8-4869-BB3A-BD1CB41675CD',
  },
  show_modal: true,
  pageLength: 5,
  option: [],
  order_columns: [
    {
      label: 'รายการ',
      field: 'setting_master_product.name_th',
    },
    {
      label: 'จำนวน',
      field: 'quantity',
    },
    {
      label: 'ราคา',
      field: 'retail_price',
    },
    {
      label: 'ยอดรวม',
      field: 'totalPrice',
    },
    {
      label: 'จัดการ',
      field: 'action',
    },
  ],
  columns: [
    {
      label: 'รหัสรายการขาย',
      field: 'code',
    },
    {
      label: 'ชื่อผู้ขาย',
      field: 'employee.name',
    },
    {
      label: 'ชื่อผู้ซื้อ',
      field: 'customer.customer_name',
    },
    {
      label: 'วันที่',
      field: 'date',
    },
    {
      label: 'ราคารวม',
      field: 'sumPrice',
    },
    {
      label: 'จัดการ',
      field: 'action',
    },
  ],
  sale_products: [],
  customers: [],
  products: [],
  user_id: '',
  user: {},
  quantity_per_round: null,
  tempSale: {
    id: '',
    vin: '',
    quantity: null,
    set_quantity: '',
    setting_master_product: {},
  },
  form: {
    date: new Date(),
    customer_id: '',
    seller_id: '',
    saleTables: [],
    customer: 'กรุณาเลือกลูกค้า',
    code_type: 'ใบขาย',
    print: 'ไม่สำเร็จ',
  },
})
export default {
  namespaced: true,
  state: master(),
  getters: {},
  mutations: {
    SET_API(state, { api, self }) {
      state.api = api
      state.self = self
    },
    SET_REFS(state, refs) {
      state.refs = refs
    },
    SET_SALE_PRODUCT_DATA(state, data) {
      state.sale_products = data
    },
    SET_CUSTOMER_DATA(state, data) {
      state.customers = data
    },
    SET_PRODUCT_DATA(state, data) {
      state.products = data
    },
    SET_USER_ID(state, data) {
      state.user_id = data.id
    },
    SET_USER_DATA(state, data) {
      state.user = data
    },
    CLEAR_ADD_SALE_PRODUCT(state, data) {
      state.form.saleTables = master().form.saleTables
      state.form.customer_id = master().form.customer_id
      state.form.customer = master().form.customer
    },
    ADD_FIRST_PRODUCT(state, product) {
      const products = product
      products.maxQuantity -= 1 * products.setQuantity
      products.quantity = product.setQuantity
      products.setQuantity = 1
      products.totalPrice = products.quantity * products.retail_price
      state.form.saleTables.push(products)
    },
    UPDATE_PRODUCT_QUANTITY_AFTER_FIRST(state, { targetProduct, setQuantity }) {
      console.log('UPDATE_PRODUCT_QUANTITY_AFTER_FIRST')
      const target_product = targetProduct
      const Int_target_product_quantity = target_product.quantity * 1
      target_product.quantity = Int_target_product_quantity
      target_product.quantity += 1 * setQuantity
      target_product.maxQuantity -= 1 * setQuantity
      target_product.totalPrice = target_product.quantity * target_product.retail_price
      target_product.setQuantity = 1
    },
    DELETE_ORDER(state, product) {
      const delete_product = product
      delete_product.setQuantity = 1
      delete_product.maxQuantity += 1 * delete_product.quantity
      const product_quantity = state.products.find(
        product => product.id === delete_product.id,
      )
      product_quantity.maxQuantity = delete_product.maxQuantity
      state.form.saleTables.splice(state.form.saleTables.findIndex(
        p => p.id === delete_product.id,
      ), 1)
    },
  },
  actions: {
    setApi({ commit }, { api, self }) {
      commit('SET_API', { api, self })
    },
    async setUserId({ commit, state }) {
      try {
        const { data } = await state.api.get(
          '/api/getUser',
        )
        commit('SET_USER_ID', data.data)
        if (data.data.length === 0) {
          console.log('empty code')
        }
      } catch (error) {
        throw error
      }
    },
    setRefs({ commit }, refs) {
      commit('SET_REFS', refs)
    },
    printSaleProductReport({ commit }, id) {
      router.push({ name: 'saleProductReport', query: { id } })
    },
    clearAddSaleProduct({ commit }) {
      commit('CLEAR_ADD_SALE_PRODUCT')
    },
    async cancelSaleOrder({ state, dispatch }, data) {
      state.self.$swal({
        title: 'ยกเลิกรายการขาย',
        text: 'คุณต้องการยกเลิกรายการขายนี้ ใช่หรือไม่?',
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
        if (result.value) {
          state.api.delete(
            `/api/saleproduct/${data.id}`,
          )
          state.self.$swal({
            icon: 'success',
            title: 'ยกเลิกรายการขายสำเร็จ',
            text: 'รายการขายถูกยกเลิกสำเร็จ',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
            customClass: {
              confirmButton: 'btn btn-success',
            },
          }).then(result => {
            if (result.value) {
              dispatch('querySaleProductData')
            }
          })
        }
      })
    },
    async insertSaleOrder({ state, dispatch }) {
      if (state.form.customer.id) {
        state.form.seller_id = state.user_id
        state.form.customer_id = state.form.customer.id
        state.self.$swal({
          title: 'เพิ่มรายการสินค้า',
          text: 'คุณต้องการเพิ่มรายการสินค้าใช่หรือไม่?',
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
          if (result.value) {
            state.api.post(
              '/api/saleproduct/', state.form,
            )
            state.self.$swal({
              icon: 'success',
              title: 'เพิ่มรายการสินค้าสำเร็จ',
              text: 'รายการสินค้าถูกเพิ่มสำเร็จ',
              confirmButtonText: 'ยืนยัน',
              cancelButtonText: 'ยกเลิก',
              customClass: {
                confirmButton: 'btn btn-success',
              },
            }).then(result => {
              if (result.value) {
                dispatch('clearAddSaleProduct')
                router.push({ name: 'productSaleIndex', query: { } })
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
    },
    addProduct({ commit, state }, product) {
      const targetProduct = state.form.saleTables.find(item => item.id === product.id)
      if (targetProduct === undefined) {
        commit('ADD_FIRST_PRODUCT', product)
      } else {
        commit('UPDATE_PRODUCT_QUANTITY_AFTER_FIRST', { targetProduct, setQuantity: product.setQuantity })
      }
    },
    async querySaleProductData({ commit, state }) {
      try {
        const { data } = await state.api.get(
          '/api/saleproduct',
        )
        commit('SET_SALE_PRODUCT_DATA', data.data)
        if (data.data.length === 0) {
          console.log('empty code')
        }
      } catch (error) {
        throw error
      }
    },
    async loadCustomer({ commit, state }) {
      try {
        const { data } = await state.api.get(
          '/api/customers',
        )
        commit('SET_CUSTOMER_DATA', data.data)
        if (data.data.length === 0) {
          console.log('empty code')
        }
      } catch (error) {
        throw error
      }
    },
    async loadProduct({ commit, state }) {
      try {
        const { data } = await state.api.get(
          '/api/product',
        )
        commit('SET_PRODUCT_DATA', data.data)
        if (data.data.length === 0) {
          console.log('empty code')
        }
      } catch (error) {
        throw error
      }
    },
    async loadUser({ commit, state }) {
      try {
        const { data } = await state.api.get(
          `/api/user/${state.user_id}`,
        )
        commit('SET_USER_DATA', data.data)
        if (data.data.length === 0) {
          console.log('empty code')
        }
      } catch (error) {
        throw error
      }
    },
    deleteOrder({ commit }, product) {
      commit('DELETE_ORDER', product)
    },
  },
}
