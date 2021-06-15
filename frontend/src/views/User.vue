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
      <Loader v-if="loading" />
      <TodoList
        v-else-if="filteredTodos.length"
        v-bind:todos="filteredTodos"
        v-on:reloadlist="getList()"
      />
      <p v-else>Задачи отсутствуют! У Вас появилась возможность передохнуть.</p>
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
import Loader from "@/components/userProfile/Loader";

export default {
  components: {
    SideBar,
    Weather,
    Calendar,
    TodoList,
    Loader,
  },
  data() {
    return {
      todos: [
        {
          id: 1,
          date: "2021-06-15",
          title: "Полить помидоры",
          description: "2 литра",
          completed: false,
        },
        {
          id: 2,
          date: "2021-06-15",
          title: "Buy cheese",
          description: "Мягкий и пушистый",
          completed: false,
        },
        {
          id: 3,
          date: "2021-06-15",
          title: "Buy eggs",
          description: "Сначала разбить, потом пожарить",
          completed: false,
        },
      ],
      // loading: true
      filter: "all",
    };
  },
  computed: {
    // getList() {
    //   fetch("http://localhost:8000/api/calendar_tasks")
    //     .then((response) => response.json)
    //     .then((json) => {
    //       this.todos = json;
    //       // this.loading = false;
    //     });
    // },
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
      // this.loading = false
    },
  },
  // created() {
  //   this.getList();
  // },
};
</script>

<style scoped>
.container {
  grid-template-rows: max-content;
  grid-template-columns: max-content;
}
</style>
