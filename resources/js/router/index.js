import { createRouter, createWebHistory } from "vue-router";

import MainLayout from '../layouts/MainLayout.vue'
import Dashboard from '../pages/Dashboard.vue'
import PeopleIndex from '../pages/registrations/people/Index.vue'
import PeopleForm from '../pages/registrations/people/Form.vue'
// import NotFound from './pages/NotFound.vue'

const routes = [
    {
      path: '/',
      component: MainLayout,
      children: [
        {
          path: '/dashboard',
          component: Dashboard
        },
        {
          path: '/people',
          component: PeopleIndex
        },
        {
          path: '/people/form',
          component: PeopleForm
        },
      ]
    }
    // {
    //   path: '/:pathMach(.*)*',
    //   component: NotFound
    // },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router
