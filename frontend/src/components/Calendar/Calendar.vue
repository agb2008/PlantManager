<template>
  <div>
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
    return {};
  },
};
</script>

<style>
#fullcalendar,
.lunar_calendar {
  width: 90%;
}
</style>
