<template>
  <!-- form -->
  <b-col :md="col">
    <b-form-group
      :label="label"
      label-for="basicInput"
    >
      <validation-provider
        #default="{ errors }"
        :name="placeholder"
        :rules="rules"
      >
        <b-form-input
          v-model="inputData"
          :state="errors.length > 0 ? false : null"
          :disabled="disabled"
          :placeholder="placeholder"
          @input="xHandlerInput"
        />
        <small class="text-danger">{{ errors[0] }}</small>
      </validation-provider>
    </b-form-group>
  </b-col>
</template>
<script>
import { required, email } from '@validations'

export default {
  name: 'FormInput',
  components: {},
  props: ['label', 'placeholder', 'rules', 'col', 'value', 'disabled'],
  data() {
    return {
      emailValue: '',
      locale: 'th',
      name: '',
      inputData: '',
      required,
      email,
    }
  },
  watch: {
    inputData: {
      handler(val) {
        this.$emit('value', val)
      },
    },
    value: {
      immediate: true,
      handler(val) {
        this.inputData = val
      },
    },
  },
  methods: {
    validationForm() {
      this.$refs.simpleRules.validate().then(success => {
        if (success) {
          alert('form submitted!')
        }
      })
    },
    xHandlerInput(value) {
      if (value) {
        this.$emit('input', this.inputData)
      } else {
        this.$emit('input', value)
      }
    },
  },
}
</script>
