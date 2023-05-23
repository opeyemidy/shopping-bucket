<template>
  <router-link class="link" :to="`/products/${item.id}`">
    <div class="card">
      <div class="image">
        <span v-if="false">New Season</span>
        <img
          src="https://placehold.it/280x400
"
          alt=""
          class="mainImg"
        />
        <img src="https://placehold.it/280x400" alt="" class="secondImg" />
      </div>
      <h2>{{ item.name }}</h2>
      <div class="prices">
        <h3>${{ parseInt(item.price) + Number((parseInt(item.price) * 0.1).toFixed(2)) }}</h3>
        <h3>${{ item.price }}</h3>
      </div>
    </div>
  </router-link>
</template>

<script>
export default {
  name: 'Card_',
  props: {
    item: {
      type: Object,
      required: true
    }
  }
}
</script>

<style lang="scss" scoped>
.card {
  width: 280px;
  display: flex;
  flex-direction: column;
  gap: 10px;
  margin-bottom: 50px;

  .image {
    width: 100%;
    height: 400px;
    overflow: hidden;
    position: relative;

    &:hover {
      .secondImg {
        z-index: 2;
      }
    }

    img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      position: absolute;
    }

    .mainImg {
      z-index: 1;
    }

    span {
      position: absolute;
      top: 5px;
      left: 5px;
      background-color: white;
      color: teal;
      padding: 3px 5px;
      z-index: 3;
      font-weight: 500;
      font-size: 12px;
    }
  }

  h2 {
    font-size: 16px;
    font-weight: 400;
  }

  .prices {
    display: flex;
    gap: 20px;

    h3 {
      font-size: 18px;
      font-weight: 500;

      &:first-child {
        color: gray;
        text-decoration: line-through;
      }
    }
  }
}
</style>
