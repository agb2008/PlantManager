<template>
  <div id="app">
    <inventory-list user="user1"></inventory-list>
  </div>
</template>

<script>

import InventoryList from './components/InventoryList.vue'

export default {
  name: 'App',
  components: {
    InventoryList
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
