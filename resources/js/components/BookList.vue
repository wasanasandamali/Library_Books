<!-- resources/js/components/BookList.vue -->
<template>
  <div>
    <h1>Library Books</h1>
    <input v-model="search" @input="fetchBooks" placeholder="Search books...">
    <div v-if="books.length">
      <ul>
        <li v-for="book in books" :key="book.id">
          <h3>{{ book.title }}</h3>
          <p>{{ book.description }}</p>
          <p>{{ book.genre }}</p>
          <p>{{ book.price }}</p>
          <button @click="borrowBook(book.id)">Borrow</button>
        </li>
      </ul>
      <pagination :data="pagination" @pagination-change-page="fetchBooks"></pagination>
    </div>
    <div v-else>
      <p>No books found.</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Pagination from './Pagination.vue';

export default {
  components: { Pagination },
  data() {
    return {
      books: [],
      search: '',
      pagination: {}
    };
  },
  methods: {
    fetchBooks(page = 1) {
      axios.get(`/api/books?page=${page}&search=${this.search}`).then(response => {
        this.books = response.data.data;
        this.pagination = response.data.meta;
      });
    },
    borrowBook(bookId) {
      axios.post(`/api/books/borrow/${bookId}`).then(() => {
        alert('Book borrowed successfully');
      });
    }
  },
  mounted() {
    this.fetchBooks();
  }
};
</script>
