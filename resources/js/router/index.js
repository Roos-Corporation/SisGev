import { createRouter, createWebHistory } from "vue-router";

import MainLayout from '../layouts/MainLayout.vue'
import Dashboard from '../pages/Dashboard.vue'

import PeopleIndex from '../pages/registrations/people/Index.vue'
import PeopleForm from '../pages/registrations/people/Form.vue'

import EventsIndex from '../pages/registrations/events/Index.vue'
import EventsForm from '../pages/registrations/events/Form.vue'

import EventRoomIndex from '../pages/registrations/event-rooms/Index.vue'
import EventRoomForm from '../pages/registrations/event-rooms/Form.vue'

import CoffeeSpacesIndex from '../pages/registrations/coffee-spaces/Index.vue'
import CoffeeSpacesForm from '../pages/registrations/coffee-spaces/Form.vue'

import EventParticipantsIndex from '../pages/process/event-participants/Index.vue'
import EventParticipantsForm from '../pages/process/event-participants/Form.vue'

import ReportsIndex from '../pages/reports/Index.vue'

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
        {
          path: '/events',
          component: EventsIndex
        },
        {
          path: '/events/form',
          component: EventsForm
        },
        {
          path: '/event-rooms',
          component: EventRoomIndex
        },
        {
          path: '/event-rooms/form',
          component: EventRoomForm
        },
        {
          path: '/coffee-spaces',
          component: CoffeeSpacesIndex
        },
        {
          path: '/coffee-spaces/form',
          component: CoffeeSpacesForm
        },
        {
          path: '/event-participants',
          component: EventParticipantsIndex
        },
        {
          path: '/event-participants/form',
          component: EventParticipantsForm
        },
        {
          path: '/reports',
          component: ReportsIndex
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
