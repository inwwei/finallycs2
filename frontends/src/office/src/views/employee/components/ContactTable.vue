<template>
  <div>
    <b-modal
      id="modal-select2"
      title="เพิ่มข้อมูลติดต่อ"
      ok-title="ยืนยัน"
      cancel-title="ยกเลิก"
      cancel-variant="outline-secondary"
      centered
      @ok="addTempContact"
      @cancel="clearTempContact"
    >
      <b-form>
        <b-form-group
          label="ประเภทข้อมูลติดต่อ"
        >
          <custom-tree-select
            ref="tree"
            v-model="tempContact.setting_master_contact_id"
            class="d-flex justify-content-center"
            url="/api/setting/master/contact"
            @node-select="typeContact"
          />
        </b-form-group>
        <b-form-group
          v-if="
            tempContact.setting_master_contact_id ===
              '920AFDE1-A6C8-43BD-9E9A-68EBDB2AC919'
          "
        >
          <form-input
            v-model="tempContact.house_number"
            label="บ้านเลขที่"
            :col="12"
          />
          <form-input
            v-model="tempContact.district"
            label="ตำบล"
            :col="12"
          />
          <form-input
            v-model="tempContact.amphure"
            label="อำเภอ"
            :col="12"
          />
          <form-input
            v-model="tempContact.province"
            label="จังหวัด"
            :col="12"
          />
          <form-input
            v-model="tempContact.postal_code"
            label="รหัสไปรษณีย์"
            :col="12"
          />
        </b-form-group>

        <b-form-group
          v-else-if="
            tempContact.setting_master_contact_id ===
              '920AFDE1-A6CD-47F6-9CD5-216A5DECCC8D'
          "
        >
          <form-input
            v-model="tempContact.house_number"
            label="บ้านเลขที่"
            :col="12"
          />
          <form-input
            v-model="tempContact.district"
            label="ตำบล"
            :col="12"
          />
          <form-input
            v-model="tempContact.amphure"
            label="อำเภอ"
            :col="12"
          />
          <form-input
            v-model="tempContact.province"
            label="จังหวัด"
            :col="12"
          />
          <form-input
            v-model="tempContact.postal_code"
            label="รหัสไปรษณีย์"
            :col="12"
          />
        </b-form-group>

        <b-form-group
          v-else-if="
            tempContact.setting_master_contact_id ===
              '920AFDE1-A6E8-4869-BB3A-BD1CB41675CD'
          "
        >
          <form-input
            v-model="tempContact.value"
            label="หมายเลขโทรศัพท์"
            :col="12"
          />
        </b-form-group>

        <b-form-group
          v-else-if="
            tempContact.setting_master_contact_id ===
              '920AFDE1-A6EE-4738-ABE4-47B4B239F1EC'
          "
        >
          <form-input
            v-model="tempContact.value"
            label="อีเมล"
            :col="12"
          />
        </b-form-group>

      </b-form>
    </b-modal>
    <b-col cols="12">
      <vue-good-table
        :columns="columnContacts"
        :rows="add_employee.user_contacts"
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
          <!-- Column: Name -->
          <span
            v-if="props.column.field === 'type'"
            class="text-nowrap"
          >
            <span class="text-nowrap">{{ props.row.type }}</span>
          </span>

          <!-- Column: Name -->
          <span
            v-if="props.column.field === 'value'"
            class="text-nowrap"
          >
            <span class="text-nowrap">{{ props.row.value }}
              {{ props.row.house_number }}
              {{ props.row.district }}
              {{ props.row.amphure }}
              {{ props.row.province }}
              {{ props.row.postal_code }}</span>
          </span>

          <!-- Column: Action -->
          <span v-else-if="props.column.field === 'action'">
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
                <b-dropdown-item @click="deleteTempContact(props.row.originalIndex)">
                  <feather-icon
                    icon="TrashIcon"
                    class="mr-50"
                  />
                  <span>DELETE</span>
                </b-dropdown-item>
              </b-dropdown>
            </span>
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
  </div>

</template>

<script>
import { mapActions, mapState } from 'vuex'
import store from '@/store/index'
import { VBModal } from 'bootstrap-vue'

export default {
  components: {
  },
  directives: {
    'b-modal': VBModal,
  },
  data() {
    return {
      dir: false,
      searchTerm: '',
    }
  },
  computed: {
    ...mapState('employee', ['pageLength', 'columnContacts', 'rows', 'add_employee', 'tempContact']),
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
    ...mapActions('employee', ['setApi', 'setRefs', 'nodeSelect', 'addTempContact', 'typeContact', 'clearTempContact', 'deleteTempContact']),
  },
  mounted() {
    this.setApi({ api: this.$http, self: this })
    this.setRefs(this.$refs)
  },
}
</script>
