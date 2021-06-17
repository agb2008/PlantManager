<template>
  <div class="flex justify-between">
    <button :class="{active: filter === 'all'}"
    @click="changeFilter('all')">Все задачи</button>
    <button :class="{active: filter === 'active'}" 
    @click="changeFilter('active')">Незаконченные</button>
    <button :class="{active: filter === 'completed'}" 
    @click="changeFilter('completed')">Законченные</button>
  </div>
</template>

<script>
import { mapActions } from 'vuex';
export default {
  name: 'todo-filtered',
  computed: {
    filter(){
      return this.$store.state.filter
    }
  },
  methods: {
    ...mapActions('todos', ['changeFilter'])
  }
}
</script>