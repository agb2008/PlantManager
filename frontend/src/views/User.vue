<template>
  <div
    class="container mx-auto text-green-500 grid grid-flow-col grid-rows-3 grid-cols-3 gap-3"
  >
    <div class="col-start-1">
      <div>
        <SideBar />
        <Weather />
      </div>
    </div>
    <div class="col-start-2 mt-5 justify-center text-center max-w-xs">
      <h4>Список задач на ближайщие 5 (пять) дней:</h4>
      <select v-model="filter">
        <option value="all">Все задачи</option>
        <option value="completed">Законченные задачи</option>
        <option value="not-completed">Текущие задачи</option>
      </select>
      <TodoList
      />
    </div>
    <div class="col-start-3 mt-5 bg-purple-200">
      <Calendar />
    </div>
    <div class="row-start-3 col-start-1"></div>
  </div>
</template>
<script>
import SideBar from "@/components/userProfile/SideBar";
import Weather from "@/components/userProfile/Weather";
import Calendar from "@/components/userProfile/Calendar";
import TodoList from "@/components/userProfile/TodoList";

export default {
  components: {
    SideBar,
    Weather,
    Calendar,
    TodoList,
  },
};
</script>

<style scoped>
.container {
  grid-template-rows: max-content;
  grid-template-columns: max-content;
}
</style>
