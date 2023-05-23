<template>
  <div class="navbar" ref="menuContainer">
    <div class="wrapper">
      <div class="left">
        <div class="item">
          <img src="/img/en.png" alt="" />
          <KeyboardArrowDownIcon />
        </div>
        <div class="item">
          <span>USD</span>
          <KeyboardArrowDownIcon />
        </div>
        <div class="item">
          <router-link class="link" to="">Women</router-link>
        </div>
        <div class="item">
          <router-link class="link" to="">Men</router-link>
        </div>
        <div class="item">
          <router-link class="link" to="">Children</router-link>
        </div>
      </div>
      <div class="center">
        <router-link class="link" to="/">Shopping Bucket</router-link>
      </div>
      <div class="right">
        <div class="item">
          <router-link class="link" to="/">Homepage</router-link>
        </div>
        <div class="item">
          <router-link class="link" to="">About</router-link>
        </div>
        <div class="item">
          <router-link class="link" to="/">Contact</router-link>
        </div>
        <div class="item">
          <router-link class="link" to="/admin" v-if="userStore.isAdmin">Admin</router-link>
        </div>
        <div class="icons">
          <SearchIcon />
          <PersonOutlineOutlinedIcon />
          <FavoriteBorderOutlinedIcon />
          <div class="cartIcon" @click="toggleCart">
            <ShoppingCartOutlined />
            <span>{{ products.length }}</span>
          </div>
        </div>
      </div>
    </div>
    <Cart v-if="open" />
  </div>
</template>

<script>
import { defineComponent, ref, onUnmounted, onMounted } from 'vue'
import { useUserStore } from '../stores/user'
import { useCartStore } from '../stores/cart'
import { useRoute } from 'vue-router'
import SearchIcon from './icons/SearchIcon.vue'
import ShoppingCartOutlined from './icons/ShoppingCartOutlineIcon.vue'
import PersonOutlineOutlinedIcon from './icons/PersonOutline.vue'
import FavoriteBorderOutlinedIcon from './icons/FavoriteBorderOutlinedIcon.vue'
import Cart from './Cart.vue'
import KeyboardArrowDownIcon from './icons/KeyboardArrowDownIcon.vue'

export default defineComponent({
  name: 'Navbar_',
  components: {
    PersonOutlineOutlinedIcon,
    FavoriteBorderOutlinedIcon,
    ShoppingCartOutlined,
    Cart,
    KeyboardArrowDownIcon,
    SearchIcon
  },
  setup() {
    const open = ref(false)
    const menuContainer = ref(null)
    const userStore = useUserStore()
    const cartStore = useCartStore()
    const route = useRoute()
    const toggleCart = () => {
      open.value = !open.value
    }
    function handleClickOutside(event) {
      if (menuContainer.value && !menuContainer.value.contains(event.target)) {
        open.value = false
      }
    }

    onMounted(() => {
      document.addEventListener('click', handleClickOutside)
    })

    onUnmounted(() => {
      document.removeEventListener('click', handleClickOutside)
    })
    return {
      open,
      userStore,
      products: cartStore.cartItems,
      toggleCart,
      route
    }
  }
})
</script>

<style lang="scss">
.navbar {
  height: 80px;

  .wrapper {
    padding: 10px 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;

    .item {
      display: flex;
      align-items: center;
      font-size: 18px;
    }

    .left {
      display: flex;
      align-items: center;
      gap: 25px;
    }
    .center {
      font-size: 30px;
      letter-spacing: 2px;
    }
    .right {
      display: flex;
      align-items: center;
      gap: 25px;

      .icons {
        display: flex;
        gap: 15px;
        color: #777;
        cursor: pointer;

        .cartIcon {
          position: relative;

          span {
            font-size: 12px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #2879fe;
            color: white;
            position: absolute;
            right: -10px;
            top: -10px;
            display: flex;
            align-items: center;
            justify-content: center;
          }
        }
      }
    }
  }
}
</style>
