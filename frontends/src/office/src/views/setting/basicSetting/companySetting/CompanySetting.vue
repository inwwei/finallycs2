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
            @click="openAddCompanyModal()"
          >
            <span class="align-middle">เพิ่มข้อมูล</span>
          </b-button>
        </div>
      </b-form-group>
    </div>
    <b-col cols="12">
      <vue-good-table
        :columns="company_column"
        :rows="company_data"
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
                  @click="editCompany(props.row.id)"
                >
                  <feather-icon
                    icon="Edit2Icon"
                    class="mr-50"
                  />
                  <span>แก้ไข</span>
                </b-dropdown-item>
                <div v-if="props.row.id !== '924383F5-8588-44DE-81DB-DAF6653A2A04'">
                  <b-dropdown-item
                    @click="deleteCompany(props.row)"
                  >
                    <feather-icon
                      icon="TrashIcon"
                      class="mr-50"
                    />
                    <span>ลบ</span>
                  </b-dropdown-item>
                </div>
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
      id="modal-edit-company"
      title="แก้ไขรหัสคุม"
      ok-title="ยืนยัน"
      cancel-title="ยกเลิก"
      centered
      cancel-variant="outline-secondary"
      @ok="updateCompany()"
    >
      <validation-observer ref="editCode">
        <b-row>
          <form-input
            v-model="edit.name"
            col="12"
            label="ชื่อบริษัท"
            placeholder="ชื่อบริษัท"
            rules="required"
          />
          <form-input
            v-model="edit.tex_id"
            col="12"
            label="หมายเลขเสียภาษี"
            placeholder="หมายเลขเสียภาษี"
            rules="required"
          />
          <form-input
            v-model="edit.tel"
            col="12"
            label="เบอร์ติดต่อ"
            placeholder="เบอร์ติดต่อ"
            rules="required"
          />
          <form-input
            v-model="edit.house_number"
            col="12"
            label="บ้านเลขที่"
            placeholder="บ้านเลขที่"
            rules="required"
          />
          <form-input
            v-model="edit.district"
            col="12"
            label="ตำบล"
            placeholder="ตำบล"
            rules="required"
          />
          <form-input
            v-model="edit.amphure"
            col="12"
            label="อำเภอ"
            placeholder="อำเภอ"
            rules="required"
          />
          <form-input
            v-model="edit.province"
            col="12"
            label="จังหวัด"
            placeholder="จังหวัด"
            rules="required"
          />
          <form-input
            v-model="edit.postal_code"
            col="12"
            label="รหัสไปรษณีย์"
            placeholder="รหัสไปรษณีย์"
            rules="required"
          />
        </b-row>
      </validation-observer>
    </b-modal>
    <b-modal
      id="modal-add-company"
      title="เพิ่มตั้งค่าบริษัท"
      ok-title="ยืนยัน"
      cancel-title="ยกเลิก"
      centered
      cancel-variant="outline-secondary"
      @ok="addCompany()"
    >
      <validation-observer ref="addCompany">
        <b-row>
          <form-input
            v-model="add.name"
            col="12"
            label="ชื่อบริษัท"
            placeholder="ชื่อบริษัท"
            rules="required"
          />
          <form-input
            v-model="add.tex_id"
            col="12"
            label="หมายเลขเสียภาษี"
            placeholder="หมายเลขเสียภาษี"
            rules="required"
          />
          <form-input
            v-model="add.tel"
            col="12"
            label="เบอร์ติดต่อ"
            placeholder="เบอร์ติดต่อ"
            rules="required"
          />
          <form-input
            v-model="add.house_number"
            col="12"
            label="บ้านเลขที่"
            placeholder="บ้านเลขที่"
            rules="required"
          />
          <form-input
            v-model="add.district"
            col="12"
            label="ตำบล"
            placeholder="ตำบล"
            rules="required"
          />
          <form-input
            v-model="add.amphure"
            col="12"
            label="อำเภอ"
            placeholder="อำเภอ"
            rules="required"
          />
          <form-input
            v-model="add.province"
            col="12"
            label="จังหวัด"
            placeholder="จังหวัด"
            rules="required"
          />
          <form-input
            v-model="add.postal_code"
            col="12"
            label="รหัสไปรษณีย์"
            placeholder="รหัสไปรษณีย์"
            rules="required"
          />
        </b-row>
      </validation-observer>
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
    ...mapState('settingBasicCompany', ['add', 'edit', 'company_column', 'company_data', 'pageLength']),
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
    ...mapActions('settingBasicCompany', ['setApi', 'setRefs', 'setModal', 'editCompany', 'updateCompany', 'loadCompany', 'openAddCompanyModal', 'addCompany', 'deleteCompany']),
  },
  mounted() {
    this.setApi({ api: this.$http, self: this })
    this.loadCompany()
    this.setModal(this.$bvModal)
  },
}
</script>

<style>

</style>
