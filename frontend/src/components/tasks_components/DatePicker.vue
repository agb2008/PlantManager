<template>
    <v-date-picker v-model="date" :min-date="new Date()">
          <template v-slot="{ inputValue, inputEvents }">
            <input
            class="outline-clear bg-white px-2 py-1 border-2 rounded hover:border-green-400"
            :value="inputValue"
            v-on="inputEvents"
            />
        </template>
    </v-date-picker>
</template>

<script>
export default {
    name: 'DatePicker',
    props:{

    },
    data(){
        return {
            date: new Date(),
        }
    },

    watch: {
        date: function (val) {
            this.$emit("setDate", val)
        }
    },

}
</script>

<style scoped>
    .outline-clear{
       outline: none;
   }
</style>
