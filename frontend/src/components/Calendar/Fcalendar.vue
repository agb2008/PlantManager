// Календарь: https://fullcalendar.io/

<template>
  <div id="full_calendar">
    <form action="" v-on:submit="addNewEvent" class="eventForm">
      <input type="date" name="event_date" v-model="newEventDate" />
      <input type="text" name="event_title" v-model="newEventTitle" />
      <button class="eventBtn">Добавить событие</button>
    </form>

    <FullCalendar :options="calendarOptions" id="fullcalendar" />
  </div>
</template>

<script>
import "@fullcalendar/core/vdom"; // solves problem with Vite
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import ruLocale from "@fullcalendar/core/locales/ru";

export default {
  components: {
    FullCalendar,
  },
  data() {
    return {
      newEventDate: "",
      newEventTitle: "",
      calendarOptions: {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: "dayGridMonth",
        selectable: true,
        editable: true,
        dateClick: this.handleDateClick,
        events: [
          { title: "event 1", start: "2021-06-01" },
          { title: "event 2", start: "2021-06-02" },
        ],
        locale: ruLocale,
        // customButtons: {
        //   myCustomButton: {
        //     text: "Добавить событие",
        //     click: this.addNewEvent,
        //   },
        // },
        headerToolbar: {
          // left: "today myCustomButton",
          left: "today",
          center: "title",
          right: "prev,next dayGridMonth",
        },
      },
    };
  },
  methods: {
    addNewEvent(event) {
      event.preventDefault();
      let newEvent = { title: this.newEventTitle, start: this.newEventDate };
      this.calendarOptions.events = [...this.calendarOptions.events, newEvent];
    },
  },
};
</script>

<style>
#fullcalendar {
  width: 90%;
  margin: 0 auto;
}
.eventForm {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-evenly;
}

.eventBtn {
  color: #fff;
  background-color: #2c3e50;
  border-color: #2c3e50;
  border: 1px solid transparent;
  padding: 0.4em 0.65em;
  margin: 0.5em 0;
  font-size: 1em;
  line-height: 1.5;
  border-radius: 0.25em;
}
.eventBtn:active,
.eventBtn:focus,
.eventBtn:hover {
  background-color: #1a252f;
}
</style>
