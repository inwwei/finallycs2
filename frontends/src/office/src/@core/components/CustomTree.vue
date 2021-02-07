<template>
  <div>
    <!-- <vs-input
      v-model.lazy="searchword"
      class="inputx tree-search-input float-left mr-2"
      placeholder="Search..."
    /> -->
    <b-col
      md="6"
      xl="4"
      class="mb-1"
    >
      <!-- basic -->
      <b-form-group
        label-for="basicInput"
      >
        <b-form-input
          v-model.lazy="searchword"
          class="inputx tree-search-input float-left mr-2"
          placeholder="ค้นหา"
        />
      </b-form-group>
    </b-col>
    <b-button
      v-ripple.400="'rgba(255, 255, 255, 0.15)'"
      variant="primary"
      @click="search"
    >
      ค้นหา
    </b-button>
    <v-tree
      ref="tree"
      :radio="true"
      :can-delete-root="false"
      :data="treeData"
      :tpl="tpl"
      :halfcheck="false"
      :select-alone="true"
      @node-click="nodeClick"
      @node-select="nodeSelect"
      @node-expand="nodeExpand"
    />
  </div>
</template>

<script>
import { VTree } from 'vue-tree-halower'
import Ripple from 'vue-ripple-directive'

export default {
  name: 'CustomTree',
  components: {
    VTree,
  },
  directives: {
    Ripple,
  },
  props: {
    name: {
      default: '',
      type: String,
    },
    url: {
      default: '',
      type: String,
    },
  },
  data() {
    return {
      tempExpand: [],
      searchword: '',
      treeData: [],
      // treeData: [
      //   {
      //     title: 'node1',
      //     expanded: true,
      //     children: [
      //       {
      //         title: 'node 1-1',
      //         expanded: false,
      //         children: [
      //           {
      //             title: 'node 1-1-1',
      //             value: '1-1-1'
      //           },
      //           {
      //             title: 'node 1-1-2',
      //             value: '1-1-2'
      //           },
      //           {
      //             title: 'node 1-1-3',
      //             value: '1-1-3'
      //           }
      //         ]
      //       },
      //       {
      //         title: 'node 1-2',
      //         children: [
      //           {
      //             title: '<span style=\'color: red\'>node 1-2-1</span>'
      //           },
      //           {
      //             title: '<span style=\'color: red\'>node 1-2-2</span>'
      //           }
      //         ]
      //       }
      //     ]
      //   }
      // ]
    }
  },
  // created () {
  //   window.addEventListener('unload', this.beforeRefresh)
  // },
  mounted() {
    this.loadData()
  },
  // destroyed () {
  //   this.$destroy()
  // },
  methods: {
    async loadData() {
      try {
        const { data } = await this.$http.get(this.url)
        this.treeData = data.data
        this.loadExpand()
      } catch (error) {
        throw error
      }
    },
    refresh() {
      this.loadData()
    },
    async loadExpand() {
      try {
        this.flatten(this.treeData)
      } catch (error) {
        throw error
      }
    },
    flatten(data) {
      data.forEach(element => {
        if (Array.isArray(element.children) && element.children.length !== 0) {
          this.flatten(element.children)
        }
        if (this.tempExpand.includes(element.id)) {
          // eslint-disable-next-line no-param-reassign
          element.expanded = true
        }
      })
    },
    nodeClick(node) {
      // สร้างเป็น obj ใหม่ และลบ children ออกก่อนจะส่งกลับ
      const tempNode = { ...node }
      delete tempNode.children

      this.$emit('onClick', tempNode)
    },
    nodeSelect(node, selected, position) {
      // สร้างเป็น obj ใหม่ และลบ children ออกก่อนจะส่งกลับ
      const tempNode = { ...node }
      delete tempNode.children

      this.$emit('onSelect', tempNode, selected, position)
    },
    nodeExpand(node, expand) {
      // ตรวจ expand เป็น true|false เพื่อ เพิ่ม/ลบ tempExpand
      if (expand) {
        this.tempExpand.push(node.id)
      } else {
        const temp = this.tempExpand.filter(tempNode => tempNode !== node.id)
        this.tempExpand = temp
      }
    },
    deleteNode(node, parent, index) {
      // ถ้าเป็นหัวข้อที่มีลูกได้จะไม่ให้ลบ แต่ถ้าไม่มีลูกจะให้ลบได้
      if (Array.isArray(node.children) && node.children.length) {
        this.$swal({
          title: 'ลบไม่สำเร็จ',
          text: ' โปรดลบตัวลูกก่อน',
          icon: 'error',
          customClass: {
            confirmButton: 'btn btn-primary',
          },
          buttonsStyling: false,
        })
        return ''
      }

      // สร้างเป็น obj ใหม่ และลบ children ออกก่อนจะส่งกลับ
      const tempNode = { ...node }
      delete tempNode.children
      this.$emit('onDelete', tempNode, parent, index)
      return ''
    },
    newNode(node) {
      if (!node.id) {
        this.$vs.notify({
          color: 'danger',
          title: 'ไม่สามารถเพิ่มลูกได้ เพราะยังไม่ได้บันทึก',
          text: '',
        })
      }
      const tempRefId = node.id
      this.$refs.tree.addNode(node, { title: 'sync node', ref_id: tempRefId })
    },
    removeNode(node, parent, index) {
      this.$refs.tree.delNode(node, parent, index)
    },
    search() {
      this.$refs.tree.searchNodes(this.searchword)
    },
    tpl(...args) {
      const { 0: node, 2: parent, 3: index } = args
      // const tempRefId = parent ? parent.id : node.id
      let titleClass = node.selected ? 'node-title node-selected' : 'node-title'
      if (node.searched) titleClass += ' node-searched'
      return (
        <span>
          <span
            class={titleClass}
            domPropsInnerHTML={node.title}
            onClick={() => {
              this.$refs.tree.nodeSelected(node)
            }}
          ></span>
          <button
            class="btn-async text-warning rounded"
            style="border-style: none"
            onClick={() => this.newNode(node)
            }
          >
            เพิ่มลูก
          </button>
          <button
            class="btn-delete text-danger rounded"
            style="border-style: none"
            onClick={() => this.deleteNode(node, parent, index)}
          >
            ลบ
          </button>
        </span>
      )
    },
  },
}
</script>

<style lang="scss">
@import "@core/scss/vue/tree.scss";

button.btn-async {
  background: rgba(var(--vs-warning), 0.15);
}

button.btn-delete {
  background: rgba(var(--vs-danger), 0.15);
}
</style>
