<template>
  <div class="flex justify-between mb-5">
    <button  class="flex bg-transparent hover:bg-green-400 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded" :class="{active: filter === 'all'}"
    @click="changeFilter('all')">Все</button>
    <button class="bg-transparent hover:bg-green-400 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded" :class="{active: filter === 'active'}" 
    @click="changeFilter('completed')">Законченные</button>
    <button class="bg-transparent hover:bg-green-400 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded" :class="{active: filter === 'completed'}" 
    @click="changeFilter('active')">Незаконченные</button>
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