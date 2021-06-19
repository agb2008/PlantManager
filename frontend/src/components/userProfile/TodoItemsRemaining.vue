<template>
  <div>Отдыхать некогда! {{ remaining }} ещё осталось выполнить</div>
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