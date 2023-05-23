import { ref, computed } from 'vue'
import { defineStore } from 'pinia'

export const useCartStore = defineStore('cart', () => {
  const cart = ref([])

  function updateCartItems(data) {
    cart.value.splice(0, cart.value.length, ...data)
  }
  function addToCart(product) {
    const existingProduct = cart.value.find((item) => item.id === product.id)

    if (existingProduct) {
      existingProduct.quantity = product.quantity
    } else {
      cart.value.push(product)
    }
  }

  function removeFromCart(cartId) {
    const index = cart.value.findIndex((item) => item.id === cartId)
    if (index !== -1) {
      cart.value.splice(index, 1)
    }
  }

  function resetCart() {
    cart.value.splice(0)
  }

  const totalPrice = computed(() => {
    return cart.value.reduce((total, item) => total + item.price * item.quantity, 0).toFixed(2)
  })

  return {
    updateCartItems,
    addToCart,
    removeFromCart,
    resetCart,
    cartItems: cart,
    totalPrice
  }
})
