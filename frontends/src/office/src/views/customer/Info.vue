<template>
  <div>
    <info-customer />
    <info-contact-customer />
  </div>
</template>
<script>
import InfoCustomer from './components/InfoCustomer.vue'
import InfoContactCustomer from './components/InfoContactCustomer.vue'

export default {
  components: {
    InfoCustomer,
    InfoContactCustomer,
  },
}
</script>
