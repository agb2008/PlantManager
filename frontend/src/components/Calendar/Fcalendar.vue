// О календаре: https://fullcalendar.io/docs/Calendar-addEvent

<template>
  <div>
    <form action="" v-on:submit="addNewEvent">
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
    FullCalendar, // make the <FullCalendar> tag available
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
          left: "today myCustomButton",
          center: "title",
          right: "prev,next dayGridMonth",
        },
      },
    };
  },
  methods: {
    addNewEvent(event) {
      // let eventDate = prompt("Введите дату в YYYY-MM-DD формате");
      // if (!eventDate) {
      //   alert("Вы ввели некорректную дату, попробуйте ещё раз");
      // }

      // let newEventTitle = prompt("Добавьте новую задачу");
      // if (!newEventTitle) {
      //   alert("Вы не ввели задачу, попробуйте ещё раз");
      // }
      event.preventDefault();
      let newEvent = { title: this.newEventTitle, start: this.newEventDate };
      this.calendarOptions.events = [...this.calendarOptions.events, newEvent];
    },
    addEvStand() {
      let dateStr = prompt("Enter a date in YYYY-MM-DD format");
      let date = new Date(dateStr + "T00:00:00"); // will be in local time

      if (!isNaN(date.valueOf())) {
        // valid?
        FullCalendar.addEvent({
          title: "dynamic event",
          start: date,
          allDay: true,
        });
        alert("Great. Now, update your database...");
      } else {
        alert("Invalid date.");
      }
    },
  },
};
</script>

<style>
#fullcalendar {
  width: 80%;
}

.eventBtn {
  color: #fff;
  background-color: #2c3e50;
  border-color: #2c3e50;
  border: 1px solid transparent;
  padding: 0.4em 0.65em;
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
