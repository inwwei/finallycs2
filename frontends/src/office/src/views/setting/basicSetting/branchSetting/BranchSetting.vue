<template>
  <b-card>
    <!-- search input -->
    <div class="custom-search d-flex justify-content-end">
      <b-form-group>
        <div class="d-flex align-items-center">
          <label class="mr-1">ค้นหา</label>
          <b-form-input
            v-model="searchTerm"
            placeholder="ค้นหา"
            type="text"
            class="d-inline-block mr-1"
          />
          <b-button
            v-ripple.400="'rgba(113, 102, 240, 0.15)'"
            variant="primary"
            style="width:210px;"
            @click="openAddBranchModal()"
          >
            <span class="align-middle">เพิ่มข้อมูล</span>
          </b-button>
        </div>
      </b-form-group>
    </div>
    <b-col cols="12">
      <vue-good-table
        :columns="branch_column"
        :rows="branch"
        :rtl="direction"
        :search-options="{
          enabled: true,
          externalQuery: searchTerm }"
        :pagination-options="{
          enabled: true,
          perPage:pageLength
        }"
      >
        <template
          slot="table-row"
          slot-scope="props"
        >
          <!-- Column: Action -->
          <span v-if="props.column.field === 'action'">
            <span>
              <b-dropdown
                variant="link"
                toggle-class="text-decoration-none"
                no-caret
              >
                <template v-slot:button-content>
                  <feather-icon
                    icon="MoreVerticalIcon"
                    size="16"
                    class="text-body align-middle mr-25"
                  />
                </template>
                <b-dropdown-item
                  @click="editBranch(props.row.id)"
                >
                  <feather-icon
                    icon="Edit2Icon"
                    class="mr-50"
                  />
                  <span>แก้ไข</span>
                </b-dropdown-item>
                <b-dropdown-item @click="deleteBranch(props.row)">
                  <feather-icon
                    icon="TrashIcon"
                    class="mr-50"
                  />
                  <span>ลบ</span>
                </b-dropdown-item>
              </b-dropdown>
            </span>
          </span>

          <!-- Column: Common -->
          <span v-else>
            {{ props.formattedRow[props.column.field] }}
          </span>
        </template>

        <!-- pagination -->
        <template
          slot="pagination-bottom"
          slot-scope="props"
        >
          <div class="d-flex justify-content-between flex-wrap">
            <div class="d-flex align-items-center mb-0 mt-1">
              <span class="text-nowrap ">
                Showing 1 to
              </span>
              <b-form-select
                v-model="pageLength"
                :options="['3','5','10']"
                class="mx-1"
                @input="(value)=>props.perPageChanged({currentPerPage:value})"
              />
              <span class="text-nowrap"> of {{ props.total }} entries </span>
            </div>
            <div>
              <b-pagination
                :value="1"
                :total-rows="props.total"
                :per-page="pageLength"
                first-number
                last-number
                align="right"
                prev-class="prev-item"
                next-class="next-item"
                class="mt-1 mb-0"
                @input="(value)=>props.pageChanged({currentPage:value})"
              >
                <template #prev-text>
                  <feather-icon
                    icon="ChevronLeftIcon"
                    size="18"
                  />
                </template>
                <template #next-text>
                  <feather-icon
                    icon="ChevronRightIcon"
                    size="18"
                  />
                </template>
              </b-pagination>
            </div>
          </div>
        </template>
      </vue-good-table>
    </b-col>
    <b-modal
      id="modal-edit-branch"
      title="แก้ไขรหัสคุม"
      ok-title="ยืนยัน"
      cancel-title="ยกเลิก"
      centered
      cancel-variant="outline-secondary"
      @ok="updateBranch()"
    >
      <validation-observer ref="editCode">
        <b-row>
          <form-input
            v-model="edit.branch_code"
            col="12"
            label="รหัสสาขา"
            placeholder="รหัสสาขา"
            rules="required"
          />
          <form-input
            v-model="edit.branch_name"
            col="12"
            label="ชื่อสาขา"
            placeholder="ชื่อสาขา"
            rules="required"
          />
          <form-input
            v-model="edit.setting_basic_company.name"
            col="12"
            label="บริษัท"
            placeholder="บริษัท"
            rules="required"
          />
          <form-input
            v-model="edit.setting_basic_company.house_number"
            disabled
            col="12"
            label="บ้านเลขที่"
            placeholder="บ้านเลขที่"
            rules="required"
          />
          <form-input
            v-model="edit.setting_basic_company.district"
            disabled
            col="12"
            label="ตำบล"
            placeholder="ตำบล"
            rules="required"
          />
          <form-input
            v-model="edit.setting_basic_company.amphure"
            disabled
            col="12"
            label="อำเภอ"
            placeholder="อำเภอ"
            rules="required"
          />
          <form-input
            v-model="edit.setting_basic_company.province"
            disabled
            col="12"
            label="จังหวัด"
            placeholder="จังหวัด"
            rules="required"
          />
          <form-input
            v-model="edit.setting_basic_company.postal_code"
            disabled
            col="12"
            label="รหัสไปรษณีย์"
            placeholder="รหัสไปรษณีย์"
            rules="required"
          />
        </b-row>
      </validation-observer>
    </b-modal>
    <b-modal
      id="modal-add-branch"
      title="เพิ่มตั้งค่าบริษัท"
      ok-title="ยืนยัน"
      cancel-title="ยกเลิก"
      centered
      cancel-variant="outline-secondary"
      @ok="addBranch()"
    >
      <validation-observer ref="addbranch">
        <b-row>
          <form-input
            v-model="add.branch_code"
            col="12"
            label="รหัสสาขา"
            placeholder="รหัสสาขา"
            rules="required"
          />
          <form-input
            v-model="add.branch_name"
            col="12"
            label="ชื่อสาขา"
            placeholder="ชื่อสาขา"
            rules="required"
          />
        </b-row>
      </validation-observer>
      <vue-select
        v-model="add.setting_basic_company"
        :option="setting_basic_company"
        label="สาขา*"
        title="name"
        class="my-1"
      />
    </b-modal>
  </b-card>
</template>

<script>
import store from '@/store/index'
import { mapActions, mapState } from 'vuex'
import Ripple from 'vue-ripple-directive'

export default {
  directives: {
    Ripple,
  },
  data() {
    return {
      dir: false,
      searchTerm: '',
    }
  },
  computed: {
    ...mapState('settingBasicBranch', ['add', 'edit', 'branch_column', 'setting_basic_company', 'branch', 'pageLength']),
    direction() {
      if (store.state.appConfig.isRTL) {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.dir = true
        return this.dir
      }
      // eslint-disable-next-line vue/no-side-effects-in-computed-properties
      this.dir = false
      return this.dir
    },
  },
  methods: {
    ...mapActions('settingBasicBranch', ['setApi', 'setRefs', 'setModal', 'editBranch', 'updateBranch', 'loadBranchData', 'loadCompany', 'openAddBranchModal', 'addBranch', 'deleteBranch']),
  },
  mounted() {
    this.setApi({ api: this.$http, self: this })
    this.loadBranchData()
    this.loadCompany()
    this.setModal(this.$bvModal)
  },
}
</script>

<style>

</style>
