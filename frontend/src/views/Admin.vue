<template>
  <div>
    <h1>Potential products for Discount</h1>
    <VTable :columns="header" :items="data" />
  </div>
</template>

<script>
import VTable from '@/components/Table.vue'
import useMakeRequest from '@/hooks/useMakeRequest'
import { onMounted, reactive } from 'vue'

export default {
  name: 'Admin_',
  components: { VTable },
  setup() {
    const header = reactive([
      { key: 'id', label: 'ID' },
      { key: 'name', label: 'Name' },
      { key: 'price', label: 'Price' },
      { key: 'remove_count', label: 'Number of times Removed' }
    ])
    const data = reactive([])

    const discountRequest = useMakeRequest()
    const fetchDiscountData = async () => {
      const discountData = await discountRequest.get('/discount-products')
      const normalizedData = discountData.map((item) => {
        const { product, ...rest } = item
        const { price, name } = product
        return {
          ...rest,
          price: `$${price}`,
          name
        }
      })
      data.push(...normalizedData) // Use `push` instead of `concat` to update the reactive array
    }
    onMounted(fetchDiscountData)

    return {
      header,
      data
    }
  }
}
</script>
<style scoped>
h1 {
  text-align: center;

  margin-bottom: 16px;
}
</style>
