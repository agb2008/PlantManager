<template>
  <div
    class="container h-auto text-green-500 grid grid-rows-1 grid-cols-5 gap-6"
  >
    <div class="col-start-1">
      <div>
        <SideBar />
        <Weather />
      </div>
    </div>
    <div class="col-start-2 col-span-2 mt-5 justify-center text-center">
      <h4 class="mb-5 justify-start text-green-500 font-bold">Список задач:</h4>
      <TodoList />
    </div>
    <div class="col-start-4 col-span-2 row-start-1 row-span-1 mt-5 h-96">
      <div id="tabs">
        <div class="tabs flex justify-around m-5">
          <button 
          class="bg-transparent hover:bg-green-400 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded"
            v-on:click="activetab = 1"
            v-bind:class="[activetab === 1 ? 'active' : '']"
            >Календарь</button>
          <button 
          class="bg-transparent hover:bg-green-400 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded"
            v-on:click="activetab = 2"
            v-bind:class="[activetab === 2 ? 'active' : '']"
            >Лунный календарь</button>
        </div>
        <div class="content">
          <div v-if="activetab === 1" class="tabcontent">
            <FCalendar />
          </div>
          <div v-if="activetab === 2" class="tabcontent">
            <LunarCalendar />
          </div>
        </div>
      </div>
    </div>
    <div class="row-start-3 col-start-1"></div>
  </div>
</template>
<script>
import SideBar from "@/components/userProfile/SideBar";
import Weather from "@/components/userProfile/Weather";
import FCalendar from "@/components/Calendar/Fcalendar";
import LunarCalendar from "@/components/Calendar/LunarCalendar";
import TodoList from "@/components/userProfile/TodoList";
import { mapActions } from "vuex";

export default {
  data() {
    return {
      activetab: 1,
    };
  },
  components: {
    SideBar,
    Weather,
    FCalendar,
    LunarCalendar,
    TodoList,
  },
  method: {
    ...mapActions("todos", ["getAllData"]),
  },
  mounted() {
    this.$store.dispatch("todos/getAllData");
  },
};
</script>