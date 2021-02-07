<template>
  <section id="card-actions">
    <b-row>
      <!-- card collapsible  -->
      <b-col md="12">
        <b-card-actions
          :title="title"
          action-collapse
        >
          <b-card-text>
            <template v-slot:header-right />
            <slot />
          </b-card-text>
        </b-card-actions>
      </b-col>
    </b-row>
  </section>
</template>

<script>
import BCardActions from '@core/components/b-card-actions/BCardActions.vue'

export default {
  name: 'Panel',
  components: {
    BCardActions,
  },
  props: {
    title: {
      default: '',
      type: String,
    },
  },
  data() {
    return {
      fields: [
        'ACTION',
        { key: 'ICON', label: 'ICON' },
        'DETAILS',
      ],
      items: [
        { ACTION: 'Collapse', ICON: 'ChevronDownIcon', DETAILS: 'Collapse card content using collapse action.' },
        { ACTION: 'Refresh Content', ICON: 'RotateCwIcon', DETAILS: 'Refresh your card content using refresh action.' },
        { ACTION: 'Remove Card', ICON: 'XIcon', DETAILS: 'Remove card from page using remove card action' },
      ],
    }
  },
  methods: {

    // stop refreshing card in 3 sec
    refreshStop(cardName) {
      setTimeout(() => {
        this.$refs[cardName].showLoading = false
      }, 3000)
    },
  },
}
</script>
