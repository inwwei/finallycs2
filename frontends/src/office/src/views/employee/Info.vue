<template>
  <div>
    <employee-info />
    <employee-contact />
  </div>
</template>

<script>
import EmployeeInfo from './components/EmployeeInfo.vue'
import EmployeeContact from './components/EmployeeContact.vue'

export default {
  components: {
    EmployeeInfo,
    EmployeeContact,
  },
}
</script>

<style>

</style>
