<template>
    <form @submit.prevent="onSubmit" class="mb-6 p-4 border rounded bg-white shadow space-y-3">
      <input
        v-model="note.title"
        placeholder="Title"
        class="w-full border p-2 rounded"
      />
      <textarea
        v-model="note.content"
        placeholder="Content"
        class="w-full border p-2 rounded"
      ></textarea>
      <button
        type="submit"
        class="bg-green-600 text-white px-4 py-2 rounded cursor-pointer hover:bg-green-700 transition"
      >
        Add Note
      </button>
    </form>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  
  const emit = defineEmits(['submit'])
  
  const note = ref({ title: '', content: '' })
  
  const onSubmit = () => {
    emit('submit', { ...note.value })
    note.value = { title: '', content: '' }
  }
  </script>
  