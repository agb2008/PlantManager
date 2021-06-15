<script>
import "@fullcalendar/core/vdom"; // solves problem with Vite
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import ruLocale from "@fullcalendar/core/locales/ru";

export default {
  components: {
    FullCalendar, // make the <FullCalendar> tag available
  },
  data() {
    return {
      calendarOptions: {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: "dayGridMonth",
        selectable: true,
        dateClick: this.handleDateClick,
        events: [
          { title: "event 1", date: "2021-06-01" },
          { title: "event 2", date: "2021-06-02" },
        ],
        locale: ruLocale,
        customButtons: {
          myCustomButton: {
            text: "custom!",
            click: this.addNewEvent,
          },
        },
        headerToolbar: {
          left: "today myCustomButton",
          center: "title",
          right: "prev,next dayGridMonth",
        },
      },
    };
  },
  methods: {
    addNewEvent() {
      let newEventTitle = prompt("add new event");
      let newEvent = { title: newEventTitle, date: new Date().toISOString() };
      this.calendarOptions.events = [...this.calendarOptions.events, newEvent];
    },
  },
};
</script>
<template>
  <div>
    <button @click="addNewEvent">Add event</button>
    <FullCalendar :options="calendarOptions" id="fullcalendar" />
  </div>
</template>

<style>
#fullcalendar {
  width: 80%;
}
</style>
