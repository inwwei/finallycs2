<template>
  <div :class="`w-${xcol}`">
    <label class="custom_label_for_treeselect">{{ label }}</label>
    <v-select-tree
      ref="selecttree"
      class="custom_treeselect zindex"
      pleasechoosetext="กรุณาเลือก"
      searchtext="ค้นหา"
      :multiple="false"
      :radio="true"
      :data="treeData"
      @node-select="nodeSelect"
    />
  </div>
</template>
<script>
import { VSelectTree } from 'vue-tree-halower'

export default {
  name: 'CustomTreeSelect',
  components: {
    VSelectTree,
  },
  props: {
    label: {
      default: '',
      type: String,
    },
    name: {
      default: '',
      type: String,
    },
    url: {
      default: '',
      type: String,
    },
    col: {
      default: 1,
      type: Number,
    },
    value: {
      default: '',
      type: String,
    },
  },
  data() {
    return {
      nodeData: {},
      inputData: '',
      treeData: [],
    }
  },
  computed: {
    xcol() {
      if (this.col === '12') {
        return 'full'
      }
      return `${this.col}/12`
    },
  },
  watch: {
    inputData: {
      immediate: true,
      handler(val) {
        this.xHandlerInput(val)
      },
    },
    value: {
      immediate: true,
      handler(val) {
        if (val) {
          this.updateSelctNode()
        }
      },
    },
  },
  mounted() {
    this.loadData()
  },
  methods: {
    async loadData() {
      try {
        const { data } = await this.$http.get(this.url)
        this.treeData = data.data
      } catch (error) {
        throw error
      }
    },
    refresh() {
      this.loadData()
    },
    updateSelctNode() {
      this.flatten(this.treeData)
    },
    flatten(data) {
      data.forEach(element => {
        if (Array.isArray(element.children) && element.children.length !== 0) {
          this.flatten(element.children)
        }
        if (element.id === this.value) {
          this.$refs.selecttree.selectedItems = [element.title]
        }
      })
    },
    nodeSelect(node, selected, position) {
      this.inputData = node.id
      this.$refs.selecttree.open = false

      this.nodeData = node
      this.$emit('node-select', node)
    },
    xHandlerInput(value) {
      if (value) {
        this.$emit('input', this.inputData)
      } else {
        this.$emit('input', value)
      }
    },
  },
}
</script>

<style lang="scss">
@import "@core/scss/vue/tree.scss";

.zindex {
  z-index: 1000;
}
.tree-container {
  height: 37px;
  border-radius: 5px;
  border: 1px solid rgba(0, 0, 0, 0.2);
}

.tree-container {
  position: relative;
  width: 100%;
  height: 36px;
}

.tree-box {
  background: #fff;
  position: relative;
  z-index: 9;
  padding-left: 3px;
}
.search-input {
  margin-top: 10px;
  width: 98%;
  display: block;
}
.rmNode {
  background-color: rgba(var(--vs-danger), 0.15);
  color: rgba(var(--vs-danger), 1);
  line-height: 13px;
}

.custom_treeselect {
  margin-top: 18px;
}

.custom_label_for_treeselect {
  font-weight: 200;
  font-size: 0.9rem;
  color: rgba(0, 0, 0, 0.753);
  position: absolute;
  margin-top: -23px;
}
</style>
