import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/views/Home'
import Profile from '@/views/Profile'
import About from '@/views/About'
import Inventory from '@/views/Inventory'
import Seedling from '@/views/Seedling'
import GardenBeds from '@/views/GardenBeds'
import Stats from '@/views/Stats'



Vue.use (Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      component: Home
    },
    {
      path: '/profile',
      component: Profile
    },
    {
      path: '/about',
      component: About
    },
    {
      path: '/inventory',
      component: Inventory
    },
    {
      path: '/seedling',
      component: Seedling
    },
    {
      path: '/garden',
      component: GardenBeds
    },
    {
      path: '/stats',
      component: Stats
    },

  ]
})
