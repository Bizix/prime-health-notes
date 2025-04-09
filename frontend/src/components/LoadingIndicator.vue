<template>
    <div class="flex items-center justify-center gap-2 text-gray-500 text-sm italic animate-pulse">
      <svg class="w-4 h-4 animate-spin text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
      </svg>
      <span>{{ message }}</span>
    </div>
  </template>
  
  <script setup>
  defineProps({
    message: {
      type: String,
      default: 'Loading...'
    }
  })
  </script>