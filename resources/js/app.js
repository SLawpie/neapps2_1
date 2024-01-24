import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import {createApp} from 'vue'

import TestPage from './Pages/Index/TestPage.vue'

createApp(TestPage).mount("#testPage")
