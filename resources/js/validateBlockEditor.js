import { createApp } from 'vue'
import validateBlockEditor from './components/needValidate.vue'

const app = createApp(validateBlockEditor)

app.directive('init', {
    beforeMount(el, binding, vnode) {
        binding.instance[binding.arg] = binding.value
    }
})

app.mount('#app')
