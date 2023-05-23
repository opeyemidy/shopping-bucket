<template>
  <div className="home">
    <Slider />
    <Categories />
    <FeaturedProducts type="trending" />
    <ChooseUs />
    <Contact />
  </div>
</template>

<script>
import Slider from '../components/Slider.vue'
import Categories from '../components/Categories.vue'
import FeaturedProducts from '../components/FeaturedProducts.vue'
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'Homepage_',
  components: { Slider, Categories, FeaturedProducts }
})
</script>
