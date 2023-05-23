import { createRouter, createWebHistory } from 'vue-router'
// import ProductsPage from '../views/ProductsPage.vue'
import HomePage from '@/views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'products',
      component: HomePage
    },
    {
      path: '/products/:id',
      name: 'product',
      component: () => import('@/views/ProductDetailsPage.vue')
    },
    {
      path: '/admin',
      name: 'admin',
      component: () => import('@/views/Admin.vue')
    }
  ]
})

export default router
