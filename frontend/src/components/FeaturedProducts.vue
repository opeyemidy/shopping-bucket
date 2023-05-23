<template>
  <div class="featuredProducts">
    <div class="top">
      <h1>{{ productType }} products</h1>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
        labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo
        viverra maecenas accumsan lacus vel facilisis labore et dolore magna aliqua. Quis ipsum
        suspendisse ultrices gravida. Risus commodo viverra maecenas.
      </p>
    </div>
    <div class="bottom">
      <template v-if="error">
        <p>Something went wrong!</p>
      </template>
      <template v-else-if="isLoading">
        <p>Loading</p>
      </template>
      <template v-else>
        <Card v-for="item in responseData" :key="item.id" :item="item" />
      </template>
    </div>
  </div>
</template>

<script>
import { defineComponent, ref } from 'vue'
import Card from './Card.vue'
import useMakeRequest from '@/hooks/useMakeRequest'
import { onMounted } from 'vue'

export default defineComponent({
  name: 'FeaturedProducts',
  props: {
    type: {
      type: String,
      required: true
    }
  },
  components: {
    Card
  },
  setup(props) {
    const makeRequest = useMakeRequest()
    const responseData = ref(null)
    const error = ref(null)

    const fetchData = async () => {
      try {
        responseData.value = null
        error.value = null
        makeRequest.isLoading.value = true
        const data = await makeRequest.get('/products')
        responseData.value = data
      } catch (err) {
        error.value = err
      } finally {
        makeRequest.isLoading.value = false
      }
    }
    onMounted(fetchData)

    return {
      isLoading: makeRequest.isLoading,
      responseData,
      error,
      fetchData,
      productType: props.type
    }
  }
})
</script>

<style lang="scss" scoped>
.featuredProducts {
  margin: 100px 200px;

  .top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 50px;

    h1 {
      flex: 2;
      text-transform: capitalize;
    }

    p {
      flex: 3;
      color: gray;
    }
  }

  .bottom {
    display: flex;
    flex-wrap: wrap;
    /* justify-content: center; */
    gap: 50px;
  }
}
</style>
