<template>
  <div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
      <div class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-light-blue-500 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
      <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
        <div class="max-w-md mx-auto">
          <div>
            <h1 class="text-3xl font-semibold text-gray-900 mb-8 text-center">Todo App</h1>
          </div>
          
          <!-- Add Todo Form -->
          <form @submit.prevent="addTodo" class="mb-8">
            <div class="mb-4">
              <input
                v-model="form.title"
                type="text"
                placeholder="Enter todo title..."
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
              />
            </div>
            <div class="mb-4">
              <textarea
                v-model="form.description"
                placeholder="Enter description (optional)..."
                rows="3"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              ></textarea>
            </div>
            <button
              type="submit"
              class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
              Add Todo
            </button>
          </form>

          <!-- Todo List -->
          <div class="space-y-3">
            <div v-if="todos.length === 0" class="text-center text-gray-500 py-8">
              No todos yet. Add one above!
            </div>
            
            <div
              v-for="todo in todos"
              :key="todo.id"
              class="bg-gray-50 p-4 rounded-lg border"
              :class="{ 'opacity-75': todo.completed }"
            >
              <div v-if="!editingTodo || editingTodo.id !== todo.id">
                <div class="flex items-center justify-between">
                  <div class="flex items-center space-x-3 flex-1">
                    <input
                      type="checkbox"
                      :checked="todo.completed"
                      @change="toggleTodo(todo)"
                      class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                    />
                    <div class="flex-1">
                      <h3
                        class="font-medium"
                        :class="{ 'line-through text-gray-500': todo.completed }"
                      >
                        {{ todo.title }}
                      </h3>
                      <p
                        v-if="todo.description"
                        class="text-sm text-gray-600 mt-1"
                        :class="{ 'line-through': todo.completed }"
                      >
                        {{ todo.description }}
                      </p>
                    </div>
                  </div>
                  <div class="flex space-x-2">
                    <button
                      @click="startEditing(todo)"
                      class="text-blue-600 hover:text-blue-800 text-sm"
                    >
                      Edit
                    </button>
                    <button
                      @click="deleteTodo(todo)"
                      class="text-red-600 hover:text-red-800 text-sm"
                    >
                      Delete
                    </button>
                  </div>
                </div>
              </div>
              
              <!-- Edit Form -->
              <div v-else>
                <form @submit.prevent="updateTodo(todo)">
                  <div class="mb-3">
                    <input
                      v-model="editingTodo.title"
                      type="text"
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                      required
                    />
                  </div>
                  <div class="mb-3">
                    <textarea
                      v-model="editingTodo.description"
                      rows="2"
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    ></textarea>
                  </div>
                  <div class="flex space-x-2">
                    <button
                      type="submit"
                      class="bg-green-500 text-white px-3 py-1 rounded text-sm hover:bg-green-600"
                    >
                      Save
                    </button>
                    <button
                      type="button"
                      @click="cancelEditing"
                      class="bg-gray-500 text-white px-3 py-1 rounded text-sm hover:bg-gray-600"
                    >
                      Cancel
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue'
import { router } from '@inertiajs/vue3'

// Props
const props = defineProps({
  todos: Array
})

// Reactive form for adding new todos
const form = reactive({
  title: '',
  description: ''
})

// Editing state
const editingTodo = ref(null)

// Add new todo
const addTodo = () => {
  router.post('/todos', form, {
    onSuccess: () => {
      form.title = ''
      form.description = ''
    }
  })
}

// Toggle todo completion
const toggleTodo = (todo) => {
  router.patch(`/todos/${todo.id}/toggle`)
}

// Start editing
const startEditing = (todo) => {
  editingTodo.value = { ...todo }
}

// Cancel editing
const cancelEditing = () => {
  editingTodo.value = null
}

// Update todo
const updateTodo = (todo) => {
  router.put(`/todos/${todo.id}`, editingTodo.value, {
    onSuccess: () => {
      editingTodo.value = null
    }
  })
}

// Delete todo
const deleteTodo = (todo) => {
  if (confirm('Are you sure you want to delete this todo?')) {
    router.delete(`/todos/${todo.id}`)
  }
}
</script>