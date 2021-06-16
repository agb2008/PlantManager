<template>
  <div>
    <li
      class="m-3 p-3 flex justify-between text-center rounded-md text-base font-medium hover:bg-gray-200"
    >
      <span
        v-if="!editing"
        @dbclick="editTodo"
        :class="{ completed: completed }"
      >
        <input
          type="checkbox"
          class="flex-shrink-0 h-6 w-6 text-gray-400"
          v-model="completed"
          v-on:change="doneEdit"
        />
        <span
          class="justify-between m-10 mb-10 p-3 items-center rounded-md text-base font-medium text-gray-900"
        >
          {{ date }}
        </span>
        <span
          class="justify-between m-10 mb-10 p-3 items-center font-bold rounded-md text-base font-medium text-gray-900"
        >
          {{ title }}
        </span>
        <span
          class="justify-between m-10 mb-10 p-3 items-center rounded-md text-base font-medium text-gray-900"
        >
          {{ description }}
        </span>
      </span>
      <!-- <input
        v-else
        type="text"
        v-model="title"
        @blur="doneEdit"
        @key.enter="doneEdit"
        @key.esc="cancelEdit"
        v-focus
      /> -->
      <div>
        <!-- <button @click="pluralize">Pluralize</button> -->
        <span class="remove-item" @click="removeTodo(index)">&times;</span>
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
      date: this.todo.date,
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

      // const index = this.$store.state.todos.todos.findIndex(
      //   (item) => item.id === data.id
      // );
      // console.log(index);

      // this.$store.state.todos.todos.splice(index, 1, data);
      // console.log("fjjf")
    },
    cancelEdit() {
      this.title = this.beforeEditCache;
      this.editing = false;
    },
    // pluralize() {
    //   eventBus.$emit('pluralize')
    // },
    // handlePluralize() {
    //   this.title = this.title + 's'
    //   const data = {
    //     id: this.id,
    //     title: this.title,
    //     completed: this.completed,
    //     editing: this.editing
    //   }
    //   const index = this.$store.state.todos.findIndex(item => item.id === data.id)
    //   this.$store.state.todos.splice(index, 1, data)
    // }
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
  // beforeDestroy(){
  //   eventBus.$off('pluralize', this.handlePluralize)
  // },
  // created(){
  //   eventBus.$on('pluralize', this.handlePluralize)
  // }
};
</script>

<style scoped>
.completed {
  text-decoration: line-through;
}
</style>
