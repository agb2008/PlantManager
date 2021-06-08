<template>
  <div id="app">
    <GardenBed 
		:doingsArray="doingsArray"
		:rows="quantityRows"
		:columns="quantityColumns"
     />
    <!-- <CreateTask /> -->
  </div>
</template>

<script>
import GardenBed from '../components/GardenBed.vue';
// import CreateTask from '../components/tasks_components/CreateTask'

export default {
  name: 'App',
  components: {
    GardenBed,
    // CreateTask
  },
  data(){
        return {
            doingsArray: [
                {
                    name: "tomato", 
                    img: "./images/44_tomato_food-tomato.svg", 
                },
                {
                    name: "bell_pepper", 
                    img: "./images/30_bell_pepper.svg", 
                },
                {
                    name: "cucumber", 
                    img: "./images/8_cucumber-slice-publicdomainvectors.org.svg", 
                },
                {
                    name: "chery_tomat", 
                    img: "./images/173_cherryTomato-branch-publicdomainvectors.org.svg", 
                },
                {
                    name: "blackberry", 
                    img: "./images/221_blackberry.svg", 
                },
                {
                    name: "deviding", 
                    img: "./images/deviding.jpg", 
                    background: "#5a5a5a", 
                },
                {
                    name: "clean", 
                    img: "./images/kisclean.jpg", 
                    background: "none", 
                }
            ],
            quantityRows: 20,
            quantityColumns: 30,
        }
    },
}
</script>

<style>
    .my-container{
        width: 100%;
    }
</style>