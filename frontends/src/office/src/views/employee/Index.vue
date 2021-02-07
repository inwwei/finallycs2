<template>
  <panel title="ข้อมูลพนักงานทั้งหมด">
    <employee-table />
  </panel>

</template>

<script>
import EmployeeTable from './components/EmployeeTable.vue'

export default {
  components: {
    EmployeeTable,
  },
}
</script>
