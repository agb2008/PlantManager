<template>
  <div>
    <h2>Calendar</h2>
    <f-calendar id="full_calendar" />
    <lunar-calendar class="lunar_calendar" />
  </div>
</template>

<script>
import FCalendar from "./Fcalendar.vue";
import LunarCalendar from "./LunarCalendar.vue";

export default {
  name: "Calendar",
  components: {
    FCalendar,
    LunarCalendar,
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
      todos,
    };
  },
};
</script>

<style>
#fullcalendar,
.lunar_calendar {
  width: 90%;
}
</style>
