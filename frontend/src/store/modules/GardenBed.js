import { getError } from "@/utils/helpers";
import GardenBedService from "../../services/GardenBedService";

export const namespaced = true;

export const state = {
    dataCells: [],
    //TEST
    plantTypeList: [
        {
          id: 1,
          name: "помидор",
          familyId: 1,
          speciesId: 1,
          notes: "морковь однолетнее растение",
        },
        {
            id: 2,
            name: "перец",
            familyId: 1,
            speciesId: 3,
            notes: "морковь однолетнее растение",
        },
        {
          id: 3,
          name: "огурец",
          familyId: 2,
          speciesId: 2,
          notes: "свекла mоднолетнее растение",
        },
        {
          id: 4,
          name: "черника",
          familyId: 1,
          speciesId: 4,
          notes: "кукуруза однолетнее растение",
        },
        {
          id: 5,
          name: "томат чери",
          familyId: 2,
          speciesId: 1,
          notes: "огурец mоднолетнее растение",
        },
        {
            id: 0,
            name: "разделение",
            familyId: 1,
            speciesId: 1,
            notes: "огурец mоднолетнее растение",
        },
      ],
      familyList: [
        { id: 1, name: "однолетнее", notes: " однолетнее растение" },
        { id: 2, name: "многолетнее", notes: " mоднолетнее растение" },
      ],
      speciesList: [
        { id: 1, name: "томатовые", notes: "семейство морковные" },
        { id: 2, name: "огуречные", notes: "семейство свекловные" },
        { id: 3, name: "перцевые", notes: "семейство кукурузновые" },
        { id: 4, name: "черниковые", notes: "семейство огурецовые" },
      ],
    ///////////
    loading: false,
    error: null,
};

export const mutations = {
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
    async getAllData({ commit }) {
        commit("SET_LOADING", true);
        try {
        let response = await GardenBedService.getData("/positions");
        console.log(response);
        commit("SET_DATACELLS", response.data.data);
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