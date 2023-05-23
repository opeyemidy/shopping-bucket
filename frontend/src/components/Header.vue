<template>
  <header>
    <div>
      <router-link to="/">Home</router-link>
    </div>
    <div>
      <button @click="showCart = !showCart">
        Cart <span>{{ cartItems.length }}</span>
      </button>
      <div v-if="showCart" class="cart-popup">
        <div v-if="cartItems.length === 0">No items in the cart</div>
        <div v-else>
          <div v-for="item in cartItems" :key="item.id">
            <h4>{{ item.name }}</h4>
            <p>Quantity: {{ item.quantity }}</p>
            <button @click="removeFromCart(item.id)">Remove</button>
          </div>
          <button @click="checkout">Checkout</button>
        </div>
      </div>
    </div>
  </header>
</template>

<script>
import { useCartStore } from '../stores/cart'
import { ref } from 'vue'

export default {
  name: 'AppHeader',
  setup() {
    const { cartItems, cartItemCount, removeFromCart } = useCartStore()
    const showCart = ref(false)

    function checkout() {
      // Handle checkout logic here
    }

    return {
      cartItems,
      cartItemCount,
      removeFromCart,
      showCart,
      checkout
    }
  }
}
</script>
