import { getError } from "@/utils/helpers";
import GardenBedService from "../../services/RequestsToServerService";

export const namespaced = true;

export const state = {
    isDataGotten: false,
    dataCells: [],
    //TEST
    plantTypeList: [
        {
          id: 1,
          name: "помидор",
          family_id: 1,
          species_id: 1,
          notes: "морковь однолетнее растение",
        },
        {
            id: 2,
            name: "перец",
            family_id: 1,
            species_id: 3,
            notes: "морковь однолетнее растение",
        },
        {
          id: 3,
          name: "огурец",
          family_id: 2,
          species_id: 2,
          notes: "свекла mоднолетнее растение",
        },
        {
          id: 4,
          name: "черника",
          family_id: 1,
          species_id: 4,
          notes: "кукуруза однолетнее растение",
        },
        {
          id: 5,
          name: "томат чери",
          family_id: 2,
          species_id: 1,
          notes: "огурец mоднолетнее растение",
        },
        {
            id: 6,
            name: "разделение",
            family_id: 1,
            species_id: 1,
            notes: "огурец mоднолетнее растение",
        },
      ],
      familyList: [
        { name: "однолетнее", description: " однолетнее растение" },
        { name: "многолетнее", description: " mоднолетнее растение" },
      ],
      speciesList: [
        {  name: "томатовые", description: "семейство морковные" },
        {  name: "огуречные", description: "семейство свекловные" },
        {  name: "перцевые", description: "семейство кукурузновые" },
        {  name: "черниковые", description: "семейство огурецовые" },
      ],
    ///////////
    loading: false,
    error: null,
};

export const mutations = {
    SET_DATA_IS_GOTTEN(state) {
        state.isDataGotten = true;
    },
    SET_PLANTTYPE_LIST(state, plantTypeList) {
        state.plantTypeList = plantTypeList;
    },
    SET_FAMILY_LIST(state, familyList) {
        state.familyList = familyList;
    },
    SET_SPECIES_LIST(state, speciesList) {
        state.speciesList = speciesList;
    },
    SET_DATACELLS(state, array) {
        state.dataCells = array;
    },
    ADD_TO_DATACELLS(state, data){
        state.dataCells.push(data);
    },
    DELETE_DATA_FROM_DATACELLS(state, id){
        state.dataCells = 
            state.dataCells.filter(el => el.id !== id);
    },
    SET_LOADING(state, loading) {
        state.loading = loading;
    },
    SET_ERROR(state, error) {
        state.error = error;
    },
};

export const actions = {
    //TEST
    // async setPrimaryData({ commit }){
    //     let response = null;
    //     for(let i = 0; i < state.speciesList.length; i++){
    //         response = await GardenBedService.postData("/species", state.speciesList[i]);
    //     }
    //     commit("SET_SPECIES_LIST", response.data.data);

    //     for(let i = 0; i < state.familyList.length; i++){
    //         response = await GardenBedService.postData("/family", state.familyList[i]);
    //     }
    //     commit("SET_FAMILY_LIST", response.data.data);

    //     for(let i = 0; i < state.plantTypeList.length; i++){
    //         response = await GardenBedService.postData("/plant_type", state.plantTypeList[i]);
    //     }
    //     commit("SET_PLANTTYPE_LIST", response.data.data);
    // },
    async getAllData({ commit }) {
        commit("SET_LOADING", true);
        try {
            let response = await GardenBedService.getData("/positions");
            console.log(response);
            commit("SET_DATACELLS", response.data.data);
            commit("SET_DATA_IS_GOTTEN");
            response = await GardenBedService.getData("/plant_type");
            commit("SET_PLANTTYPE_LIST", response.data.data);
            response = await GardenBedService.getData("/family");
            commit("SET_FAMILY_LIST", response.data.data);
            response = await GardenBedService.getData("/species");
            commit("SET_SPECIES_LIST", response.data.data);
            commit("SET_LOADING", false);
        } catch (error) {
            commit("SET_LOADING", false);
            commit("SET_ERROR", getError(error));
        } 
    },
    async addNewDataToDataCells({ commit }, newDataCell) {
        commit("SET_LOADING", true);
        try {
            let response = await GardenBedService.postData("/positions", newDataCell)
            console.log(response);
            commit("ADD_TO_DATACELLS", newDataCell);
            commit("SET_LOADING", false);
        } catch (error) {
            commit("SET_LOADING", false);
            commit("SET_ERROR", getError(error));
        } 
    },
    async deletingDataCellsEl({ commit }, id){
        commit("SET_LOADING", true);
        try {
            let response = await GardenBedService.deleteData("/positions", id)
            console.log(response);
            commit("DELETE_DATA_FROM_DATACELLS", id);
            commit("SET_LOADING", false);
        } catch (error) {
            commit("SET_LOADING", false);
            commit("SET_ERROR", getError(error));
        } 
    },
  
};

export const getters = {
    isDataGotten: (state) => {
        return state.isDataGotten
    },
    dataCells: (state) => {
        return state.dataCells;
    },
    plantTypeList: (state) => {
        return state.plantTypeList;
    },
    familyList: (state) => {
        return state.familyList;
    },
    speciesList: (state) => {
        return state.speciesList;
    },
    loading: (state) => {
        return state.loading;
    },
    error: (state) => {
        return state.error;
    },
};