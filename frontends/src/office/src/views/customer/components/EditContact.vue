<template>
  <panel title="เพิ่มข้อมูลติดต่อ">
    <!-- search input -->
    <div class="custom-search d-flex justify-content-end">
      <b-form-group>
        <div class="d-flex align-items-center">
          <label class="mr-1">ค้นหา</label>
          <b-form-input
            v-model="searchTerm"
            placeholder="ค้นหา"
            type="text"
            class="d-inline-block"
          />
        </div>
      </b-form-group>
    </div>
    <!-- table -->
    <b-col cols="12">
      <vue-good-table
        :columns="columns_customer_contact"
        :rows="customer_contact"
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
            v-if="props.column.field === 'value'"
            class="text-nowrap"
          >
            <span class="text-nowrap">{{ props.row.value }} {{ props.row.house_number }} {{ props.row.district }} {{ props.row.amphure }} {{ props.row.province }} {{ props.row.postal_code }}</span>
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
                <b-dropdown-item
                  @click="editCustomerContact(props.row)"
                >
                  <feather-icon
                    icon="Edit2Icon"
                    class="mr-50"
                  />
                  <span>แก้ไข</span>
                </b-dropdown-item>
                <b-dropdown-item @click="deleteContact(props.row)">
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
      id="modal-primary"
      title="แก้ไขข้อมูลติดต่อสมาชิก"
      ok-title="ยืนยัน"
      cancel-title="ยกเลิก"
      centered
      cancel-variant="outline-secondary"
      @ok="editContact()"
    >
      <b-form-group
        label="ประเภทข้อมูลติดต่อ"
      >
        <form-input
          v-model="edit_customer_contact.contact_name_th"
          disabled
          label="ประเภท"
          :col="12"
        />
      </b-form-group>
      <div
        v-if="
          edit_customer_contact.setting_master_contact_id ===
            '920AFDE1-A6C8-43BD-9E9A-68EBDB2AC919'
        "
      >
        <form-input
          v-model="edit_customer_contact.house_number"
          label="บ้านเลขที่"
          :col="12"
        />
        <form-input
          v-model="edit_customer_contact.district"
          label="ตำบล"
          :col="12"
        />
        <form-input
          v-model="edit_customer_contact.amphure"
          label="อำเภอ"
          :col="12"
        />
        <form-input
          v-model="edit_customer_contact.province"
          label="จังหวัด"
          :col="12"
        />
        <form-input
          v-model="edit_customer_contact.postal_code"
          label="รหัสไปรษณีย์"
          :col="12"
        />
      </div>
      <div
        v-else-if="
          edit_customer_contact.setting_master_contact_id ===
            '920AFDE1-A6CD-47F6-9CD5-216A5DECCC8D'
        "
      >
        <form-input
          v-model="edit_customer_contact.house_number"
          label="บ้านเลขที่"
          :col="12"
        />
        <form-input
          v-model="edit_customer_contact.district"
          label="ตำบล"
          :col="12"
        />
        <form-input
          v-model="edit_customer_contact.amphure"
          label="อำเภอ"
          :col="12"
        />
        <form-input
          v-model="edit_customer_contact.province"
          label="จังหวัด"
          :col="12"
        />
        <form-input
          v-model="edit_customer_contact.postal_code"
          label="รหัสไปรษณีย์"
          :col="12"
        />
      </div>
      <div
        v-else-if="
          edit_customer_contact.setting_master_contact_id ===
            '920AFDE1-A6E8-4869-BB3A-BD1CB41675CD'
        "
      >
        <form-input
          v-model="edit_customer_contact.value"
          label="หมายเลขโทรศัพท์"
          :col="12"
        />
      </div>
      <div
        v-else-if="
          edit_customer_contact.setting_master_contact_id ===
            '920AFDE1-A6EE-4738-ABE4-47B4B239F1EC'
        "
      >
        <form-input
          v-model="edit_customer_contact.value"
          label="อีเมล"
          :col="12"
        />
      </div>
    </b-modal>
    <b-modal
      id="modal-add"
      title="เพิ่มข้อมูลติดต่อสมาชิก"
      ok-title="ยืนยัน"
      cancel-title="ยกเลิก"
      centered
      cancel-variant="outline-secondary"
      @ok="insertCustomerContact"
    >
      <custom-tree-select
        ref="tree"
        v-model="edit_add_customer_contact.setting_master_contact_id"
        label="ประเภทช่องทางติดต่อ"
        url="/api/setting/master/contact"
      />
      <div
        v-if="
          edit_add_customer_contact.setting_master_contact_id ===
            '920AFDE1-A6C8-43BD-9E9A-68EBDB2AC919'
        "
      >
        <form-input
          v-model="edit_add_customer_contact.house_number"
          label="บ้านเลขที่"
          :col="12"
        />
        <form-input
          v-model="edit_add_customer_contact.district"
          label="ตำบล"
          :col="12"
        />
        <form-input
          v-model="edit_add_customer_contact.amphure"
          label="อำเภอ"
          :col="12"
        />
        <form-input
          v-model="edit_add_customer_contact.province"
          label="จังหวัด"
          :col="12"
        />
        <form-input
          v-model="edit_add_customer_contact.postal_code"
          label="รหัสไปรษณีย์"
          :col="12"
        />
      </div>
      <div
        v-else-if="
          edit_add_customer_contact.setting_master_contact_id ===
            '920AFDE1-A6CD-47F6-9CD5-216A5DECCC8D'
        "
      >
        <form-input
          v-model="edit_add_customer_contact.house_number"
          label="บ้านเลขที่"
          :col="12"
        />
        <form-input
          v-model="edit_add_customer_contact.district"
          label="ตำบล"
          :col="12"
        />
        <form-input
          v-model="edit_add_customer_contact.amphure"
          label="อำเภอ"
          :col="12"
        />
        <form-input
          v-model="edit_add_customer_contact.province"
          label="จังหวัด"
          :col="12"
        />
        <form-input
          v-model="edit_add_customer_contact.postal_code"
          label="รหัสไปรษณีย์"
          :col="12"
        />
      </div>
      <div
        v-else-if="
          edit_add_customer_contact.setting_master_contact_id ===
            '920AFDE1-A6E8-4869-BB3A-BD1CB41675CD'
        "
      >
        <form-input
          v-model="edit_add_customer_contact.value"
          label="หมายเลขโทรศัพท์"
          :col="12"
        />
      </div>
      <div
        v-else-if="
          edit_add_customer_contact.setting_master_contact_id ===
            '920AFDE1-A6EE-4738-ABE4-47B4B239F1EC'
        "
      >
        <form-input
          v-model="edit_add_customer_contact.value"
          label="อีเมล"
          :col="12"
        />
      </div>
    </b-modal>

    <div class="custom-search d-flex justify-content-end  my-1">
      <b-button
        v-ripple.400="'rgba(113, 102, 240, 0.15)'"
        v-b-modal.modal-add
        variant="outline-primary"
        class="mr-1"
      >
        <feather-icon
          icon="PlusIcon"
          class="mr-50"
        />
        <span class="align-middle">เพิ่มข้อมูลติดต่อ</span>
      </b-button>
      <b-button
        v-ripple.400="'rgba(113, 102, 240, 0.15)'"
        variant="primary"
        class="mr-1"
        @click="editCustomerData()"
      >
        แก้ไขข้อมูลสมาชิก
      </b-button>
      <b-button
        v-ripple.400="'rgba(113, 102, 240, 0.15)'"
        variant="danger"
        class="mr-1"
        @click="backToIndex()"
      >
        <span class="align-middle">ย้อนกลับ</span>
      </b-button>
    </div>
  </panel>
</template>
<script>
import { VBModal } from 'bootstrap-vue'
import { mapActions, mapState } from 'vuex'
import store from '@/store/index'
import Ripple from 'vue-ripple-directive'

export default {
  components: {
  },
  directives: {
    'b-modal': VBModal,
    Ripple,
  },
  data() {
    return {
      dir: false,
      searchTerm: '',
    }
  },
  computed: {
    ...mapState('editCustomer', ['edit', 'edit_customer_contact', 'edit_add_customer_contact', 'pageLength', 'show_modal', 'columns_customer_contact', 'customer_contact', 'status']),
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
    ...mapActions('editCustomer', ['editCustomerContact', 'editCustomerData', 'editContact', 'setModal', 'insertCustomerContact', 'cancelClearContact', 'openAddModal', 'deleteContact', 'backToIndex']),
    testModal() {
      this.$bvModal.show('modal-primary')
    },
    hasCustomerContacts(customer) {
      return customer.customer_contact[0] ? customer.customer_contact[0].title : 'ไม่มีข้อมูลติดต่อ'
    },
  },
  mounted() {
    this.setModal(this.$bvModal)
  },
}
</script>
