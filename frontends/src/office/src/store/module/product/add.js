import router from '@/router'

const data = () => ({
  self: '',
  refs: '',
  form: {
    setting_master_product_id: '',
    setting_basic_branch_id: '',
    shipping_price: '',
    machine_code: '',
    vin: '',
    description: '',
    quantity: null,
    retail_price: null,
    wholesale_price: null,
    tags: '',
    date: '',
    type: '',
    type_received: 'เพิ่ม',
    setting_master_product: {
      name_th: '',
      name_en: '',
    },
    Branch: [],
  },
  typeProduct: {},
  api: '',
  Branch: [],
  pageLength: 5,
  columns: [
    {
      label: 'รหัสสินค้า',
      field: 'setting_master_product.code',
    },
    {
      label: 'ชื่อ(TH)',
      field: 'setting_master_product.name_th',
    },
    {
      label: 'ชื่อ(EN)',
      field: 'setting_master_product.name_en',
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
      label: 'ราคาปลีก',
      field: 'retail_price',
    },
    {
      label: 'ราคาส่ง',
      field: 'wholesale_price',
    },
    {
      label: 'แท๊ก',
      field: 'tags',
    },

  ],
})
export default {
  namespaced: true,
  state: data(),
  getters: {},
  mutations: {
    SET_TYPE_PRODUCT(state, node) {
      state.form.setting_master_product.name_th = node.name_th
      state.form.setting_master_product.name_en = node.name_en
      state.form.setting_master_product_id = node.id
      state.form.retail_price = node.retail_price
      state.form.type = node.type
    },
    SET_REFS(state, refs) {
      state.refs = refs
    },
    SET_API(state, { api, self }) {
      state.api = api
      state.self = self
    },
    SET_BRANCH(state, Branch) {
      state.Branch = Branch
    },
    SET_ADD_DATA(state, form) {
      state.form.setting_basic_branch_id = form.Branch.id
    },
  },
  actions: {
    typeProduct({ commit }, node) {
      commit('SET_TYPE_PRODUCT', node)
    },
    setApi({ commit }, { api, self }) {
      commit('SET_API', { api, self })
    },
    setRefs({ commit }, refs) {
      commit('SET_REFS', refs)
    },
    setProductData({ commit, dispatch }, form) {
      commit('SET_ADD_DATA', form)
      dispatch('addProduct')
    },
    async addProduct({ state, commit }) {
      try {
        const result = await state.refs.simpleRules.validate()
        if (result) {
          if (state.form.setting_master_product_id !== '' && state.form.setting_basic_branch_id !== undefined) {
            state.self.$swal({
              title: 'เพิ่มข้อมูลสินค้า',
              text: `คุณต้องการเพิ่มข้อมูลสินค้า ${state.form.setting_master_product.name_th} ( ${state.form.setting_master_product.name_en} )ใช่หรือไม่?`,
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
                if (state.form.quantity == null) {
                  state.form.quantity = 1
                }
                state.api.post('/api/product', state.form)
                state.self.$swal({
                  icon: 'success',
                  title: 'เพิ่มข้อมูลสินค้าสำเร็จ!',
                  text: `ข้อมูลสินค้า ${state.form.setting_master_product.name_th} ( ${state.form.setting_master_product.name_en} ) ถูกเพิ่มสำเร็จ`,
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

    async getSettingBasicBranch({ commit, state }) {
      try {
        const { data } = await state.api.get(
          '/api/setting/basic/branch',
        )
        commit('SET_BRANCH', data.data)
      } catch (error) {
        throw error
      }
    },

  },
}
