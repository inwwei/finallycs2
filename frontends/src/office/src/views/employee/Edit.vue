<template>
  <div>
    <employee-edit-data />
    <employee-edit-contact />
  </div>
</template>

<script>
import { mapActions } from 'vuex'
import EmployeeEditData from './components/EmployeeEditData.vue'
import EmployeeEditContact from './components/EmployeeEditContact.vue'

export default {
  components: {
    EmployeeEditData,
    EmployeeEditContact,
  },
  methods: {
    ...mapActions('editEmployee', ['setApi', 'clearEditForm']),
  },
  mounted() {
    this.setApi({ api: this.$http, self: this })
  },
  destroyed() {
    this.clearEditForm()
  },
}
</script>

<style>

</style>
