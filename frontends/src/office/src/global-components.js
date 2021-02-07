import Vue from 'vue'
import FeatherIcon from '@core/components/feather-icon/FeatherIcon.vue'
import Panel from '@core/components/Panel.vue'
import CustomTreeSelect from '@core/components/CustomTreeSelect.vue'
import CustomTree from '@core/components/CustomTree.vue'
import VueSelect from '@core/components/VueSelect.vue'
import FormInput from '@core/components/FormInput.vue'
import VueGoodTablePlugin from 'vue-good-table'
import Attached from '@core/components/Attached.vue'

import 'vue-good-table/dist/vue-good-table.css'

Vue.use(FeatherIcon.name, VueGoodTablePlugin)
Vue.component(FeatherIcon.name, FeatherIcon)
Vue.component(VueSelect.name, VueSelect)
Vue.component(Panel.name, Panel)
Vue.component(CustomTreeSelect.name, CustomTreeSelect)
Vue.component(FormInput.name, FormInput)
Vue.component(CustomTree.name, CustomTree)
Vue.component(Attached.name, Attached)
