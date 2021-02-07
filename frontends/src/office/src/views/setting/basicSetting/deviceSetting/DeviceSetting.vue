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
            @click="openAddDeviceModal()"
          >
            <span class="align-middle">เพิ่มข้อมูล</span>
          </b-button>
        </div>
      </b-form-group>
    </div>
    <b-col cols="12">
      <vue-good-table
        :columns="device_column"
        :rows="device_data"
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
                  @click="editDevice(props.row.id)"
                >
                  <feather-icon
                    icon="Edit2Icon"
                    class="mr-50"
                  />
                  <span>แก้ไข</span>
                </b-dropdown-item>
                <b-dropdown-item @click="deleteDevice(props.row)">
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
      id="modal-edit-device"
      title="แก้ไขตั้งค่าเข้าถึงระบบ"
      ok-title="ยืนยัน"
      cancel-title="ยกเลิก"
      centered
      cancel-variant="outline-secondary"
      @ok="updateDevice()"
    >
      <validation-observer ref="editCode">
        <b-row>
          <form-input
            v-model="edit.name"
            col="12"
            label="ชื่อ"
            placeholder="ชื่อ"
            rules="required"
          />
          <form-input
            v-model="edit.pin"
            col="12"
            label="รหัส"
            placeholder="รหัส"
            rules="required"
          />
        </b-row>
      </validation-observer>
    </b-modal>
    <b-modal
      id="modal-add-device"
      title="เพิ่มตั้งค่าการเข้าถึงระบบ"
      ok-title="ยืนยัน"
      cancel-title="ยกเลิก"
      centered
      cancel-variant="outline-secondary"
      @ok="addDevice()"
    >
      <validation-observer ref="addDevice">
        <b-row>
          <form-input
            v-model="add.name"
            col="12"
            label="ชื่อ"
            placeholder="ชื่อ"
            rules="required"
          />
          <form-input
            v-model="add.pin"
            col="12"
            label="รหัส"
            placeholder="รหัส"
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
    ...mapState('settingDevice', ['add', 'edit', 'device_column', 'device_data', 'pageLength']),
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
    ...mapActions('settingDevice', ['setApi', 'setRefs', 'setModal', 'editDevice', 'updateDevice', 'loadDeviceData', 'openAddDeviceModal', 'addDevice', 'deleteDevice']),
  },
  mounted() {
    this.setApi({ api: this.$http, self: this })
    this.loadDeviceData()
    this.setModal(this.$bvModal)
  },
}
</script>

<style>

</style>
