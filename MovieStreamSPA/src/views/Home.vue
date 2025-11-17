<script setup>
import { ref } from "vue";

const categories = ref([
  {
    name: "Trending",
    movies: [
      {
        id: 1,
        title: "Avengers: Endgame",
        poster: "https://image.tmdb.org/t/p/w500/or06FN3Dka5tukK1e9sl16pB3iy.jpg",
        rating: 8.4,
      },
      {
        id: 2,
        title: "Joker",
        poster: "https://image.tmdb.org/t/p/w500/udDclJoHjfjb8Ekgsd4FDteOkCU.jpg",
        rating: 8.5,
      },
      {
        id: 3,
        title: "Interstellar",
        poster: "https://image.tmdb.org/t/p/w500/rAiYTfKGqDCRIIqo664sY9XZIvQ.jpg",
        rating: 8.6,
      },
      {
        id: 4,
        title: "Inception",
        poster: "https://image.tmdb.org/t/p/w500/qmDpIHrmpJINaRKAfWQfftjCdyi.jpg",
        rating: 8.7,
      },
    ],
  },

  {
    name: "Action",
    movies: [
      {
        id: 5,
        title: "John Wick",
        poster: "https://image.tmdb.org/t/p/w500/fZPSd91yGE9fCcCe6OoQr6E3Bev.jpg",
        rating: 7.8,
      },
      {
        id: 6,
        title: "Mad Max: Fury Road",
        poster: "https://image.tmdb.org/t/p/w500/hA2ple9q4qnwxp3hKVZh0rFym1P.jpg",
        rating: 8.1,
      },
      {
        id: 7,
        title: "The Dark Knight",
        poster: "https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg",
        rating: 9.0,
      },
    ],
  },

  {
    name: "Sci-Fi",
    movies: [
      {
        id: 8,
        title: "Dune",
        poster: "https://image.tmdb.org/t/p/w500/d5NXSklXo0qyIYkgV94XAgMIckC.jpg",
        rating: 8.0,
      },
      {
        id: 9,
        title: "The Matrix",
        poster: "https://image.tmdb.org/t/p/w500/aOiCl7UKb0IRZQtG8bKkEMHcO30.jpg",
        rating: 8.7,
      },
      {
        id: 10,
        title: "Blade Runner 2049",
        poster: "https://image.tmdb.org/t/p/w500/aMpyrCizvSILj1c0GLYjG17QW3t.jpg",
        rating: 8.1,
      },
    ],
  },
]);
</script>

<template>
  <div class="pt-20">

    <!-- HERO SECTION -->
    <div
      class="w-full h-[60vh] bg-cover bg-center relative"
      style="background-image: url('https://image.tmdb.org/t/p/original/or06FN3Dka5tukK1e9sl16pB3iy.jpg')"
    >
      <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black/30"></div>

      <div class="absolute bottom-12 left-8 text-white">
        <h1 class="text-4xl font-bold">Avengers: Endgame</h1>
        <p class="text-gray-300 mt-2 max-w-xl">
          The remaining Avengers assemble for one final stand.
        </p>
        <router-link
          to="/movie/1"
          class="mt-4 inline-block bg-red-600 hover:bg-red-700 px-6 py-2 rounded-md shadow text-lg font-semibold transition"
        >
          ▶ Play
        </router-link>
      </div>
    </div>

    <!-- MOVIE CATEGORIES -->
    <div class="px-6 py-10 space-y-10">

      <div v-for="cat in categories" :key="cat.name" class="space-y-4">
        <h2 class="text-2xl font-bold text-white">{{ cat.name }}</h2>

        <!-- Horizontal Scroll Row -->
        <div class="flex gap-4 overflow-x-auto scrollbar-hide pb-2">
          <router-link
            v-for="movie in cat.movies"
            :key="movie.id"
            :to="`/movie/${movie.id}`"
            class="min-w-[150px] sm:min-w-[180px] group"
          >
            <img
              :src="movie.poster"
              class="rounded-lg shadow-md h-48 w-full object-cover group-hover:opacity-80 transition"
            />
            <h3 class="text-white mt-2 font-medium truncate">{{ movie.title }}</h3>
            <p class="text-yellow-400 text-sm">⭐ {{ movie.rating }}</p>
          </router-link>
        </div>
      </div>

    </div>
  </div>
</template>

<style>
/* hide scrollbar for horizontal rows */
.scrollbar-hide::-webkit-scrollbar {
  display: none;
}
.scrollbar-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}

body {
  background-color: #0b0b0b;
}
</style>
