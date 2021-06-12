<template>
  <div class="my-container">
      <div class="form-wrapper">
            <form @submit.prevent="createTask" class="flex flex-col items-center">
                <DatePicker @setDate="setDate" ref="date" class="mb-4 mt-4"/>
                <input class="input-shadow padding-input width-input outline-clear mb-4 text-md border-2 border-gray-400 focus:border-green-500 focus:shadow-none" 
                name="title" type="text" v-model="title">
                <textarea class="outline-clear padding-input width-input shadow-md mb-5 text-md textarea border-2 rounded-md border-gray-500 focus:border-green-400 focus:shadow-none" 
                name="desc" v-model="desc"></textarea>
                <button type="submit" v-bind:disabled="isDisabled" class="button outline-clear text-white shadow-md bg-gray-400 border-2 rounded-lg border-gray-500  hover:bg-white hover:border-green-400 hover:text-gray-400" 
                v-bind:class="{'btn-disabled': isDisabled}">Создать</button>
            </form>
      </div>
  </div>
</template>

<script>
import DatePicker from './DatePicker'
export default {
    name: 'GardenBed',
    components: {
        DatePicker
    },
    data(){
        return {
            objectTasks: new Set(),
            title: "",
            desc: "",
            date: ""
        }
    },

    methods: {
        createTask(){
            this.objectTasks.add({
                id: this.objectTasks.size,
                title: this.title,
                desc: this.desc,
                comolete: false, 
                date: this.date
            })
            this.title = "";
            this.desc = "";
            this.$refs.date.date = new Date();
        },

        // Перенести в компонент ОДНОЙ задачи

        removeTask(task){
            this.objectTasks.delete(task);
        },

        isTaskCompleted(task){
            task.comolete = !task.comolete;
        },

        //////////////

        setDate(date){
            this.date = date;
        }
    },

    computed: {
        isDisabled(){
            return this.title ? false : "disabled";
        }
    }
}
</script>

<style scoped>
   .textarea{
       resize: none;
       min-height: 200px;
       --tw-ring-shadow: none;
   }

   .outline-clear{
       outline: none;
   }

   .width-input{
       min-width: 350px;
   }

   .padding-input{
       padding: 6px 8px;
   }

   .button{
       padding: 8px 11px;
   }

   .input-shadow{
       box-shadow: 0px 5px 5px -5px rgba(18, 21, 22, 0.6);
   }

   .button:active{
       background-color: rgb(243, 244, 246);
       box-shadow: none;
   }

   .btn-disabled{
       opacity: 0.5;
       cursor: not-allowed;
   }

</style>