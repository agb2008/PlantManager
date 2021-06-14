<template>
  <div>
    <ul >
      <TodoItem
        v-for="(todo, index) in todos" :key="index"
        v-bind:todo="todo"
        v-on:todochanged="$emit('reloadlist')"
      />
    </ul>
  </div>
</template>

<script>
import TodoItem from "@/components/userProfile/TodoItem";
export default {
  props: ["todos"],
  components: {
    TodoItem
  }
};
</script>
