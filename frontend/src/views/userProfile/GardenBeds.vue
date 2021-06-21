<template>
  <div id="gb">
    <GardenBed
      :doingsArray="doingsArray"
      :rows="quantityRows"
      :columns="quantityColumns"
    />
    <!-- <CreateTask /> -->
  </div>
</template>

<script>
import GardenBed from "@/components/GardenBed.vue";
// import CreateTask from '../components/tasks_components/CreateTask'

export default {
  name: "App",
  components: {
    GardenBed,
    // CreateTask
  },
  data() {
    return {
      doingsArray: [
        {
          id: 1,
          plantId: 1,
          name: "помидор",
          img: "./images/44_tomato_food-tomato.svg",
        },
        {
          id: 2,
          plantId: 2,
          name: "перец",
          img: "./images/30_bell_pepper.svg",
        },
        {
          id: 3,
          plantId: 3,
          name: "огурец",
          img: "./images/8_cucumber-slice-publicdomainvectors.org.svg",
        },
        {
          id: 4,
          plantId: 4,
          name: "томат чери",
          img: "./images/173_cherryTomato-branch-publicdomainvectors.org.svg",
        },
        {
          id: 5,
          plantId: 5,
          name: "черника",
          img: "./images/221_blackberry.svg",
        },
        {
          id: 6,
          plantId: 6,
          name: "разделение",
          img: "./images/deviding.jpg",
          background: "#5a5a5a",
        },
        {
          id: 7,
          name: "очистка",
          img: "./images/kisclean.jpg",
          background: "none",
        },
      ],
      quantityRows: 20,
      quantityColumns: 30,
    };
  },
};
</script>

<style>
.my-container {
  width: 100%;
}
</style>
