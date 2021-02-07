<template>
  <div>
    <panel title="เพิ่มข้อมูลสมาชิก">
      <b-form>
        <validation-observer ref="simpleRules">
          <b-row>
            <form-input
              v-model="add.customer_name"
              col="4"
              label="ชื่อ-นามสกุล"
              placeholder="ชื่อ-นามสกุล"
              rules="required"
            />
            <form-input
              v-model="add.tax_id"
              class="mb-1"
              col="4"
              label="หมายเลขผู้เสียภาษี(ถ้ามี)"
              placeholder="หมายเลขผู้เสียภาษี"
              rules="required"
            />
            <form-input
              v-model="add.identification_number"
              col="4"
              label="หมายเลขบัตรชาชน"
              placeholder="หมายเลขบัตรชาชน"
              rules="required"
            />
            <b-col md="4">
              <custom-tree-select
                ref="tree"
                v-model="add.setting_master_customer_id"
                label="สถานะสมาชิก*"
                url="/api/setting/master/customer"
              />
            </b-col>
            <b-col
              md="4"
              class="my-1"
            >
              <vue-select
                v-model="add.selected"
                :option="add.option"
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
    <add-contact />
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
    AddContact: () => import('./components/AddContact.vue'),
  },
  data() {
    return {

    }
  },
  computed: {
    ...mapState('customer', ['add', 'dataModelId', 'dataModelName']),
  },
  methods: {
    async testUpload() {
      await this.$refs.test_attached.submit()
    },
    ...mapActions('customer', ['setApi', 'setRefs', 'loadBranch']),
  },
  mounted() {
    this.setApi({ api: this.$http, self: this })
    this.setRefs(this.$refs)
    setTimeout(() => {
      this.loadBranch()
    }, 0)
  },
}
</script>
