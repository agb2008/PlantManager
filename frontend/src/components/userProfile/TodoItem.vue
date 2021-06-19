<template>
  <div class="w-auto font-green-500">
    <li
      class="m-3 p-3 flex justify-between text-left rounded-md text-base font-medium hover:bg-gray-200"
    >
      <span class="" :class="{ completed: completed }">
        <div>
          <input
            type="checkbox"
            class="flex-shrink-0 h-6 w-6 text-gray-400"
            v-model="completed"
            v-on:change="doneEdit"
          />
          <span
            class="justify-between m-5 mb-10 items-center rounded-md text-base font-medium"
          >
            {{ date }}
          </span>
          <span
            class="justify-between m-5 mb-10 items-center font-bold rounded-md text-base font-medium"
          >
            {{ title }}
          </span>
        </div>

        <span
          class="justify-between m-5 ml-12 mb-10 text-xs items-center rounded-md font-medium text-green-500"
        >
          Для этого необходимо: {{ description }}
        </span>
      </span>
      <div>
        <button
          class="font-bold text-6x1 text-red-800 text-center"
          @click="removeTodo(index)"
        >
          &times;
        </button>
      </div>
    </li>
  </div>
</template>

<script>
import { mapActions } from "vuex";
export default {
  props: {
    todo: {
      type: Object,
      required: true,
    },
    index: {
      type: Number,
      required: true,
    },
    checkAll: {
      type: Boolean,
      required: true,
    },
  },
  data() {
    return {
      id: this.todo.id,
      title: this.todo.title,
      date: this.todo.due_date,
      description: this.todo.description,
      completed: this.todo.completed,
      beforeEditCache: "",
    };
  },
  methods: {
    ...mapActions("todos", ["removeTodo", "updateTodo"]),
    editTodo() {
      this.beforeEditCache = this.title;
      this.editing = true;
    },
    doneEdit() {
      if (this.title.trim() === 0) {
        this.title = this.beforeEditCache;
      }
      this.editing = false;
      const data = {
        id: this.id,
        title: this.title,
        completed: this.completed,
        editing: this.editing,
      };

      this.updateTodo(data);
    },
    cancelEdit() {
      this.title = this.beforeEditCache;
      this.editing = false;
    },
  },
  directives: {
    focus: {
      inserted: function (el) {
        el.focus();
      },
    },
  },
  watch: {
    checkAll() {
      this.completed = this.checkAll ? true : this.todo.completed;
    },
  },
};
</script>

<style scoped>
.completed {
  text-decoration: line-through;
}
button :active {
  outline: none
}
</style>
