<template>
  <div>
    <ul>
      <TodoItem
        v-for="(todo, index) in todosFiltered"
        :key="todo.id"
        :index="index"
        :todo="todo"
        :checkAll="!anyRemaining"
      />
    </ul>
    <div>
      <TodoCheckAll/>
      <TodoItemsRemaining/>
    </div>
    <div>
      <TodoFiltered/>
      <TodoClearCompleted/>
    </div>
  </div>
</template>

<script>
import TodoItem from "@/components/userProfile/TodoItem";
import TodoCheckAll from "@/components/userProfile/TodoCheckAll"
import TodoItemsRemaining from "@/components/userProfile/TodoItemsRemaining"
import TodoFiltered from "@/components/userProfile/TodoFiltered"
import TodoClearCompleted from "@/components/userProfile/TodoClearCompleted"
import {mapGetters} from 'vuex'

export default {
  components: {
    TodoItem,
    TodoCheckAll,
    TodoItemsRemaining,
    TodoFiltered,
    TodoClearCompleted
  },
  computed: {
    ...mapGetters('todos', [
      'remaining',
      'anyRemaining',
      'todosFiltered',
      'showClearCompletedButtons'
    ])
  }
};
</script>

/* eslint-disable */
