<template>
  <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-blue-50 py-10 px-6 sm:px-10 lg:px-16">
    <div class="max-w-3xl mx-auto bg-white shadow-2xl rounded-2xl overflow-hidden border border-gray-100 p-8">
      <h1 class="text-3xl font-extrabold text-indigo-700 mb-6 text-center">✏️ Edit Buku</h1>

      <form @submit.prevent="updateBuku" v-if="form" class="space-y-5">
        <!-- Judul -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">Judul Buku</label>
          <input
            v-model="form.judul"
            type="text"
            required
            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none"
            placeholder="Masukkan judul buku"
          />
        </div>

        <!-- Penulis -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">Penulis</label>
          <input
            v-model="form.penulis"
            type="text"
            required
            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none"
            placeholder="Nama penulis"
          />
        </div>

        <!-- Penerbit -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">Penerbit</label>
          <input
            v-model="form.penerbit"
            type="text"
            required
            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none"
            placeholder="Nama penerbit"
          />
        </div>

        <!-- Tahun Terbit -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">Tahun Terbit</label>
          <input
            v-model="form.tahun_terbit"
            type="month"
            required
            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none"
          />
          <p class="text-xs text-gray-500 mt-1">Pilih bulan dan tahun (tahun otomatis disimpan)</p>
        </div>

        <!-- Stok -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">Stok</label>
          <input
            v-model="form.stok"
            type="number"
            min="0"
            required
            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none"
            placeholder="Jumlah stok"
          />
        </div>

        <!-- Cover Buku -->
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-1">URL Cover Buku</label>
          <input
            v-model="form.cover"
            type="url"
            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none"
            placeholder="Masukkan URL gambar cover (opsional)"
          />
          <div v-if="form.cover" class="mt-3 flex justify-center">
            <img
              :src="form.cover"
              alt="Preview Cover"
              class="w-40 h-56 object-contain border rounded-lg shadow-md bg-gray-50"
            />
          </div>
        </div>

        <!-- Tombol -->
        <div class="pt-6 flex flex-col sm:flex-row justify-center gap-4">
          <button
            type="submit"
            class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition transform hover:scale-105"
          >
            💾 Simpan Perubahan
          </button>
          <router-link
            to="/"
            class="w-full sm:w-auto text-center bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-3 px-6 rounded-lg shadow-md transition transform hover:scale-105"
          >
            ↩️ Batal
          </router-link>
        </div>
      </form>

      <!-- Loading -->
      <div v-else class="text-center py-10 text-gray-500">
        <div class="animate-spin w-8 h-8 border-4 border-indigo-300 border-t-indigo-600 rounded-full mx-auto mb-4"></div>
        Memuat data buku...
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import api from "../api";

const route = useRoute();
const router = useRouter();

const form = ref(null);

// Ambil data buku dari API
onMounted(async () => {
  try {
    const res = await api.get(`/buku/${route.params.id}`);
    // Pastikan tahun_terbit dalam format yyyy-mm agar bisa tampil di <input type="month">
    if (res.data.tahun_terbit) {
      res.data.tahun_terbit = `${res.data.tahun_terbit}-01`;
    }
    form.value = res.data;
  } catch (error) {
    console.error("Gagal memuat data buku:", error);
  }
});

// Fungsi update buku
const updateBuku = async () => {
  try {
    // Ambil hanya tahun dari input type="month"
    const data = { ...form.value, tahun_terbit: form.value.tahun_terbit.slice(0, 4) };
    await api.put(`/buku/${route.params.id}`, data);
    alert("✅ Buku berhasil diperbarui!");
    router.push("/");
  } catch (error) {
    console.error("Gagal memperbarui buku:", error);
    alert("❌ Terjadi kesalahan saat menyimpan perubahan!");
  }
};
</script>
