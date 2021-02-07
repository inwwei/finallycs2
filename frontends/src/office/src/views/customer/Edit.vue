<template>
  <div>
    <panel title="แก้ไขข้อมูลสมาชิก">
      <b-form>
        <validation-observer ref="simpleRules">
          <b-row>
            <form-input
              v-model="edit.customer_name"
              col="4"
              label="ชื่อ-นามสกุล"
              placeholder="ชื่อ-นามสกุล"
              rules="required"
            />
            <form-input
              v-model="edit.tax_id"
              class="mb-1"
              col="4"
              label="หมายเลขผู้เสียภาษี(ถ้ามี)"
              placeholder="หมายเลขผู้เสียภาษี"
              rules="required"
            />
            <form-input
              v-model="edit.identification_number"
              col="4"
              label="หมายเลขบัตรชาชน"
              placeholder="หมายเลขบัตรชาชน"
              rules="required"
            />
            <b-col md="4">
              <custom-tree-select
                ref="tree"
                v-model="edit.setting_master_customer_id"
                label="สถานะสมาชิก*"
                url="/api/setting/master/customer"
              />
            </b-col>
            <b-col
              md="4"
              class="my-1"
            >
              <vue-select
                v-model="edit.setting_basic_branch"
                :option="option"
                label="สาขา*"
                title="branch_name"
              />
            </b-col>
          </b-row>
          <b-row>
            <Attached
              ref="test_attached"
              :model-id="dataModelId"
              :model-name="dataModelName"
            />
          </b-row>
        </validation-observer>
      </b-form>
    </panel>
    <edit-contact />
  </div>
</template>
<script>
import { mapActions, mapState } from 'vuex'
import Ripple from 'vue-ripple-directive'

export default {
  directives: {
    Ripple,
  },
  components: {
    EditContact: () => import('./components/EditContact.vue'),
  },
  computed: {
    ...mapState('editCustomer', ['edit', 'id', 'option', 'dataModelName', 'dataModelId']),
  },
  destroyed() {
    this.clearEditForm()
  },
  mounted() {
    this.setApi({ api: this.$http, self: this })
    setTimeout(() => {
      this.loadCustomer(this.$route.query.id)
      this.setDataModelId(this.$route.query.id)
    }, 200)
    this.loadBranch()
    this.setRefs(this.$refs)
  },
  methods: {
    ...mapActions('editCustomer', ['setApi', 'loadCustomer', 'loadBranch', 'backToIndex', 'setRefs', 'setDataModelId', 'clearEditForm']),
  },
}
</script>
