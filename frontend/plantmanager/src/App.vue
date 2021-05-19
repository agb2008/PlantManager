<template>
  <div id="app">
    <!-- <img alt="Vue logo" src="./assets/logo.png">
    <HelloWorld msg="Welcome to Your Vue.js App"/> -->
    <GardenBed />
  </div>
</template>

<script>
// import HelloWorld from './components/HelloWorld.vue'
import GardenBed from './components/GardenBed.vue'

export default {
  name: 'App',
  components: {
    // HelloWorld,
    GardenBed
  }
}
</script>

<style>
    .my-container{
        width: 100%;
    }
</style>
