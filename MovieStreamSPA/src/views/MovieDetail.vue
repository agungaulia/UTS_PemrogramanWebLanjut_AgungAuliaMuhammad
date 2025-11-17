<script setup>
import { useRoute, useRouter } from 'vue-router'
import { ref } from 'vue'

const route = useRoute()
const router = useRouter()

// Data film lokal (bisa diganti API TMDB)
const movies = [
  {
    id: 1,
    title: "Avengers: Endgame",
    desc: "The Avengers assemble once more to undo Thanos’ actions.",
    poster: "https://image.tmdb.org/t/p/w500/or06FN3Dka5tukK1e9sl16pB3iy.jpg",
    rating: 8.4,
  },
  {
    id: 2,
    title: "Joker",
    desc: "A mentally troubled comedian embarks on a dark path.",
    poster: "https://image.tmdb.org/t/p/w500/udDclJoHjfjb8Ekgsd4FDteOkCU.jpg",
    rating: 8.5,
  },
  {
    id: 3,
    title: "Interstellar",
    desc: "A group of explorers travel through a wormhole in space.",
    poster: "https://image.tmdb.org/t/p/w500/rAiYTfKGqDCRIIqo664sY9XZIvQ.jpg",
    rating: 8.6,
  },
  {
    id: 4,
    title: "Inception",
    desc: "A skilled thief steals information through dream-sharing tech.",
    poster: "https://image.tmdb.org/t/p/w500/qmDpIHrmpJINaRKAfWQfftjCdyi.jpg",
    rating: 8.7,
  },

  // ACTION
  {
    id: 5,
    title: "John Wick",
    desc: "A hitman seeks vengeance after the loss of his dog.",
    poster: "https://image.tmdb.org/t/p/w500/fZPSd91yGE9fCcCe6OoQr6E3Bev.jpg",
    rating: 7.8,
  },
  {
    id: 6,
    title: "Mad Max: Fury Road",
    desc: "In a post-apocalyptic wasteland, Max teams up with Furiosa.",
    poster: "https://image.tmdb.org/t/p/w500/hA2ple9q4qnwxp3hKVZh0rFym1P.jpg",
    rating: 8.1,
  },
  {
    id: 7,
    title: "The Dark Knight",
    desc: "Batman faces the Joker in a fight for Gotham.",
    poster: "https://image.tmdb.org/t/p/w500/qJ2tW6WMUDux911r6m7haRef0WH.jpg",
    rating: 9.0,
  },

  // SCI-FI
  {
    id: 8,
    title: "Dune",
    desc: "A noble family becomes embroiled in a war on desert planet Arrakis.",
    poster: "https://image.tmdb.org/t/p/w500/d5NXSklXo0qyIYkgV94XAgMIckC.jpg",
    rating: 8.0,
  },
  {
    id: 9,
    title: "The Matrix",
    desc: "A hacker discovers the truth about reality.",
    poster: "https://image.tmdb.org/t/p/w500/aOiCl7UKb0IRZQtG8bKkEMHcO30.jpg",
    rating: 8.7,
  },
  {
    id: 10,
    title: "Blade Runner 2049",
    desc: "A young blade runner uncovers a hidden secret.",
    poster: "https://image.tmdb.org/t/p/w500/aMpyrCizvSILj1c0GLYjG17QW3t.jpg",
    rating: 8.1,
  },
];


const movie = ref(
  movies.find(m => m.id == route.params.id)
)
</script>

<template>
  <div class="pt-24 px-6 max-w-4xl mx-auto text-white">

    <button @click="router.back()" 
      class="mb-6 text-red-400 hover:text-red-500 transition">
      ← Kembali
    </button>

    <div class="flex flex-col md:flex-row gap-8">

      <img
        :src="movie.poster"
        class="w-full md:w-72 rounded-lg shadow-lg"
      />

      <div>
        <h1 class="text-4xl font-bold mb-3">{{ movie.title }}</h1>

        <p class="text-yellow-400 text-lg mb-4">⭐ Rating: {{ movie.rating }}</p>

        <p class="text-gray-300 leading-relaxed">{{ movie.desc }}</p>
      </div>

    </div>

  </div>
</template>
