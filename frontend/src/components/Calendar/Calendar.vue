<template>
  <div>
    <h2>Calendar</h2>
    <v-calendar
      :rows="2"
      :columns="$screens({ default: 1, lg: 2 })"
      :attributes="attributes"
      class="v_calendar"
      is-double-paned
      @click="chooseDay"
    >
      <!-- <popover-row
        v-for="attr in attributes"
        :key="attr.key"
        :attribute="attr">
        {{checkTodo}}
        {{attr.customData}}
      </popover-row> -->
    </v-calendar>
    <!-- <test /> -->
    <ul v-show="dayClicked" class="todos">
      <li v-for="todo in todos" :key="todo.id" :attribute="todo">
        {{ todo.description }}
      </li>
    </ul>
    <lunar-calendar />
  </div>
</template>

<script>
import VCalendar from "v-calendar/lib/components/calendar.umd";
// import PopoverRow from 'v-calendar/lib/components/popover-row.umd.min';
import LunarCalendar from "./LunarCalendar.vue";
// import Test from "./Test.vue";
// import { BIcon } from "bootstrap-vue";
// import DatePicker from 'v-calendar/lib/components/date-picker.umd';

export default {
  name: "Calendar",
  components: {
    VCalendar,
    LunarCalendar,
    // PopoverRow,
    // BIcon,
    // Test,
  },
  data() {
    const todos = [
      {
        id: Math.random() * 10,
        description: "Take Noah to basketball practice.",
        isComplete: false,
        dates: { weekdays: 6 }, // Every Friday
        color: "red",
      },
    ];
    return {
      // attributes: [
      //   {
      //       key: "today",
      //       highlight: true,
      //       dates: new Date(),
      //   },
      // ],
      todos,
      dayClicked: true,
      // incId: todos.length,
      // editId: 0,
    };
  },
  computed: {
    attributes() {
      return [
        // Attributes for todos
        // ...this.todos.map(todo => ({
        //   dates: todo.dates,
        //   dot: {
        //     color: todo.color,
        //     class: todo.isComplete ? 'opacity-75' : '',
        //   },
        //   popover: {
        //     label: todo.description,
        //     isInteractive: true,
        //   },
        //   customData: todo,
        // })),
        // checkTodo,

        // Todo attributes
        ...this.todos.map((todo) => ({
          key: todo.id,
          dates: todo.dates,
          customData: todo,
          order: todo.id,
          dot: {
            backgroundColor: todo.color,
            opacity: todo.isComplete ? 0.3 : 1,
          },
          popover: {
            slot: "todo-row", // Matches slot from above
            visibility: "focus",
          },
        })),
        {
          contentHoverStyle: {
            backgroundColor: "rgba(0, 0, 0, 0.1)",
            cursor: "pointer",
          },
          dates: {}, // All dates
          popover: {
            slot: "add-todo",
            visibility: "focus",
            hideIndicator: true,
          },
        },
      ];
    },
  },
  methods: {
    chooseDay(event) {
      console.log(event.target);
    },
  },
  directives: {
    focusSelect: {
      inserted(el) {
        el.focus();
        el.select();
      },
    },
  },
};
</script>

<style>
/* .popover-header {
  text-align: center;
  padding-bottom: 3px;
  border-bottom: 1px solid #dadada;
  margin: 0 0 3px 0;
  opacity: 0.7;
} */

/* .todos {
  position: fixed;
  top: 0;
  left: 0;
  z-index: 10;
} */

.todo-row {
  display: flex;
  flex-wrap: none;
  width: 100%;
}

/* .todo-content {
  flex-grow: 1;
  flex-basis: 0;
  margin-right: 10px;
  min-width: 80px;
} */

/* .todo-input {
  width: 100%;
  min-width: 200px;
} */
/* 
.todo-description {
  cursor: pointer;
  transition: all 0.1s ease-in-out;
  margin-left: 3px;
}

.todo-description:hover {
  opacity: 0.5;
}

.todo-description.complete {
  text-decoration: line-through;
} */

.add-todo {
  font-size: 0.8rem;
  text-align: center;
  width: 100%;
}

/* .delete-todo {
  margin-left: 3px;
} */
</style>
