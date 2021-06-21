<template>
  <div>
    <label for="">
      <input type="checkbox" :checked="!anyRemaining" @change="allChecked" />
      Отметить все задачи
    </label>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
  name: "todo-check-all",
  computed: {
    ...mapGetters("todos", ["anyRemaining"]),
  },
  methods: {
    ...mapActions("todos", ["allChecked"]),
  },
};
</script>
