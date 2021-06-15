<template>
  <div
    class="container mx-auto grid grid-flow-col grid-rows-4 grid-cols-3 gap-3"
  >
    <div class="col-start-1">
      <Weather />
    </div>
    <!-- <div class="col-start-2">
      <h4>Список задач на ближайщие 5 (пять) дней:</h4>
      <select v-model="filter">
        <option value="all">Все задачи</option>
        <option value="completed">Законченные задачи</option>
        <option value="not-completed">Текущие задачи</option>
      </select>
      <Loader v-if="loading" />
      <TodoList v-else-if="filteredTodos.length" v-bind:todos="filteredTodos" />
      <p v-else>
        Задания отсутствуют! У Вас появилась возможность передохнуть.
      </p>
    </div> -->
    <div class="col-start-3 bg-purple-200">
      Calendar
      <Calendar />
    </div>
    <div class="row-start-3 col-start-1">
      <SideBar />
    </div>
    <div class="row-start-3 col-start-2 col-span-2 bg-blue-100">?</div>
    <div class="row-start-4 col-start-1 col-span-3 bg-green-100">Footer</div>
  </div>
</template>

<script>
// import TodoList from "@/components/userProfile/TodoList";
import SideBar from "@/components//userProfile/SideBar";
// import Loader from "@/components//userProfile/Loader";
import Calendar from "@/components//userProfile/Calendar";
import Weather from "@/components//userProfile/Weather";

export default {
  data() {
    return {
      todos: [],
      loading: true,
      filter: "all",
    };
  },
  // mounted() {
  //   fetch("http://localhost:8000/api/calendar_tasks")
  //     .then((response) => response.json)
  //     .then((json) => {
  //       this.todos = json;
  //       this.loading = false;
  //     });
  // },
  computed: {
    filteredTodos() {
      let filter;

      if (this.filter === "all") {
        filter = this.todos;
      } else if (this.filter === "completed") {
        filter = this.todos.filter((t) => t.completed);
      } else if (this.filter === "not-completed") {
        filter = this.todos.filter((t) => !t.completed);
      }

      return filter;
    },
  },
  components: {
    // TodoList,
    SideBar,
    // Loader,
    Calendar,
    Weather,
  },
};
</script>

<style scoped>
.container {
  grid-template-rows: max-content;
}
</style>
