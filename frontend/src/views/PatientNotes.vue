<!-- src/views/PatientNotes.vue -->
<template>
    <div class="max-w-2xl mx-auto p-4">
      <h1 class="text-2xl font-bold mb-4">Patient Notes</h1>
  
      <input
        v-model="search"
        @input="fetchNotes"
        placeholder="Search by title..."
        class="border px-2 py-1 rounded w-full mb-4"
      />
  
      <form @submit.prevent="addNote" class="mb-4 space-y-2">
        <input v-model="newNote.title" placeholder="Title" class="w-full border p-2 rounded" />
        <textarea v-model="newNote.content" placeholder="Content" class="w-full border p-2 rounded"></textarea>
        <button class="bg-green-600 text-white px-4 py-2 rounded">Add Note</button>
      </form>
  
      <LoadingIndicator v-if="isLoadingNotes" message="Loading notes..." />
      <div v-if="notes.length === 0 && !isLoadingNotes" class="text-gray-500">No notes found.</div>
  
      <div v-for="note in notes" :key="note.id" class="border p-4 rounded mb-2">
        <h2 class="font-semibold">{{ note.title }}</h2>
        <p>{{ note.content }}</p>
        <small class="text-gray-500">{{ new Date(note.created_at).toLocaleString() }}</small>
      </div>
  
      <button @click="generateSummary" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">
        <LoadingIndicator v-if="isLoadingSummary" message="Loading..." />
        <span v-else>Generate Summary</span>
      </button>
  
      <div v-if="summary" class="mt-4 p-4 bg-gray-100 rounded border">{{ summary }}</div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import axios from 'axios'
  import LoadingIndicator from '../components/LoadingIndicator.vue'
  
  const patientId = 1
  const notes = ref([])
  const search = ref('')
  const summary = ref('')
  const newNote = ref({ title: '', content: '' })
  const isLoadingNotes = ref(false)
  const isLoadingSummary = ref(false)
  
  const fetchNotes = async () => {
    isLoadingNotes.value = true
    try {
      const { data } = await axios.get(`http://localhost:8000/api/patients/${patientId}/notes`, {
        params: { search: search.value }
      })
      notes.value = data
    } catch (e) {
      console.error(e)
    } finally {
      isLoadingNotes.value = false
    }
  }
  
  const addNote = async () => {
    if (!newNote.value.title || !newNote.value.content) return
    await axios.post(`http://localhost:8000/api/patients/${patientId}/notes`, newNote.value)
    newNote.value = { title: '', content: '' }
    fetchNotes()
  }
  
  const generateSummary = async () => {
    isLoadingSummary.value = true
    try {
      const { data } = await axios.get(`http://localhost:8000/api/patients/${patientId}/notes/summary`)
      summary.value = data.summary
    } catch (e) {
      console.error(e)
    } finally {
      isLoadingSummary.value = false
    }
  }
  
  fetchNotes()
  </script>