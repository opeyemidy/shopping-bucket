<template>
  <div class="slider">
    <div class="container" :style="{ transform: `translateX(-${currentSlide * 100}vw)` }">
      <img v-for="(image, index) in data" :src="image" :alt="`Slide ${index + 1}`" :key="index" />
    </div>
    <div class="icons">
      <div class="icon" @click="prevSlide">
        <WestOutlinedIcon />
      </div>
      <div class="icon" @click="nextSlide">
        <EastOutlinedIcon />
      </div>
    </div>
  </div>
</template>

<script>
import { ref } from 'vue'
import WestOutlinedIcon from './icons/WestOutlinedIcon.vue'
import EastOutlinedIcon from './icons/EastOutlinedIcon.vue'

export default {
  name: 'Slider-Component',
  setup() {
    const currentSlide = ref(0)

    const data = [
      'https://images.pexels.com/photos/1549200/pexels-photo-1549200.jpeg?auto=compress&cs=tinysrgb&w=1600',
      'https://images.pexels.com/photos/949670/pexels-photo-949670.jpeg?auto=compress&cs=tinysrgb&w=1600',
      'https://images.pexels.com/photos/837140/pexels-photo-837140.jpeg?auto=compress&cs=tinysrgb&w=1600'
    ]

    const prevSlide = () => {
      console.log('tri')
      currentSlide.value = currentSlide.value === 0 ? 2 : currentSlide.value - 1
    }

    const nextSlide = () => {
      console.log('tri')
      currentSlide.value = currentSlide.value === 2 ? 0 : currentSlide.value + 1
    }

    return {
      currentSlide,
      data,
      prevSlide,
      nextSlide
    }
  },
  components: {
    WestOutlinedIcon,
    EastOutlinedIcon
  }
}
</script>

<style lang="scss" scoped>
.slider {
  height: calc(100vh - 80px);
  position: relative;
  overflow: hidden;

  .container {
    width: 300vw;
    height: 100%;
    display: flex;
    transition: all 1s ease;

    img {
      width: 100vw;
      height: 100%;
      object-fit: cover;
    }
  }

  .icons {
    width: fit-content;
    display: flex;
    position: absolute;
    left: 0;
    right: 0;
    bottom: 100px;
    gap: 10px;
    margin: auto;

    .icon {
      width: 50px;
      height: 50px;
      border: 1px solid #999;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
    }
  }
}
</style>
