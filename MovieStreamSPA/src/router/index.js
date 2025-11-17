import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import MovieDetail from '../views/MovieDetail.vue'

const routes = [
  { path: '/', name: 'home', component: Home },
  { path: '/movie/:id', name: 'movie-detail', component: MovieDetail },
]

export default createRouter({
  history: createWebHistory(),
  routes
})
