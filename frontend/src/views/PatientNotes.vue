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
  
      <div  v-if="!isLoadingNotes" v-for="note in notes" :key="note.id" class="border p-4 rounded mb-2">
        <h2 class="font-semibold">{{ note.title }}</h2>
        <p>{{ note.content }}</p>
        <small class="text-gray-500">{{ new Date(note.created_at).toLocaleString() }}</small>
      </div>

      <div class="flex justify-center gap-2 mt-4 items-center text-sm text-gray-700">
        <!-- Prev Button -->
        <button
          v-if="pagination.current_page > 1"
          @click="fetchNotes(pagination.current_page - 1)"
          class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300 transition"
        >
          Prev
        </button>

        <span>Page {{ pagination.current_page }} of {{ pagination.last_page }}</span>

        <!-- Next Button -->
        <button
          v-if="pagination.current_page < pagination.last_page"
          @click="fetchNotes(pagination.current_page + 1)"
          class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300 transition"
        >
          Next
        </button>
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
  const pagination = ref({
    current_page: 1,
    last_page: 1
  })
  const isLoadingNotes = ref(false)
  const isLoadingSummary = ref(false)
  
  const fetchNotes = async (page = 1) => {
    isLoadingNotes.value = true
    try {
      const { data } = await axios.get(`http://localhost:8000/api/patients/${patientId}/notes`, {
        params: {
          search: search.value,
          page
        }
      })

      notes.value = data.data
      pagination.value.current_page = data.current_page
      pagination.value.last_page = data.last_page
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