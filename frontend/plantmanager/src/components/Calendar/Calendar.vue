<template>
  <div>
    this is calendar
    <v-calendar
      :rows="2"
      :columns="$screens({ default: 1, lg: 2 })"
      :attributes="attributes"
      class="v_calendar"
    />
    <lunar-calendar />
  </div>
</template>

<script>
import VCalendar from "v-calendar/lib/components/calendar.umd";
import LunarCalendar from './LunarCalendar.vue';
// import DatePicker from 'v-calendar/lib/components/date-picker.umd';
// const lune = require("lune");

export default {
  name: "Calendar",
  components: {
    VCalendar,
    LunarCalendar
  },
  data() {
    return {
      attributes: [
        {
            key: "today",
            highlight: true,
            dates: new Date(),
        },
      ],
    };
  },
  // methods: {
  //   getPhase() {
  //     const current_phase = lune.phase();
  //     console.log(current_phase);
  //   },
  //   getPhasesAround() {
  //     const some_date = new Date();
  //     const some_date_phase = lune.phase_hunt(some_date);
  //     console.log(some_date_phase);
  //   },
  // },
  // beforeMount() {
  //   this.getPhase();
  // },
};
</script>

<style>
/* .v_calendar {
  max-width: 50%;
} */
</style>
