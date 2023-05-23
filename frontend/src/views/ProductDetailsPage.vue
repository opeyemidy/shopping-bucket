<template>
  <div className="product">
    <template v-if="error">
      <p>Something went wrong!</p>
    </template>
    <template v-else-if="isLoading">
      <p>Loading</p>
    </template>
    <template v-else>
      <div className="left">
        <div className="images">
          <img src="https://placehold.it/143x150" alt="" />
          <img src="https://placehold.it/143x150" alt="" />
        </div>
        <div className="mainImg"><img src="https://placehold.it/715x750" alt="" /></div>
      </div>
      <div className="right">
        <h1>{{ product?.name }}</h1>
        <span className="price">${{ product?.price }}</span>
        <p>{{ product?.description }}</p>
        <div className="quantity">
          <button @click="quantity > 1 && quantity--">-</button>
          {{ quantity }}
          <button @click="quantity++">+</button>
        </div>
        <button className="add" @click="addToCart" :disabled="isAddingToCart">
          <AddShoppingCartIcon /> {{ isAddingToCart ? 'Adding' : 'ADD TO CART' }}
        </button>
        <div className="links">
          <div className="item"><FavoriteBorderOutlinedIcon /> ADD TO WISH LIST</div>
          <div className="item"><BalanceIcon /> ADD TO COMPARE</div>
        </div>
        <div className="info">
          <span>Vendor: Polo</span>
          <span>Product Type: T-Shirt</span>
          <span>Tag: T-Shirt, Women, Top</span>
        </div>
        <hr />
        <div className="info">
          <span>DESCRIPTION</span>
          <hr />
          <span>ADDITIONAL INFORMATION</span>
          <hr />
          <span>FAQ</span>
        </div>
      </div>
    </template>
  </div>
</template>

<script>
import { useCartStore } from '@/stores/cart'
import {
  ref,
  onMounted
  //  computed
} from 'vue'
import useMakeRequest from '@/hooks/useMakeRequest'
import { useRoute } from 'vue-router'
import AddShoppingCartIcon from '../components/icons/AddShoppingCartIcon.vue'
import FavoriteBorderOutlinedIcon from '../components/icons/FavoriteBorderOutlinedIcon.vue'
import BalanceIcon from '../components/icons/BalanceIcon.vue'

export default {
  name: 'ProductDetailsPage',
  props: ['id'],
  setup() {
    const cartStore = useCartStore()
    const getProductDetails = useMakeRequest()
    const addToCartRequest = useMakeRequest()
    const route = useRoute()
    const quantity = ref(1)
    const product = ref(null)
    const error = ref(null)
    const fetchData = async () => {
      try {
        const data = await getProductDetails.get(`/products/${route.params.id}`)
        product.value = data.data
      } catch (err) {
        error.value = err
      } finally {
        getProductDetails.isLoading.value = false
      }
    }
    async function addToCart() {
      const data = await addToCartRequest.post('/cart', {
        product_id: product.value.id,
        quantity: quantity.value
      })
      const { product: productData, ...rest } = data.data
      const { name, description, price } = productData
      cartStore.addToCart({ ...rest, name, description, price })
    }
    onMounted(() => {
      fetchData()
      // for (let i = 0; i < 10; i++) {
      //   addToCart(i + 1, 1)
      // }
    })

    return {
      quantity,
      isLoading: getProductDetails.isLoading,
      isAddingToCart: addToCartRequest.isLoading,
      product,
      error,
      fetchData,
      addToCart
    }
  },
  components: { AddShoppingCartIcon, FavoriteBorderOutlinedIcon, BalanceIcon }
}
</script>

<style lang="scss">
.product {
  padding: 20px 50px;
  display: flex;
  gap: 50px;

  .left {
    flex: 1;
    display: flex;
    gap: 20px;
    .images {
      flex: 1;

      img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        cursor: pointer;
        margin-bottom: 10px;
      }
    }
    .mainImg {
      flex: 5;

      img {
        width: 100%;
        max-height: 800px;
        object-fit: cover;
      }
    }
  }
  .right {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 30px;

    .price {
      font-size: 30px;
      color: #2879fe;
      font-weight: 500;
    }

    p {
      font-size: 18px;
      font-weight: 300;
      text-align: justify;
    }

    .quantity {
      display: flex;
      align-items: center;
      gap: 10px;

      button {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: none;
      }
    }

    .add {
      width: 250px;
      padding: 10px;
      background-color: #2879fe;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 20px;
      cursor: pointer;
      border: none;
      font-weight: 500;
    }

    .links {
      display: flex;
      gap: 20px;

      .item {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #2879fe;
        font-size: 14px;
      }
    }

    .info {
      display: flex;
      flex-direction: column;
      gap: 10px;
      color: gray;
      font-size: 14px;
      margin-top: 30px;

      hr {
        width: 200px;
        border: 1px solid rgb(238, 237, 237);
      }
    }

    hr {
      border: 1px solid rgb(238, 237, 237);
    }
  }
}
</style>
