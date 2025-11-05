import { createRouter, createWebHistory } from 'vue-router';
import ListData from '../views/ListData.vue';
import Create from '../views/Create.vue';
import Edit from '../views/Edit.vue';

const routes = [
  { path: '/', component: ListData },
  { path: '/create', component: Create },
  { path: '/edit/:id', component: Edit }
];

export default createRouter({
  history: createWebHistory(),
  routes
});
