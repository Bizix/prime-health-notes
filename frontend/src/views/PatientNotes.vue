<template>
  <div class="max-w-2xl mx-auto p-4">

    <!-- Heading -->
    <h1 class="text-3xl font-extrabold text-gray-800 text-center mb-6 tracking-tight">
      Patient Notes
    </h1>

    <!-- Controls: Search + Summary + Add Note Toggle -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4 flex-wrap">
      <label for="search" class="sr-only">Search by title</label>
      <input
        v-model="search"
        @input="fetchNotes"
        placeholder="Search by title..."
        class="flex-1 border px-3 py-2 rounded bg-white"
      />

      <div class="flex flex-wrap gap-2 justify-center sm:justify-end">
        <button
        type="button"
          @click="toggleSummary"
          class="bg-blue-600 text-white px-4 py-2 rounded whitespace-nowrap w-[160px] hover:bg-blue-700 transition cursor-pointer"
        >
          <LoadingIndicator v-if="isLoadingSummary" message="Loading..." />
          <span v-else>{{ summary ? 'Hide Summary' : 'Generate Summary' }}</span>
        </button>

        <button
          type="button"
          @click="showForm = !showForm"
          class="text-sm px-4 py-2 border border-green-600 bg-white text-green-600 rounded hover:bg-green-50 transition cursor-pointer w-[160px] text-center"
        >
          {{ showForm ? 'Hide Note Form' : 'Add a New Note' }}
        </button>
      </div>
    </div>

    <!-- Note Form -->
    <NoteForm v-if="showForm" @submit="addNote" />

    <!-- Error message -->
    <div v-if="error" class="text-red-500 text-sm mb-4 text-center">
      {{ error }}
    </div>

    <!-- Summary -->
    <div v-if="summary" class="mb-6 p-4 bg-white rounded border text-sm">
      {{ summary }}
    </div>

    <!-- Notes -->
    <LoadingIndicator v-if="isLoadingNotes" message="Loading notes..." />
    <div v-if="notes.length === 0 && !isLoadingNotes" class="text-gray-500">No notes found.</div>
    <NoteCard  v-if="!isLoadingNotes" v-for="note in notes" :key="note.id" :note="note" />

    <!-- Pagination -->
    <Pagination 
      v-if="!isLoadingNotes"
      :currentPage="pagination.current_page"
      :lastPage="pagination.last_page"
      @page-change="fetchNotes"
    />
  </div>
</template>


  
  <script setup>
  import { ref } from 'vue'
  import axios from 'axios'
  import LoadingIndicator from '../components/LoadingIndicator.vue'
  import NoteCard from '../components/NoteCard.vue'
  import NoteForm from '../components/NoteForm.vue'
  import Pagination from '../components/Pagination.vue'
  
  const patientId = 1
  const notes = ref([])
  const search = ref('')
  const summary = ref('')
  const pagination = ref({
    current_page: 1,
    last_page: 1
  })
  const error = ref('')
  const showForm = ref(false)
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
      error.value = ''
    } catch (e) {
      console.error(e)
      error.value = 'Something went wrong. Please try again.'
    } finally {
      isLoadingNotes.value = false
    }
  }

  
  const addNote = async (note) => {
    if (!note.title || !note.content) return

    isLoadingNotes.value = true
    error.value = ''
    showForm.value = false

    try {
      await axios.post(`http://localhost:8000/api/patients/${patientId}/notes`, note)
      await fetchNotes()
    } catch (e) {
      console.error(e)
      error.value = 'Unable to add note. Please try again.'
    } finally {
      isLoadingNotes.value = false
    }
  }
    
  const toggleSummary = async () => {
    if (summary.value) {
      summary.value = ''
    } else {
      await generateSummary()
    }
  }

  const generateSummary = async () => {
    isLoadingSummary.value = true
    try {
      const { data } = await axios.get(`http://localhost:8000/api/patients/${patientId}/notes/summary`)
      summary.value = data.summary
      error.value = ''
    } catch (e) {
      console.error(e)
      error.value = 'Something went wrong. Please try again.'
    } finally {
      isLoadingSummary.value = false
    }
  }
  
  fetchNotes()
  </script>