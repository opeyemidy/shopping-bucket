<template>
  <table class="table">
    <thead>
      <tr>
        <th v-for="column in columns" :key="column.key">{{ column.label }}</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in items" :key="item.id">
        <td v-for="column in columns" :key="column.key">{{ item[column.key] }}</td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import { defineComponent } from 'vue'
export default defineComponent({
  name: 'V-Table',
  props: {
    columns: {
      type: Array,
      required: true
    },
    items: {
      type: Array,
      required: true
    }
  }
})
</script>

<style lang="scss" scoped>
.table {
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
  border-collapse: collapse;
  th,
  td {
    padding: 8px;
    border: 1px solid #ccc;
  }
}
</style>
