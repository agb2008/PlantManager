<template>
    <div class="my-container">
        <main class="main">
            <div class="garden-bed-panel">
                <div class="icon-doing" v-for="(item, k) of doingsArray" :key="k" v-on:click="chooseIconDoing(item, $event)">
                    <img :src="item.img" alt="" class="icon-img">
                </div>
            </div>
            <div class="error" v-if="error">{{ error }}</div>
            <div class="garden-bed-table flex flex-col">
                <div class="tabel-row flex" v-for="r of quantityRows" :key="r">
                    <div class="table-cell" v-for="c of quantityColumns" :style="getBackground(r + '' + c)"
                    :key="c" :id="r + '/' + c" :data-id="r + '' + c" v-on:click="markCell"></div>
                </div>
                <div class="btn-increase increase-columns" v-on:click="increaseCells('col')">
                    <p class="btn-increase-text">Добавить колонны</p>
                </div>
                <div class="btn-increase increase-rows" v-on:click="increaseCells('rows')">
                    <p class="btn-increase-text">Добавить строки</p>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import { mapActions } from "vuex";

export default {
    name: 'GardenBed',
    data(){
        return {
            plantId: null,
            choseDoing: null,
            previousChoseDoing: null,
            gardenBedTable: null,
            quantityRows: this.rows,
            quantityColumns: this.columns,
        }
    },
    props: {
        doingsArray: Array,
        rows: Number,
        columns: Number,
    },
    methods: {
        ...mapActions("gardenbed", [
            "addNewDataToDataCells",
            "deletingDataCellsEl",
        ]),

        chooseIconDoing(icon, event){
            if(icon.id !== this.choseDoing){
                this.choseDoing = icon.id;
                if(this.previousChoseDoing !== null 
                && this.previousChoseDoing.classList.contains("chose-icon")){
                    this.previousChoseDoing.classList.remove("chose-icon")
                }
                this.previousChoseDoing = event.target;
                this.plantId = icon.plantId;
                event.target.classList.add("chose-icon");
            } else{
                this.choseDoing = null;
                this.plantId = null;
                event.target.classList.remove("chose-icon");
                this.previousChoseDoing = null;
            }
            
        },

        markCell(event){
            if(this.choseDoing === null) return;

            for(let el of this.doingsArray){
                if(el.id === this.choseDoing && this.isCellClear(event.target.style.background)){
                    event.target.style.background = el.background ? el.background :
                        `center / contain no-repeat url(${el.img})`;

                    this.addCellInfoToArr(event);
                    return;
                } else {
                    this.removeCellInfoFromArr(event);
                    event.target.style.background = "none";
                    return;
                }
            }
        },

        addCellInfoToArr(e){
            let arrCoordinate = e.target.id.split("/")
            if(!this.dataCellsHasId(e.target.id)){
                this.addNewDataToDataCells({
                    id: e.target.dataset.id,
                    posX: arrCoordinate[1],
                    posY: arrCoordinate[0],
                    img_id: 1,// NEED TO CHANGE
                    plant_id: this.plantId,
                    user_id: 1,// NEED TO CHANGE
                })
                //возможно потом добавятся другие поля
            }
            console.log(this.dataCells, this.user);
        },

        removeCellInfoFromArr(e){
            for(let el of this.dataCells){
                if(el.id === e.target.dataset.id){
                    this.deletingDataCellsEl(e.target.dataset.id);
                }
            }
            console.log(this.dataCells);
        },

        isCellClear(targetBackground){
            if(targetBackground === "" || targetBackground === "none"){
                return true;
            }
            return false;
        },

        dataCellsHasId(id){
            let existenceId = 0;
            for(let el of this.dataCells){
                if(el.id === id) existenceId = 1;
            }
            return existenceId;
        },

        increaseCells(direction){
            console.log(true, direction)
            //На будущее
            // if(direction === "rows"){
            //     this.quantityRows += 5;
            //     this.gardenBedTable.style.height = this.gardenBedTable.clientHeight + 150 + "px";
            // }
            // else{
            //     this.quantityColumns += 5;
            //     this.gardenBedTable.style.width = this.gardenBedTable.clientWidth + 150 + "px";
            // }
        },

        getBackground(id){
            let el = this.dataCells.filter(el => el.id === id)[0]
            if(el){
                for(let doing of this.doingsArray){
                    if(doing.plantId === el.plant_id){
                        return doing.background ? doing.background :
                                `center / contain no-repeat url(${doing.img})`;
                    }
                }
            }
        }
    },

    computed:{
        ...mapGetters("gardenbed", [
            "dataCells",
            "plantTypeList",
            "familyList",
            "speciesList",
            "loading",
            "error",
        ]),

        ...mapGetters("auth", [
            "authUser",
        ]),
    },

    mounted(){
        this.$store.dispatch("gardenbed/getAllData");
        // this.$store.dispatch("auth/getAuthUser");
        this.gardenBedTable = document.querySelector(".garden-bed-table");
    }

}
</script>

<style scoped>
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
        top: 39%;
        left: 100%;
        writing-mode: vertical-lr;
        margin-left: 10px;
        padding: 6px 5px;
        box-shadow: -6px -6px 5px -6px rgba(34, 60, 80, 0.5);
    }

    .increase-rows{
        top: 100%;
        left: 44%;
        margin-top: 10px;
        padding: 5px 6px;
        box-shadow: -5px -5px 5px -5px rgba(34, 60, 80, 0.6);
    }

    .increase-rows::after{
        content: "";
        position: absolute;
        top: 34px;
        left: 53px;
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
        top: 60px;
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