import router from '@/router'

const data = () => ({
  price: {
    shipping_price: 0,
  },
  api: '',
  self: '',
  refs: '',
  test: [],
  pageLength: 5,
  receive: {
    // ฟอร์มกรอกส่วนหัว
    id: '',
    ref_id: '',
    name_th: '',
    name_en: null,
    title: '',
    receiver: '',
    receive_date: null,
    partner: [],
    product_type: {
      title: '',
    },
  },
  type: [],

  modal_data: {
    // เก็บข้อมูลใน modal_data
    received_date: '',
    quantity: 0,
    receiver: '',
    id: '',
    new_amount_recieve: 1,
    setting_basic_branch_id: '',
    branch: {
      id: '',
    },
    recieve_date: '',
    description: '',
    vin: '',
    serial_number: '',
    amount: null,
    amount_recieve: 0,
    wholesale_price: null,
    total_price: null,
    shipping_price: null,
    cost_price: null,
    type: '',
    setting_master_product: {
      id: '',
      ref_id: '',
      code: '',
      name_th: '',
      name_en: '',
      retail_price: null,
      type: '',
      title: '',
    },
    order: {
      id: '',
      partner_id: '',
      user_id: '',
      setting_master_product_id: '',
      code: '',
      code_ref: '',
      total_price: null,
      type: '',
      date: null,
    },
  },
  product_id: '',
  Branch: [], // เลือกรับลงสาขาใด
  partner: [], // ดึง partner มาเพื่อให้เลือกว่าจะรับสินค้าจาก partner คนไหน
  user: [],
  date: '',
  order_partner_success: [],
  order_partner: [], // ใช้ตอน ดึงข้อมูลรายการสินค้าที่สามารถรับได้ มาเก็บไว้ที่นี้
  object_recieve: [], // ใช้เก็บสินค้าที่เลือกรับแล้ว
  columns: [
    {
      label: 'รหัสใบสั่ง',
      field: 'order.code',
    },
    {
      label: 'รหัสสินค้า',
      field: 'setting_master_product.code',
    },
    {
      label: 'ชื่อรายการ',
      field: 'setting_master_product.title',
    },
    {
      label: 'จำนวน',
      field: 'amount',
    },
    {
      label: 'ราคาส่ง',
      field: 'wholesale_price',
    },
    {
      label: 'จัดการ',
      field: 'manage',
    },
  ],
  columns_success: [
    {
      label: 'รายการสินค้า',
      field: 'setting_master_product.title',
    },
    {
      label: 'รหัสสินค้า',
      field: 'setting_master_product.code',
    },
    {
      label: 'เลขตัวถัง',
      field: 'vin',
    },
    {
      label: 'รายละเอียด',
      field: 'description',
    },
    {
      label: 'จำนวน',
      field: 'quantity',
    },

    {
      label: 'ราคาส่ง',
      field: 'wholesale_price',
    },
    {
      label: 'ราคาขายปลีก',
      field: 'setting_master_product.retail_price',
    },
    {
      label: 'วันที่รับ',
      field: 'received_date',
    },
  ],
  columns_selected: [
    // เอาไปใช้ในตาสรางที่ 2
    {
      label: 'รายการสินค้า',
      field: 'setting_master_product.title',
    },
    {
      label: 'รหัสสินค้า',
      field: 'setting_master_product.code',
    },
    {
      label: 'เลขตัวถัง',
      field: 'vin',
    },
    {
      label: 'รายละเอียด',
      field: 'description',
    },
    {
      label: 'จำนวน',
      field: 'amount',
    },
    {
      label: 'ราคารับมา',
      field: 'cost_price',
    },
    {
      label: 'ราคาส่ง',
      field: 'wholesale_price',
    },
    {
      label: 'วันที่ผลิต',
      field: 'date',
    },
  ],
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

    SET_PARTNER(state, data) {
      // set คู่ค้าเข้าตังแปร ส่งไปให้หน้าบ้าน เพื่อให้ผู้ใช้เอาไว้เลือกว่า จะรับของที่สั่งกับคู่ค้าคนไหน
      state.partner = data
    },
    SET_BRANCH(state, Branch) {
      // set สาขา ส่งไปที่หน้าบ้านเพือให้ผู้ใช้เลือกว่าตัวเองจะเอาของลงสาขาไหน
      state.Branch = Branch
    },
    SET_ORDER_PARTNER(state, data) {
      // set รายการเข้าตัวแปร ส่งไปหน้าบ้าน
      state.order_partner = data
    },

    SET_ORDER_PARTNER_SUCCESS(state, data) {
      // set รายการเข้าตัวแปร ส่งไปหน้าบ้าน
      state.order_partner_success = data
      //   state.date = state.order_partner_success.received_date
      //   state.state.order_partner_success.received_date = state.self.convertDateToThai('2021-02-03', { fulldate: true })
    },

    SET_USER(state, data) {
      // setผู้ใช้ เอาไว้เป็นคนรับสินค้า
      state.user = data
    },
    SET_MODAL_DATA(state, data) {
      // set ข้อมูลที่มาจากหน้าบ้านในส่วนของ modal ให้เข้าไปในตัวแปร modal_data
      state.modal_data = data
      state.modal_data.quantity = 1
      const today = new Date()
      const date = `${today.getFullYear()}-${today.getMonth()
                + 1}-${today.getDate()}`
      state.modal_data.received_date = date

      //   state.modal_data.setting_basic_branch_id = state.modal_data.branch.id
    },
    SET_ARRAY_DATA(state, data) {
      // set ข้อมูลที่มาจากหน้าบ้านในส่วนของ ตารางที่ 1 ให้ไปเก็บที่ object_recieve เพื่อเอาไว้แสดงใน ตารางที่ 2
      //   state.modal_data.setting_basic_branch_id = state.modal_data.branch.id
      //   console.log(state.modal_data.setting_basic_branch_id)
      //   state.object_recieve
      state.object_recieve.push({ ...state.modal_data })
    },
  },
  actions: {
    async conFirmReceive({ state, commit }) {
      try {
        const result = true
        // await state.refs.simpleRules.validate()
        if (result) {
          //   console.log(state.object_recieve[0])
          if (state.object_recieve[0] !== undefined) {
            state.self
              .$swal({
                title: 'เพิ่มข้อมูลสินค้า',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
                customClass: {
                  confirmButton: 'btn btn-primary',
                  cancelButton: 'btn btn-danger ml-1',
                },
                buttonsStyling: false,
              })
              .then(result => {
                if (result.isConfirmed) {
                  // if (state.object_recieve.quantity == null) {
                  //   state.object_recieve.quantity = 1
                  // }
                  state.api.post(
                    `/api/product/received/${state.price.shipping_price}`,
                    state.object_recieve,
                  )
                  state.self.$swal({
                    icon: 'success',
                    title: 'เพิ่มข้อมูลสินค้าสำเร็จ!',
                    confirmButtonText: 'ยืนยัน',
                    customClass: {
                      confirmButton: 'btn btn-success',
                    },
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

    async pushData({ commit, state }) {
      // method นี้ คลิ๊กที่หน้าบ้าน แล้วมันจะเลืออกสินค้าลงไปในตารางที่ 2
      state.self.$swal({
        icon: 'success',
        title: 'เลือกสินค้าสำเร็จ!',
        text: `ข้อมูลสินค้า ${state.modal_data.setting_master_product.title}`,
        confirmButtonText: 'ยืนยัน',
        customClass: {
          confirmButton: 'btn btn-success',
        },
      })
      commit('SET_ARRAY_DATA')
    },
    nodeSelect({ commit }, node) {
      commit('SET_NODE', node)
    },
    setApi({ commit }, { api, self, refs }) {
      commit('SET_API', { api, self, refs })
    },
    async getPartner({ commit, state }) {
      // method นี้สร้างเพื่อไปดึงข้อมูล คู่ค้าที่เราได้ทำการสั่งสินค้า
      try {
        const { data } = await state.api.get('/api/partner')
        commit('SET_PARTNER', data.data)
      } catch (error) {
        throw error
      }
    },

    // dispatch('queryCustomerData')

    getModalId({ commit }, data) {
      // เมื่อกด "รับ" เอาข้อมูลไปเติมใน modal
      commit('SET_MODAL_DATA', data)
    },

    async queryOrderPartner({ commit, state }) {
      // method นี้สร้างเพื่อรายการของทั้งหมด ที่สั่งกับคู่ค้าใด ๆ
      try {
        const { data } = await state.api.post(
          `/api/product/receive/${state.receive.partner.id}`,
          state.receive,
        )
        commit('SET_ORDER_PARTNER', data.data)
      } catch (error) {
        throw error
      }
    },
    async queryOrderPartnerSuccess({ commit, state }) {
      // method นี้สร้างเพื่อรายการของทั้งหมด ที่สั่งกับคู่ค้าใด ๆ
      try {
        const { data } = await state.api.get('/api/product/receive')
        commit('SET_ORDER_PARTNER_SUCCESS', data.data)
      } catch (error) {
        throw error
      }
    },

    async getSettingBasicBranch({ commit, state }) {
      // method นี้สร้างเพื่อดึงสาขามาให้เลือก ว่าจะรับของลงสาขาไหน
      try {
        const { data } = await state.api.get(
          '/api/setting/basic/branch',
        )
        commit('SET_BRANCH', data.data)
      } catch (error) {
        throw error
      }
    },

    async getUser({ commit, state }) {
      // method นี้สร้างเพื่อดึงสาขามาให้เลือก ว่าจะรับของลงสาขาไหน
      try {
        const { data } = await state.api.get('/api/getUser')
        commit('SET_USER', data.data)
      } catch (error) {
        throw error
      }
    },
  },
}
