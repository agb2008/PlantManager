<template>
  <button class="bg-transparent hover:bg-green-400 text-green-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded" 
  v-if="showClearCompletedButton" 
  @click="clearCompleted">
  Удалить выполненные задачи
  </button>
</template>

<script>
import {mapGetters, mapActions} from 'vuex'
export default {
  computed: {
    ...mapGetters('todos', ['showClearCompletedButton'])
  },
  methods: {
    ...mapActions('todos', ['clearCompleted'])
  }
}
</script>