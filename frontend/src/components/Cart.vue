<template>
  <div class="cart">
    <h1>There are {{ cartItems.length > 0 ? cartItems.length : 'no' }} Product(s) in your cart</h1>
    <div v-for="item in cartItems" :key="item.id" class="item">
      <img src="https://placehold.it/80x100" alt="" />
      <div class="details">
        <h1>{{ item.name }}</h1>
        <p>{{ item.description?.substring(0, 100) }}</p>
        <div class="price">{{ item.quantity }} x ${{ item.price }}</div>
      </div>
      <DeleteOutlinedIcon class="delete" @click="removeFromCart(item.id)" />
    </div>
    <div class="total">
      <span>SUBTOTAL</span>
      <span>${{ cartStore.totalPrice }}</span>
    </div>
    <button @click="handlePayment" :disabled="cartItems.length === 0">PROCEED TO CHECKOUT</button>
    <span class="reset" @click="resetCart">Reset Cart</span>
  </div>
</template>

<script>
import { defineComponent } from 'vue'
import DeleteOutlinedIcon from './icons/DeleteOutlinedIcon.vue'
import { useCartStore } from '../stores/cart'
import useMakeRequest from '@/hooks/useMakeRequest'

export default defineComponent({
  name: 'Cart_',
  components: {
    DeleteOutlinedIcon
  },
  setup() {
    const cartStore = useCartStore()
    const makeRequest = useMakeRequest()
    const checkoutRequest = useMakeRequest()

    async function removeFromCart(cartId) {
      await makeRequest.deleteRequest('/cart', { cart_id: cartId })
      cartStore.removeFromCart(cartId)
    }
    function resetCart() {
      cartStore.resetCart()
    }

    const handlePayment = async () => {
      await checkoutRequest.post('/payment', {})
      if (!checkoutRequest.error.value) resetCart()
    }

    return {
      removeFromCart,
      resetCart,
      cartStore,
      cartItems: cartStore.cartItems,
      handlePayment
    }
  }
})
</script>

<style lang="scss" scoped>
.cart {
  position: absolute;
  right: 20px;
  top: 80px;
  z-index: 999;
  background-color: white;
  padding: 20px;
  -webkit-box-shadow: 0px 0px 7px -5px rgba(0, 0, 0, 0.5);
  box-shadow: 0px 0px 7px -5px rgba(0, 0, 0, 0.5);

  h1 {
    margin-bottom: 30px;
    color: gray;
    font-weight: 400;
    font-size: 24px;
  }

  .item {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 30px;
    img {
      width: 80px;
      height: 100px;
      object-fit: cover;
    }

    .details {
      h1 {
        font-size: 18px;
        font-weight: 500;
      }

      p {
        color: gray;
        margin-bottom: 10px;
        font-size: 14px;
      }

      .price {
        color: #2879fe;
      }
    }

    .delete {
      color: red;
      font-size: 30px;
      cursor: pointer;
    }
  }

  .total {
    display: flex;
    justify-content: space-between;
    font-weight: 500;
    font-size: 18px;
    margin-bottom: 20px;
  }

  button {
    width: 250px;
    padding: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
    cursor: pointer;
    border: none;
    background-color: #2879fe;
    color: white;
    font-weight: 500;
    margin-bottom: 20px;
  }

  .reset {
    color: red;
    font-size: 12px;
    cursor: pointer;
  }
}
</style>
