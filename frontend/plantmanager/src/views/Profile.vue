<template>
  <div class="container mx-auto grid grid-flow-col grid-rows-4 grid-cols-3 gap-3">
    <div class="col-start-1 col-span-3">
      <Nav/>
    </div>
    <div class="col-start-1">
      <Weather />
    </div>
    <div class="col-start-2">
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
    </div>
    <div class="col-start-3 bg-purple-200">
      Calendar
      <Calendar/>
    </div>
    <div class="row-start-3 col-start-1">
      <SideBar />
    </div>
    <div class="row-start-3 col-start-2 col-span-2 bg-blue-100">
      ?
    </div>
    <div class="row-start-4 col-start-1 col-span-3 bg-green-100">
      Footer
    </div>
  </div>
</template>

<script>
import TodoList from "@/components/TodoList";
import Nav from '@/components/Nav'
import SideBar from "@/components/SideBar";
import Loader from "@/components/Loader";
import Calendar from '@/components/Calendar'
import Weather from '@/components/Weather'
import router from "../router";

export default {
  data() {
    return {
      todos: [
        { id: 1, title: "Buy bread", completed: false },
        { id: 2, title: "Buy cheese", completed: false },
        { id: 3, title: "Buy eggs", completed: false }
      ],
      // loading: true
      filter: "all"
    };
  },
  // mounted() {
  //   fetch ('')
  //     .then(response => response.json)
  //     .then(json => {
  //       this.todos = json
  // this.loading = false
  //     })
  // },
  computed: {
    filteredTodos() {
      let filter;

      if (this.filter === "all") {
        filter = this.todos;
      }

      if (this.filter === "completed") {
        filter = this.todos.filter(t => t.completed);
      }

      if (this.filter === "not-completed") {
        filter = this.todos.filter(t => !t.completed);
      }

      return filter;
    }
  },
  components: {
    TodoList,
    SideBar,
    Loader,
    Calendar,
    Nav,
    Weather,
  },
  router
};
</script>

<style scoped>
.container {
  grid-template-rows: max-content;
}
</style>
