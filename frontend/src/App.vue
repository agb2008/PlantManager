<template>
  <div id="app">
    <Inventory user="user1"></Inventory>
  </div>
</template>

<script>

import Inventory from './views/Inventory.vue'

export default {
  name: 'App',
  components: {
    Inventory
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
