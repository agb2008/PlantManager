<template>
  <div>
    <ul>
      <TodoItem
        v-for="(todo, index) in todos"
        v-bind:todo="todo"
        v-bind:key="index"
      />
    </ul>
  </div>
</template>

<script>
import TodoItem from "@/components/TodoItem";
export default {
  props: ["todos"],
  components: {
    TodoItem
  }
};
</script>
