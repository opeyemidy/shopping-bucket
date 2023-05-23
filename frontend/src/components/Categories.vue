<template>
  <div class="categories">
    <div class="col">
      <div class="row">
        <img
          src="https://images.pexels.com/photos/818992/pexels-photo-818992.jpeg?auto=compress&cs=tinysrgb&w=1600"
          alt=""
        />
        <button>
          <router-link class="link" to="/products/1"> Sale </router-link>
        </button>
      </div>
      <div class="row">
        <img
          src="https://images.pexels.com/photos/2036646/pexels-photo-2036646.jpeg?auto=compress&cs=tinysrgb&w=1600"
          alt=""
        />
        <button>
          <router-link to="/products/1" class="link"> Women </router-link>
        </button>
      </div>
    </div>
    <div class="col">
      <div class="row">
        <img
          src="https://images.pexels.com/photos/1813947/pexels-photo-1813947.jpeg?auto=compress&cs=tinysrgb&w=1600"
          alt=""
        />
        <button>
          <router-link to="/products/1" class="link"> New Season </router-link>
        </button>
      </div>
    </div>
    <div class="col col-l">
      <div class="row">
        <div class="col">
          <div class="row">
            <img
              src="https://images.pexels.com/photos/1192609/pexels-photo-1192609.jpeg?auto=compress&cs=tinysrgb&w=1600"
              alt=""
            />
            <button>
              <router-link to="/products/1" class="link"> Men </router-link>
            </button>
          </div>
        </div>
        <div class="col">
          <div class="row">
            <img
              src="https://images.pexels.com/photos/2703202/pexels-photo-2703202.jpeg?auto=compress&cs=tinysrgb&w=1600"
              alt=""
            />
            <button>
              <router-link to="/products/1" class="link"> Accessories </router-link>
            </button>
          </div>
        </div>
      </div>
      <div class="row">
        <img
          src="https://images.pexels.com/photos/1159670/pexels-photo-1159670.jpeg?auto=compress&cs=tinysrgb&w=1600"
          alt=""
        />
        <button>
          <router-link to="/products/1" class="link"> Shoes </router-link>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from 'vue'
import { RouterLink } from 'vue-router'

export default defineComponent({
  name: 'Categories_',
  components: {
    RouterLink
  }
})
</script>

<style lang="scss" scoped>
.categories {
  display: flex;
  height: 80vh;
  gap: 10px;
  margin: 10px;

  .col {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .col-l {
    flex: 2;
  }

  .row {
    flex: 1;
    display: flex;
    gap: 10px;
    position: relative;
    overflow: hidden;

    button {
      position: absolute;
      min-width: 100px;
      width: fit-content;
      height: 50px;
      padding: 10px;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      margin: auto;
      cursor: pointer;
      border: none;
      background-color: white;
      text-transform: uppercase;
      font-weight: 500;
    }

    img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  }
}
</style>
