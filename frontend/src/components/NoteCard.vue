<template>
    <div class="border p-4 rounded mb-4 shadow-sm bg-white">
      <h2 class="font-semibold text-lg mb-1">{{ note.title }}</h2>
      <p class="mb-2 text-sm">{{ note.content }}</p>
      <small class="text-gray-500 text-xs">{{ formatDate(note.created_at) }}</small>
    </div>
  </template>
  
  <script setup>
  defineProps({
    note: Object
  })
  
  function formatDate(dateStr) {
    return new Date(dateStr).toLocaleString()
  }
  </script>