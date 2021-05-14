<template>
    <div>
        this is calendar
        <VCalendar />
        <DatePicker />
    </div>
</template>

<script>
import VCalendar from 'v-calendar/lib/components/calendar.umd';
import DatePicker from 'v-calendar/lib/components/date-picker.umd';

    export default {
        name: "Calendar",
        components: {
            VCalendar,
            DatePicker
        }
    }
</script>

<style lang="scss" scoped>

</style>