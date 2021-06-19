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
      <Calendar />
    </div>
    <div class="row-start-3 col-start-1"></div>
  </div>
</template>
<script>
import SideBar from "@/components/userProfile/SideBar";
import Weather from "@/components/userProfile/Weather";
import Calendar from "@/components/Calendar/Fcalendar";
import TodoList from "@/components/userProfile/TodoList";
import { mapActions } from "vuex";

export default {
  components: {
    SideBar,
    Weather,
    Calendar,
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

