<template>
  <div>
    <li
      class="m-3 p-3 flex justify-between text-center rounded-md text-base font-medium hover:bg-gray-200"
    >
      <span v-bind:class="{ done: todo.completed }">
        <input
          type="checkbox"
          class="flex-shrink-0 h-6 w-6 text-gray-400"
          v-on:change="updateCheck"
        />
        <span
          class="justify-between m-10 mb-10 p-3 items-center rounded-md text-base font-medium text-gray-900"
        >
          {{ todo.date }}
        </span>
        <span
          class="justify-between m-10 mb-10 p-3 items-center font-bold rounded-md text-base font-medium text-gray-900"
        >
          {{ todo.title }}
        </span>
        <span
          class="justify-between m-10 mb-10 p-3 items-center rounded-md text-base font-medium text-gray-900"
        >
          {{ todo.description }}
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
      required: true,
    },
  },
  // computed: {
  //   updateCheck() {
  //     fetch('http://localhost:8000/api/calendar_tasks/' + this.todo.id, {
  //       todo: this.todo
  //     })
  //     .then(response => response.json)
  //     .then(this.$emit('todochanged'))
  //     .catch(error => {
  //       console.log(error)
  //     })
  //   }
  // }
};
</script>

<style scoped>
.done {
  text-decoration: line-through;
}
</style>
