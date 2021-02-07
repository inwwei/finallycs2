<template>
  <div>
    <panel title="Attached">
      <Attached
        ref="test_attached"
        :model-id="dataModelId"
        :model-name="dataModelName"
      />
      <button @click="testUpload">
        Test Upload
      </button>
    </panel>
    <panel title="panel">
      <h1>{{ test }}</h1>
    </panel>
    <panel title="customTreeSelect">
      <custom-tree-select
        ref="tree"
        url="/api/setting/master/product"
      />
    </panel>
    <panel title="Customer Tree">
      <custom-tree
        ref="tree"
        url="/api/setting/master/product"
        :col="12"
        @onDelete="onDelete"
      />
    </panel>
    <validation-observer ref="simpleRules">
      <panel title="Test Form Input">
        <form-input
          v-model="name"
          col="6"
          label="Test"
          placeholder="Test"
          rules="required"
        />
        <form-input
          v-model="name2"
          col="6"
          label="Test2"
          placeholder="Test2"
          rules="required"
        />
        <button @click="validateInput()">
          test
        </button>
      </panel>
    </validation-observer>
    <panel title="nice">
      <vue-select
        v-model="testest"
        :option="option"
        label="test"
        col="12"
      />
    </panel>
  </div>
</template>

<script>
import { mapActions, mapState } from 'vuex'

export default {
  components: {
  },
  data() {
    return {
      dataModelId: '05FBEC0D-1D3B-4270-A00C-D526DFF67D32',
      dataModelName: '\\App\\Models\\Customer',
      name: '',
      name2: '',
      node: '',
      parent: '',
      index: '',
      testest: 'Square',
      option: [{ title: 'nice' }, { title: 'Rectangle' }, { title: 'Rombo' }, { title: 'Romboid' }],
    }
  },
  computed: {
    ...mapState('test', ['test']),
  },
  mounted() {
    this.test1('nice')
  },
  methods: {
    async testUpload() {
      await this.$refs.test_attached.submit()
    },
    async validateInput() {
      console.log(await this.$refs.simpleRules.validate())
    },
    ...mapActions('test', ['test1']),
    async onDelete(node, parent, index) {
      this.node = node
      this.parent = parent
      this.index = index
      this.$swal({
        title: 'ต้องการลบหรือไม่?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ลบ',
        cancelButtonText: 'ยกเลิก',
        customClass: {
          confirmButton: 'btn btn-danger',
          cancelButton: 'btn btn-outline-danger ml-1',
        },
        buttonsStyling: false,
      }).then(result => {
        if (result.value) {
          this.$http.delete(
            `/api/setting/master/product/${this.node.id}`,
          )
          this.$refs.tree.removeNode(this.node, this.parent, this.index)
          this.$swal({
            icon: 'success',
            title: 'ลบสำเร็จ',
            text: 'ทำการลบเสร็จสิ้น',
            confirmButtonText: 'สำเร็จ',
            customClass: {
              confirmButton: 'btn btn-success',
            },
          })
        }
      })
    },
  },
}
</script>
