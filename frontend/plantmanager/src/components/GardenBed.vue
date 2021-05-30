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
                <div class="garden-bed-table flex flex-col">
                    <div class="tabel-row flex" v-for="r of quantityRows" :key="r">
                        <div class="table-cell" v-for="c of quantityColumns" :style="getBackground(r + '/' + c)"
                        :key="c" :id="r + '/' + c" v-on:click="markCell"></div>
                    </div>
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
                {
                    name: "tomato", 
                    img: "./images/44_tomato_food-tomato.svg", 
                },
                {
                    name: "bell_pepper", 
                    img: "./images/30_bell_pepper.svg", 
                },
                {
                    name: "cucumber", 
                    img: "./images/8_cucumber-slice-publicdomainvectors.org.svg", 
                },
                {
                    name: "chery_tomat", 
                    img: "./images/173_cherryTomato-branch-publicdomainvectors.org.svg", 
                },
                {
                    name: "blackberry", 
                    img: "./images/221_blackberry.svg", 
                },
                {
                    name: "deviding", 
                    img: "./images/deviding.jpg", 
                    background: "#5a5a5a", 
                },
                {
                    name: "clean", 
                    img: "./images/kisclean.jpg", 
                    background: "none", 
                }
            ],
            dataCellsSet: new Set(),
            quantityRows: 20,
            quantityColumns: 30,
            choseDoing: null,
            previousChoseDoing: null,
            gardenBedTable: null
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
            if(this.choseDoing === null) return;

            for(let el of this.doingsArray){
                if(el.name === this.choseDoing && this.isCellClear(event.target.style.background)){
                    event.target.style.background = el.background ? el.background :
                        `center / contain no-repeat url(${el.img})`;

                    this.addCellInfoToSet(event, el);
                    return;
                } else if(this.choseDoing === "clean"){
                    this.removeCellInfoFromSet(event);
                    event.target.style.background = "none";
                    return;
                }
            }
        },

        addCellInfoToSet(e, doing){
            if(!this.dataCellsSetHasId(e.target.id)){
                let obj = {};
                obj.coordinate = e.target.id;
                obj.name = doing.name;
                obj.background = doing.background ? doing.background : doing.img;
                //возможно потом добавятся другие поля
                this.dataCellsSet.add(obj);
            }
            console.log(this.dataCellsSet);
        },

        removeCellInfoFromSet(e){
            for(let el of this.dataCellsSet){
                if(el.coordinate === e.target.id){
                    this.dataCellsSet.delete(el);
                }
            }
            console.log(this.dataCellsSet);
        },

        isCellClear(targetBackground){
            if(targetBackground === "" || targetBackground === "none"){
                return true;
            }
            return false;
        },

        dataCellsSetHasId(id){
            let existenceId = 0;
            for(let el of this.dataCellsSet){
                if(el.coordinate === id) existenceId = 1;
            }
            return existenceId;
        },

        increaseCells(direction){
            if(direction === "rows"){
                this.quantityRows += 5;
                this.gardenBedTable.style.height = this.gardenBedTable.clientHeight + 150 + "px";
            }
            else{
                this.quantityColumns += 5;
                this.gardenBedTable.style.width = this.gardenBedTable.clientWidth + 150 + "px";
            }
        },

        getBackground(id){
            let el = Array.from(this.dataCellsSet).filter(el => el.coordinate === id)
            if(el){
                return `background: center / contain no-repeat ${el.background}`;
            }
        }
    },

    mounted(){
        this.gardenBedTable = document.querySelector(".garden-bed-table");
    }

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
        width: 40px;
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
        top: 42%;
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
        left: 34px;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 15px 0 15px 10px;
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