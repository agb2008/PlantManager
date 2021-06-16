<template>
  <div>{{ remaining }} items left</div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  name: 'todo-remaining',
  computed: {
    ...mapGetters('todos', ['remaining'])
  }
}
</script>