import { getError } from "@/utils/helpers";
import Requests from "../../services/RequestsToServerService";

export const namespaced = true;

export const state = {
    tasksArray: [],    
    loading: false,
    error: null,
};

export const mutations = {
    SET_TASKS(state, array) {
        state.tasksArray = array;
    },
    ADD_TO_TASKSARRAY(state, data){
        state.tasksArray.push(data);
    },
    DELETE_DATA_FROM_TASKSARRAY(state, id){
        state.tasksArray = 
            state.tasksArray.filter(el => el.id !== id);
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
        let response = await Requests.getData("/tasks");
        console.log(response);
        commit("SET_TASKS", response.data.data);
        commit("SET_LOADING", false);
        } catch (error) {
        commit("SET_LOADING", false);
        commit("SET_ERROR", getError(error));
        } 
    },
    async addNewDataToTasksArray({ commit }, newData) {
        commit("SET_LOADING", true);
        try {
            let response = await Requests.postData("/tasks", newData)
            console.log(response);
            commit("ADD_TO_TASKSARRAY", newData);
            commit("SET_LOADING", false);
        } catch (error) {
            commit("SET_LOADING", false);
            commit("SET_ERROR", getError(error));
        } 
    },
    async deletingTasksArrayEl({ commit }, id){
        commit("SET_LOADING", true);
        try {
            let response = await Requests.deleteData("/tasks", id)
            console.log(response);
            commit("DELETE_DATA_FROM_TASKSARRAY", id);
            commit("SET_LOADING", false);
        } catch (error) {
            commit("SET_LOADING", false);
            commit("SET_ERROR", getError(error));
        } 
    },
  
};

export const getters = {
    tasksArray: (state) => {
        return state.tasksArray;
    },
    loading: (state) => {
        return state.loading;
    },
    error: (state) => {
        return state.error;
    },
};