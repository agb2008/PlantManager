<template>
  <div>
    <li
      class="m-3 p-3 flex justify-between items-center rounded-md text-base font-medium text-gray-900 hover:bg-gray-200"
    >
      <span v-bind:class="{ done: todo.completed }">
        <input
          type="checkbox"
          class="flex-shrink-0 h-6 w-6 text-gray-400"
          v-on:change="todo.completed = !todo.completed"
        />
        <span
          class="justify-center m-10 mb-10 p-3 items-center rounded-md text-base font-medium text-gray-900"
        >
          {{ todo.title | uppercase }}
        </span>
      </span>
    </li>
  </div>
</template>

<script>
export default {
  props: {
    todo: {
      type: Object,
      required: true
    }
  },
  filters: {
    uppercase(value) {
      return value.toUpperCase();
    }
  }
};
</script>

<style scoped>
.done {
  text-decoration: line-through;
}
</style>
