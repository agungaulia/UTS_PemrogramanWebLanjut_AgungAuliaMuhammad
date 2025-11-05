<template>
  <div
    class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-blue-100 p-6 sm:p-10 flex flex-col items-center"
  >
    <!-- Tombol Kembali -->
    <div class="w-full max-w-5xl mb-6">
      <router-link
        to="/"
        class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-semibold transition"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke Daftar Buku
      </router-link>
    </div>

    <!-- Kontainer Detail -->
    <div
      v-if="buku"
      class="w-full max-w-5xl bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200 flex flex-col lg:flex-row"
    >
      <!-- Cover Buku -->
      <div class="lg:w-1/2 w-full h-96 lg:h-auto bg-gray-100">
        <img
          :src="buku.cover || 'https://via.placeholder.com/600x900?text=No+Cover'"
          alt="Cover Buku"
          class="w-full h-full object-cover"
        />
      </div>

      <!-- Informasi Buku -->
      <div class="lg:w-1/2 w-full p-8 flex flex-col justify-between">
        <div>
          <h1 class="text-4xl font-extrabold text-gray-900 mb-3 leading-snug">
            {{ buku.judul }}
          </h1>
          <p class="text-lg text-gray-600 mb-6">
            oleh <span class="font-semibold text-gray-800">{{ buku.penulis }}</span>
          </p>

          <div class="space-y-4 text-gray-700 text-base">
            <div class="flex justify-between">
              <span class="font-medium text-gray-800">📘 Penerbit:</span>
              <span>{{ buku.penerbit }}</span>
            </div>
            <div class="flex justify-between">
              <span class="font-medium text-gray-800">📅 Tahun Terbit:</span>
              <span>{{ buku.tahun_terbit }}</span>
            </div>
            <div class="flex justify-between">
              <span class="font-medium text-gray-800">📦 Stok:</span>
              <span
                :class="buku.stok > 0 ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold'"
              >
                {{ buku.stok }}
              </span>
            </div>
          </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="mt-8 flex flex-col sm:flex-row gap-3">
          <router-link
            :to="`/edit/${buku.id}`"
            class="flex-1 text-center bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl shadow transition"
          >
            ✏️ Edit Buku
          </router-link>
          <button
            @click="hapusBuku(buku.id)"
            class="flex-1 text-center bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl shadow transition"
          >
            🗑️ Hapus Buku
          </button>
        </div>
      </div>
    </div>

    <!-- Loading State -->
    <div v-else class="text-center text-gray-600 mt-20">
      <div class="animate-spin inline-block w-8 h-8 border-4 border-indigo-300 border-t-indigo-600 rounded-full"></div>
      <p class="mt-4 text-lg">Memuat detail buku...</p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import api from "../api";

const route = useRoute();
const router = useRouter();
const buku = ref(null);

// Ambil detail buku dari API
const getDetailBuku = async (id) => {
  try {
    const res = await api.get(`/buku/${id}`);
    buku.value = res.data;
  } catch (err) {
    console.error("Gagal mengambil detail buku:", err);
  }
};

// Hapus buku
const hapusBuku = async (id) => {
  if (confirm("Apakah Anda yakin ingin menghapus buku ini?")) {
    try {
      await api.delete(`/buku/${id}`);
      router.push("/");
    } catch (err) {
      console.error("Gagal menghapus buku:", err);
    }
  }
};

// Saat halaman dimuat
onMounted(() => {
  getDetailBuku(route.params.id);
});

// Jika pindah ke buku lain tanpa reload
watch(
  () => route.params.id,
  (id) => {
    if (id) getDetailBuku(id);
  }
);
</script>
