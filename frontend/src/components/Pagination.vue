<template>
    <div class="flex justify-center gap-2 mt-4 items-center text-sm text-gray-700">
      <button
        type="button"
        v-if="currentPage > 1"
        @click="$emit('page-change', currentPage - 1)"
        class="px-3 py-1 rounded bg-gray-200 cursor-pointer hover:bg-gray-300 transition"
      >
        Prev
      </button>
      <span>Page {{ currentPage }} of {{ lastPage }}</span>
      <button
        type="button"
        v-if="currentPage < lastPage"
        @click="$emit('page-change', currentPage + 1)"
        class="px-3 py-1 rounded bg-gray-200 cursor-pointer hover:bg-gray-300 transition"
      >
        Next
      </button>
    </div>
  </template>
  
  <script setup>
  defineProps({
    currentPage: Number,
    lastPage: Number,
  })
  defineEmits(['page-change'])
  </script>
  