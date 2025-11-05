<template>
  <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-blue-50 py-10 px-4 sm:px-8 lg:px-12">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-10 gap-4">
      <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-600 drop-shadow-sm">
        📚 Koleksi Buku
      </h1>
      <router-link
        to="/create"
        class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-2.5 px-5 rounded-xl shadow-md transition-transform transform hover:scale-105"
      >
        + Tambah Buku
      </router-link>
    </div>

    <!-- SEARCH -->
    <div class="max-w-3xl mx-auto mb-8">
      <input
        type="text"
        v-model="searchQuery"
        placeholder="🔍 Cari berdasarkan judul atau penulis..."
        class="w-full p-4 border border-gray-300 rounded-2xl shadow-sm focus:outline-none focus:ring-4 focus:ring-indigo-200 text-gray-700"
      />
    </div>

    <!-- GRID VIEW BUKU -->
    <div v-if="!bukuTerpilih" class="max-w-7xl mx-auto">
      <transition-group
        name="fade"
        tag="div"
        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8"
      >
        <div
          v-for="buku in bukuFilter"
          :key="buku.id"
          @click="pilihBuku(buku)"
          class="group bg-white border border-gray-100 rounded-2xl shadow-md overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer"
        >
        <div class="w-full h-72 bg-gray-100 flex items-center justify-center">
  <img
    :src="buku.cover || 'https://via.placeholder.com/300x450?text=No+Cover'"
    alt="Cover Buku"
    class="max-h-full max-w-full object-contain"
  />
  </div>  
        <!-- <div class="relative">
            <img
              :src="buku.cover || 'https://via.placeholder.com/300x450?text=No+Cover'"
              alt="Cover Buku"
              class="w-full h-72 object-cover"
            />
            <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-all"></div>
          </div> -->
          <div class="p-4">
            <h2 class="font-bold text-lg text-gray-800 group-hover:text-indigo-600 transition line-clamp-2">
              {{ buku.judul }}
            </h2>
            <p class="text-sm text-gray-500 mt-1">✍️ {{ buku.penulis }}</p>
            <p class="text-xs text-gray-400 mt-1">{{ buku.penerbit }} • {{ buku.tahun_terbit }}</p>
            <p class="mt-3 font-semibold" :class="buku.stok > 0 ? 'text-green-600' : 'text-red-600'">
              Stok: {{ buku.stok }}
            </p>
          </div>
        </div>
      </transition-group>

      <div v-if="bukuFilter.length === 0" class="text-center py-20 text-gray-500 italic">
        <span v-if="searchQuery">📭 Tidak ada buku yang cocok dengan pencarian.</span>
        <span v-else>📚 Data buku belum tersedia atau sedang dimuat...</span>
      </div>
    </div>

    <!-- DETAIL VIEW -->
    <div v-else class="max-w-4xl mx-auto">
      <button @click="kembaliKeDaftar" class="text-indigo-600 hover:underline font-medium mb-6">
        ← Kembali ke Daftar Buku
      </button>

      <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border border-gray-100">
        <!-- Cover -->
        <div class="relative">
          <img
            :src="bukuTerpilih.cover || 'https://via.placeholder.com/600x900?text=No+Cover'"
            alt="Cover Buku"
            class="w-full h-[500px] object-cover"
          />
          <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
          <h1 class="absolute bottom-6 left-8 text-white text-4xl font-bold drop-shadow-lg">
            {{ bukuTerpilih.judul }}
          </h1>
        </div>

        <div class="p-6 sm:p-10">
          <p class="text-lg text-gray-700 mb-4">
            ✍️ oleh <span class="font-semibold">{{ bukuTerpilih.penulis }}</span>
          </p>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700">
            <div class="bg-gray-50 rounded-lg p-4">
              <p class="text-sm font-semibold text-gray-500">📖 Penerbit</p>
              <p class="text-gray-800">{{ bukuTerpilih.penerbit || '-' }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4">
              <p class="text-sm font-semibold text-gray-500">📅 Tahun Terbit</p>
              <p class="text-gray-800">{{ bukuTerpilih.tahun_terbit || '-' }}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4 sm:col-span-2">
              <p class="text-sm font-semibold text-gray-500">📦 Stok Tersisa</p>
              <p class="text-xl font-bold" :class="bukuTerpilih.stok > 0 ? 'text-green-600' : 'text-red-600'">
                {{ bukuTerpilih.stok }}
              </p>
            </div>
          </div>

          <div class="mt-8 flex flex-col sm:flex-row gap-3">
            <router-link
              :to="`/edit/${bukuTerpilih.id}`"
              class="flex-1 text-center bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl shadow transition-transform transform hover:scale-105"
            >
              ✏️ Edit Buku
            </router-link>
            <button
              @click="hapusBukuDariDetail(bukuTerpilih.id)"
              class="flex-1 text-center bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl shadow transition-transform transform hover:scale-105"
            >
              🗑️ Hapus Buku
            </button>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script setup>
import api from '../api/index.js'
import { ref, onMounted, computed } from 'vue'

const semuaBuku = ref([])
const searchQuery = ref('')
const bukuTerpilih = ref(null)

// Ambil data buku dari API
const getBuku = async () => {
  try {
    const res = await api.get('/buku')
    semuaBuku.value = res.data
  } catch (error) {
    console.error('Gagal mengambil data buku:', error)
  }
}

// Filter pencarian
const bukuFilter = computed(() => {
  if (!searchQuery.value) return semuaBuku.value
  const q = searchQuery.value.toLowerCase()
  return semuaBuku.value.filter(b =>
    b.judul.toLowerCase().includes(q) || b.penulis.toLowerCase().includes(q)
  )
})

// Navigasi buku
const pilihBuku = (buku) => (bukuTerpilih.value = buku)
const kembaliKeDaftar = () => (bukuTerpilih.value = null)

// Hapus buku
const hapusBukuDariDaftar = async (id) => {
  if (confirm('Apakah Anda yakin ingin menghapus buku ini?')) {
    try {
      await api.delete(`/buku/${id}`)
      getBuku()
    } catch (error) {
      console.error('Gagal menghapus buku:', error)
    }
  }
}

const hapusBukuDariDetail = async (id) => {
  if (confirm('Apakah Anda yakin ingin menghapus buku ini?')) {
    try {
      await api.delete(`/buku/${id}`)
      await getBuku()
      bukuTerpilih.value = null
    } catch (error) {
      console.error('Gagal menghapus buku:', error)
    }
  }
}

onMounted(() => getBuku())
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: all 0.3s ease;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
  transform: translateY(10px);
}
</style>
