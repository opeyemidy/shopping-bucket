<template>
  <Navbar />
  <main>
    <router-view></router-view>
  </main>
  <FooterVue />
</template>

<script>
import { defineComponent, onMounted, onBeforeMount } from 'vue'
import Navbar from './components/Navbar.vue'
import FooterVue from './components/Footer.vue'
import { useUserStore } from '@/stores/user'
import { useCartStore } from '@/stores/cart'
import useMakeRequest from '@/hooks/useMakeRequest'

export default defineComponent({
  name: 'App',
  components: {
    Navbar,
    FooterVue
  },
  setup() {
    const cartStore = useCartStore()
    const userStore = useUserStore()

    const csrfRequest = useMakeRequest()
    const loginRequest = useMakeRequest()
    const cartRequest = useMakeRequest()
    const userRequest = useMakeRequest()
    onMounted(async () => {
      try {
        const userData = await userRequest.get('/user')
        const cartData = await cartRequest.get('/cart')

        userStore.setUser(userData)
        cartStore.updateCartItems(
          cartData.map((item) => {
            const { product, ...rest } = item
            const { name, description, price } = product
            return {
              ...rest,
              name,
              description,
              price
            }
          })
        )
      } catch (err) {
        console.log(err)
      }
    })

    onBeforeMount(async () => {
      await csrfRequest.get('/sanctum/csrf-cookie')
      await loginRequest.post('/login', { email: 'admin@shopping.com', password: 'password-admin' })
    })

    return {
      isLoading: csrfRequest.isLoading
    }
  }
})
</script>
<style lang="scss">
* {
  margin: 0;
}
#app {
  .link {
    color: inherit;
    text-decoration: none;
  }
}
</style>
