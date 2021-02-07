import router from '@/router'

const master = () => ({
  api: '',
  self: '',
  report_id: '',
  pageLength: 5,
  saleProductData: {},
  saleProductDetail: [],
  sale_id: '',
  customerData: {},
  customerContact: [],
  order: [],
  reportValue: 'ไม่ระบุเบอร์ติดต่อ',
  reportTitle: 'ไม่ระบุที่อยู่',
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
      label: 'รหัสสินค้า',
      key: 'product.vin',
    },
    {
      label: 'รายละเอียด',
      key: 'product.name',
    },
    {
      label: 'จำนวน',
      key: 'amount',
    },
    {
      label: 'ราคาต่อหน่วย',
      key: 'product.retail_price',
    },
    {
      label: 'ส่วนลด',
      key: 'discount',
    },
    {
      label: 'จำนวนเงิน',
      key: 'totalPrice',
    },
  ],
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
    SET_ID(state, id) {
      state.report_id = id
    },
    SET_SALE_PRODUCT_DETAIL(state, data) {
      state.saleProductData = data.data
      state.customerData = state.saleProductData.customer
      //   state.saleProductDetail = state.saleProductData.sale_product_detail
      state.customerData.value = ''
    },
    SET_CUSTOMER_CONTACT_DATA(state, data) {
      state.reportTitle = master().reportTitle
      state.reportValue = master().reportValue
      const title = data.find(
        data => data.house_number !== null,
      )
      const value = data.find(
        data => data.value !== '',
      )
      if (title) {
        state.reportTitle = title.title
      } if (value) {
        state.reportValue = value.value
      }
    },
    SET_EDIT_PRINT(state) {
      state.edit.customer_id = state.saleProductData.customer_id
      state.edit.seller_id = state.saleProductData.seller_id
      state.sale_id = state.saleProductData.id
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
      state.partner_contacts = data[0].customer_contacts
    },
    SET_PRINT_ORDER_DETAIL(state, data) {
      state.order_details = data
    },
    SALE_PRODUCT_DETAILS(state, data) {
      state.saleProductDetail = data
    },
  },
  actions: {
    setApi({ commit }, { api, self }) {
      commit('SET_API', { api, self })
    },
    setRefs({ commit }, refs) {
      commit('SET_REFS', refs)
    },
    setId({ commit }, id) {
      commit('SET_ID', id)
    },
    async print({ state, commit, dispatch }) {
      commit('SET_PRINT_ORIGINAL')
      if (state.saleProductData.print === 'ไม่สำเร็จ') {
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
            dispatch('loadSaleProductDetail', state.report_id)
            setTimeout(() => {
              window.print()
            }, 400)
          }
        })
      }
    },
    async loadSaleProductDetail({ commit, state, dispatch }, id) {
      dispatch('setId', id)
      const data = await state.api.get(`/api/saleproduct/${id}`)
      commit('SET_SALE_PRODUCT_DETAIL', data.data)
    },
    async printOriginalInvoice({ state, commit }) {
      try {
        commit('SET_EDIT_PRINT')
        console.log(state.sale_id)
        await state.api.put(`/api/saleproduct/${state.sale_id}`, state.edit)
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
    async loadCustomerContact({ state, commit }) {
      const customer_id = state.saleProductData.customer.id
      try {
        const { data } = await state.api.get(`/api/customercontacts/${customer_id}`)
        commit('SET_CUSTOMER_CONTACT_DATA', data.data)
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
    async loadSaleDetails({ state, commit }) {
      console.log(state.report_id)
      try {
        const { data } = await state.api.get(
          `api/saleproductdetail/${state.report_id}`,
        )
        commit('SALE_PRODUCT_DETAILS', data.data)
      } catch (error) {
        throw error
      }
    },
  },
}
