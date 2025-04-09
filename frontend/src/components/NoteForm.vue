<template>
  <form @submit.prevent="onSubmit" class="mb-6 p-4 border rounded bg-white shadow space-y-3">
    <!-- Title -->
    <div>
      <label for="note-title" class="sr-only">Title</label>
      <input
        id="note-title"
        v-model="note.title"
        placeholder="Enter note title"
        class="w-full border p-2 rounded"
      />
    </div>

    <!-- Content -->
    <div>
      <label for="note-content" class="sr-only">Content</label>
      <textarea
        id="note-content"
        v-model="note.content"
        placeholder="Enter note content"
        class="w-full border p-2 rounded"
      ></textarea>
    </div>
    <div class="flex justify-center">
      <button
        type="submit"
        class="bg-green-600 text-white px-4 py-2 rounded cursor-pointer hover:bg-green-700 transition"
      >
        Add Note
      </button>
    </div>
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
