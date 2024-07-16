require('./bootstrap');
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import BookList from './components/BookList.vue';
import Pagination from './components/Pagination.vue';

const routes = [
  { path: '/', component: BookList }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

const app = createApp({});
app.component('pagination', Pagination);
app.use(router);
app.mount('#app');
