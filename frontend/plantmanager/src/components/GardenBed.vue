<template>
    <div class="my-container flex">
        <div class="side-panel">
            Какая-то панель
        </div>
        <div class="wrapper-for-header-and-main flex-grow">
            <header class="header text-center">
                Header
            </header>
            <main class="main">
                <div class="garden-bed-panel">
                    <div class="icon-doing" v-for="(item, k) of doingsArray" :key="k" v-on:click="chooseIconDoing(item.name, $event)">
                        <img :src="item.img" alt="" class="icon-img">
                    </div>
                </div>
                <div class="garden-bed-table flex flex-wrap">
                    <div class="table-cell" v-for="item of (quantityRows * quantityColumns)" :key="item" v-on:click="markCell"></div>
                </div>
            </main>
        </div>
    </div>
</template>

<script>
export default {
    name: 'GardenBed',
    data(){
        return {
            doingsArray: [
                {name: "tomato", img: "./images/tamato.jpg", colour: "rgb(240, 6, 6)"},
                {name: "potato", img: "./images/potato.jpg", colour: "#9d6b39"},
                {name: "deviding", img: "./images/deviding.jpg", colour: "#5a5a5a"},
                {name: "clean", img: "./images/kisclean.jpg", colour: "none"}
            ],
            quantityRows: 20,
            quantityColumns: 30,
            choseDoing: null,
            previousChoseDoing: null
        }
    },
    props: {
    
    },
    methods: {
        chooseIconDoing(iconName, event){
            if(iconName !== this.choseDoing){
                this.choseDoing = iconName;
                if(this.previousChoseDoing !== null 
                && this.previousChoseDoing.classList.contains("chose-icon")){
                    this.previousChoseDoing.classList.remove("chose-icon")
                }
                this.previousChoseDoing = event.target
                event.target.classList.add("chose-icon");
            } else{
                this.choseDoing = null;
                event.target.classList.remove("chose-icon");
                this.previousChoseDoing = null;
            }
            
        },
        markCell(event){
            for(let el of this.doingsArray){
                if(el.name === this.choseDoing){
                    event.target.style.background = el.colour;
                }
            }
        }
    },

}
</script>

<style scoped>
    .side-panel{
        writing-mode: vertical-rl;
        min-height: 100vh;
        text-align: center;
    }

    .garden-bed-panel{
        display: flex;
        justify-content: center;
        margin: 20px 0 35px 0;
    }

    .icon-doing{
        cursor: pointer;
        margin-right: 10px;
    }

    .icon-img{
        border: 2px solid #000;
        max-width: 40px;
        height: 40px;
        max-height: 40px;
        border-radius: 50%;
        box-shadow: 4px 4px 8px 0px rgba(34, 60, 80, 0.35);
    }

    .icon-doing:hover > .icon-img{
        border-color: rgb(62, 201, 83);
    }

    .chose-icon{
        border: 3px solid rgb(62, 201, 83);
        box-shadow: none;
    }

    .garden-bed-table{
        margin: 0 auto;
        height: 600px;
        width: 900px;
        max-height: 600px;
        max-width: 900px;
        border-collapse: collapse;
    }

    .table-cell{
        cursor: pointer;
        border: 1px solid black;
        width: 30px;
        height: 30px;
        max-width: 30px;
        max-height: 30px;
        box-sizing: border-box;
    }

    .table-cell:hover{
        box-shadow: 0px 5px 10px 2px rgba(34, 60, 80, 0.2);
        border: 3px solid rgb(62, 201, 83);
    }

</style>