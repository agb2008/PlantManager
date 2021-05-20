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
                    <div class="btn-increase increase-columns" v-on:click="increaseCells('col')">
                        <p class="btn-increase-text">Increase columns</p>
                    </div>
                    <div class="btn-increase increase-rows" v-on:click="increaseCells('rows')">
                        <p class="btn-increase-text">Increase rows</p>
                    </div>
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
            quantityRows: 5,
            quantityColumns: 5,
            choseDoing: null,
            previousChoseDoing: null,
            userGarden: []
        }
    },
    props: {
    
    },
    methods: {
        markCell(event){
            let userPlants = {}
            if(this.choseDoing === null) return;
            
            for(let el of this.doingsArray){
                if(el.name === this.choseDoing){
                    event.target.style.background = el.colour;
                    userPlants.id = event.target.id;
                    userPlants.name = el.name;
                    userPlants.colour = el.colour
                }
            }

            this.userGarden.push(userPlants)

            for (let i = this.userGarden.length; i--;) {
                if (this.userGarden[i].colour  === "none") {
                    this.userGarden.splice(i, 1);
                }
            }


            console.log(this.userGarden)
        },

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

        increaseCells(direction){
            let el = document.querySelector(".garden-bed-table")
            if(direction === "rows"){
                el.style.height = el.clientHeight + 1 + "px";
                this.quantityRows += 1;
            }
            else{
                el.style.width = el.clientWidth + 1 + "px";
                this.quantityColumns += 1;
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

    .main{
        margin-bottom: 83px;
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
        position: relative;
        margin: 0 auto;
        width: 900px;
        min-width: 900px;
    }

    .btn-increase{
        cursor: pointer;
        position: absolute;
        font-size: 15px;
        color: #fff;
        background: rgb(165, 164, 164);
        border: 2px solid rgb(150, 149, 149);
        border-radius: 3px;
    }

    .btn-increase:hover{
        background: rgb(165, 164, 164);
        border: 2px solid rgb(81, 82, 81);
        color: rgb(105, 105, 105);
        box-shadow: none;
    }

    .btn-increase:active{
        box-shadow: 0px 5px 10px 2px rgba(34, 60, 80, 0.25) inset;
        color: rgb(82, 82, 82);
        border: 2px solid rgb(81, 82, 81);
    }

    .increase-columns{
        top: 44%;
        left: 100%;
        writing-mode: vertical-lr;
        margin-left: 10px;
        padding: 6px 5px;
        box-shadow: -6px -6px 5px -6px rgba(34, 60, 80, 0.5);
    }

    .increase-rows{
        top: 100%;
        left: 46%;
        margin-top: 10px;
        padding: 5px 6px;
        box-shadow: -5px -5px 5px -5px rgba(34, 60, 80, 0.6);
    }

    .increase-rows::after{
        content: "";
        position: absolute;
        top: 34px;
        left: 37px;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 9px 15px 0 15px;
        border-color: rgb(150, 149, 149) transparent transparent transparent;
    }

    .increase-rows:hover::after{
        border-color: rgb(81, 82, 81) transparent transparent transparent;
    }

    .increase-columns::after{
        content: "";
        position: absolute;
        top: 50px;
        left: 35px;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 15px 0 15px 9px;
        border-color: transparent transparent transparent rgb(150, 149, 149);
    }

    .increase-columns:hover::after{
        border-color: transparent transparent transparent rgb(81, 82, 81);
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