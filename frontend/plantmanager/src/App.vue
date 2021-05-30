<template>
  <div id="app">
    <GardenBed />
    <!-- <CreateTask /> -->
  </div>
</template>

<script>
import GardenBed from './components/GardenBed.vue'
// import CreateTask from './components/tasks_components/CreateTask'

export default {
  name: 'App',
  components: {
    GardenBed,
    // CreateTask
  }
}
</script>

<style>
    .my-container{
        width: 100%;
    }
</style>
