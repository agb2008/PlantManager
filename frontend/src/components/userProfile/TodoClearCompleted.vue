<template>
  <button 
  v-if="showClearCompletedButton" 
  @click="clearCompleted">
  Clear Completed
  </button>
</template>

<script>
import {mapGetters, mapActions} from 'vuex'
export default {
  name: 'todo-clear-completed',
  computed: {
    ...mapGetters('todos', ['showClearCompletedButton'])
  },
  methods: {
    ...mapActions('todos', ['clearCompleted'])
  }
}
</script>