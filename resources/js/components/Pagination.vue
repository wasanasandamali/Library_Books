<!-- resources/js/components/Pagination.vue -->
<template>
  <ul class="pagination">
    <li v-if="pagination.current_page > 1">
      <button @click="changePage(pagination.current_page - 1)">Previous</button>
    </li>
    <li v-for="page in pagesNumber" :key="page" :class="{ 'active': page === pagination.current_page }">
      <button @click="changePage(page)">{{ page }}</button>
    </li>
    <li v-if="pagination.current_page < pagination.last_page">
      <button @click="changePage(pagination.current_page + 1)">Next</button>
    </li>
  </ul>
</template>

<script>
export default {
  props: ['data'],
  computed: {
    pagination() {
      return this.data;
    },
    pagesNumber() {
      let pagesArray = [];
      for (let i = this.pagination.from; i <= this.pagination.to; i++) {
        pagesArray.push(i);
      }
      return pagesArray;
    }
  },
  methods: {
    changePage(page) {
      this.$emit('pagination-change-page', page);
    }
  }
};
</script>

<style scoped>
.pagination {
  display: flex;
  list-style: none;
  padding: 0;
}
.pagination li {
  margin: 0 5px;
}
.pagination li.active button {
  font-weight: bold;
}
</style>
