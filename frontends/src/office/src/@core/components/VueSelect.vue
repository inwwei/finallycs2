<template>
  <b-row>
    <b-col :md="col">
      <b-form-group>
        <label class="custom_label_for_treeselect">{{ label }}</label>
        <v-select
          v-model="inputData"
          :dir="$store.state.appConfig.isRTL ? 'rtl' : 'ltr'"
          :label="title"
          :options="option"
          @input="xHandlerInput"
        />
      </b-form-group>
    </b-col>
  </b-row>
</template>

<script>
import vSelect from 'vue-select'

export default {
  name: 'VueSelect',
  components: {
    vSelect,
  },
  props: ['label', 'value', 'option', 'col', 'title'],
  data() {
    return {
      inputData: '',
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

<style lang="scss">
@import '@core/scss/vue/libs/vue-select.scss';
.custom_label_for_treeselect {
  font-weight: 200;
  font-size: 0.8rem;
  color: rgba(0, 0, 0, 0.753);
  position: absolute;
  margin-top: -23px;
}
</style>
