import { createMemoryHistory, createRouter } from 'vue-router'

import IndexView from './../module/Index.vue';


const routes = [
    { path: '/', name: 'index', component: IndexView }
]

const router = createRouter({
    history: createMemoryHistory(),
    routes,
})
export default router;
