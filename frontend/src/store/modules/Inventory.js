import { getError } from "@/utils/helpers";
import InventoryService from "../../services/InventoryService";
import * as API from "@/services/API";

export const namespaced = true;

const storeApis = {
  SET_SEEDS_LIST: "/seeds",
  SET_SEEDLINGS_LIST: "/seedling",
  SET_PLANTTYPE_LIST: "/plant_type",
  SET_FAMILY_LIST: "/family",
  SET_SPECIES_LIST: "/species",
  SET_MANUFACTURER_LIST: "/manufacturer",
};

export const state = {
  seedsList: [],
  seedlingsList: [],
  plantTypeList: [],
  familyList: [],
  speciesList: [],
  manufacturerList: [],
  selectedPlantOfSeeds: null,
  selectedPlantOfSeedlings: null,
  selectedSeedPack: null,
  selectedSeedlingItem: null,
  loading: false,
  error: null,
};

export const mutations = {
  SET_SEEDS_LIST(state, seedsList) {
    state.seedsList = seedsList;
  },
  SET_SEEDLINGS_LIST(state, seedlingsList) {
    state.seedlingsList = seedlingsList;
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
  SET_MANUFACTURER_LIST(state, manufacturerList) {
    state.manufacturerList = manufacturerList;
  },
  ADD_NEW_SEED_PACK(state, seedPack) {
    state.seedsList.push(seedPack);
  },
  DELETE_SEED_PACK(state, seedPackId) {
    const seedPackInd = state.seedsList.findIndex(
      (item) => item.id === seedPackId
    );
    state.seedsList.splice(seedPackInd, 1);
  },
  CHANGE_SEED_PACK_AMOUNT(state, payload) {
    state.seedsList.find(
      (item) => item.id === payload.id
    ).amount = +payload.newAmount;
  },

  ADD_NEW_SEEDLING(state, newSeedling) {
    state.seedlingsList.push(newSeedling);
  },
  DELETE_SEEDLING(state, seedlingId) {
    const seedlingInd = state.seedlingsList.findIndex(
      (item) => item.id === seedlingId
    );
    state.seedlingsList.splice(seedlingInd, 1);
  },
  CHANGE_SEEDLING_AMOUNT(state, payload) {
    state.seedlingsList.find(
      (item) => item.id === payload.id
    ).amount = +payload.newAmount;
  },

  SET_SELECTED_PLANT_SEEDS(state, newState) {
    state.selectedPlantOfSeeds = newState;
  },
  SET_SELECTED_PLANT_SEEDLINGS(state, newState) {
    state.selectedPlantOfSeedlings = newState;
  },
  SET_SELECTED_SEED_PACK(state, newState) {
    state.selectedSeedPack = newState;
  },
  SET_SELECTED_SEEDLING_ITEM(state, newState) {
    state.selectedSeedlingItem = newState;
  },

  SET_META(state, meta) {
    state.meta = meta;
  },
  SET_LINKS(state, links) {
    state.links = links;
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
    for (const item of Object.entries(storeApis)) {
      commit("SET_LOADING", true);
      try {
        const response = await InventoryService.getData(item[1]);
        commit(item[0], response.data.data);
        commit("SET_LOADING", false);
      } catch (error) {
        commit("SET_LOADING", false);
        commit("SET_ERROR", getError(error));
      }
    }
  },
  async getSeedsList({ commit }) {
    commit("SET_LOADING", true);
    try {
      const response = await InventoryService.getData("/seeds");
      commit("SET_SEEDS_LIST", response.data.data);
      commit("SET_LOADING", false);
      return response.data.data;
    } catch (error) {
      commit("SET_LOADING", false);
      commit("SET_ERROR", getError(error));
    }
  },
  async getseedlingsList({ commit }, userId) {
    commit("SET_LOADING", true);
    try {
      const response = await InventoryService.getseedlingsList(userId);
      commit("SET_SEEDLINGS_LIST", response.data.data);
      commit("SET_LOADING", false);
      return response.data.data;
    } catch (error) {
      commit("SET_LOADING", false);
      commit("SET_ERROR", getError(error));
    }
  },
  async getPlantTypeList({ commit }) {
    commit("SET_LOADING", true);
    try {
      const response = await API.apiClient.get("/plant_type");
      commit("SET_PLANTTYPE_LIST", response.data.data);
      commit("SET_LOADING", false);
    } catch (error) {
      commit("SET_LOADING", false);
      commit("SET_ERROR", getError(error));
    }
  },
  async addNewSeedsPack({ commit }, payload) {
    commit("SET_LOADING", true);
    try {
      const response = await InventoryService.postData("/seeds", payload);
      commit("SET_SEEDS_LIST", response.data.data);
      commit("SET_LOADING", false);
    } catch (error) {
      commit("SET_LOADING", false);
      commit("SET_ERROR", getError(error));
    }
  },
  async changingSeedsPack({ commit, getters }, payload) {
    if (+payload.newAmount) {
      commit("SET_LOADING", true);
      try {
        await InventoryService.changeData(
          "/seeds",
          getters.selectedSeedPack,
          `amount=${payload.newAmount}`
        );
        commit("CHANGE_SEED_PACK_AMOUNT", {
          id: getters.selectedSeedPack,
          newAmount: payload.newAmount,
        });
      } catch (error) {
        commit("SET_LOADING", false);
        commit("SET_ERROR", getError(error));
      }
    } else {
      commit("SET_LOADING", true);
      try {
        await InventoryService.deleteData("/seeds", getters.selectedSeedPack);
        commit("DELETE_SEED_PACK", getters.selectedSeedPack);
        commit("SET_LOADING", false);
      } catch (error) {
        commit("SET_LOADING", false);
        commit("SET_ERROR", getError(error));
      }
    }
  },

  async addNewSeedling({ commit }, payload) {
    commit("SET_LOADING", true);
    try {
      const response = await InventoryService.postData("/seedling", payload);
      commit("SET_SEEDLINGS_LIST", response.data.data);
      commit("SET_LOADING", false);
    } catch (error) {
      commit("SET_LOADING", false);
      commit("SET_ERROR", getError(error));
    }
  },
  async changingSeedling({ commit, getters }, payload) {
    if (+payload.newAmount) {
      commit("SET_LOADING", true);
      try {
        await InventoryService.changeData(
          "/seedling",
          getters.selectedSeedlingItem,
          `amount=${payload.newAmount}`
        );
        commit("CHANGE_SEEDLING_AMOUNT", {
          id: getters.selectedSeedlingItem,
          newAmount: payload.newAmount,
        });
      } catch (error) {
        commit("SET_LOADING", false);
        commit("SET_ERROR", getError(error));
      }
    } else {
      commit("SET_LOADING", true);
      try {
        await InventoryService.deleteData(
          "/seedling",
          getters.selectedSeedlingItem
        );
        commit("DELETE_SEEDLING", getters.selectedSeedlingItem);
        commit("SET_LOADING", false);
      } catch (error) {
        commit("SET_LOADING", false);
        commit("SET_ERROR", getError(error));
      }
    }
  },
  seedsPlantTypeSelect({ commit, getters }, itemId) {
    commit(
      "SET_SELECTED_PLANT_SEEDS",
      getters.selectedPlantOfSeeds === itemId ? null : itemId
    );
  },
  seedlingPlantTypeSelect({ commit, getters }, itemId) {
    commit(
      "SET_SELECTED_PLANT_SEEDLINGS",
      getters.selectedPlantOfSeedlings === itemId ? null : itemId
    );
  },
  seedItemSelect({ commit, getters }, itemId) {
    commit(
      "SET_SELECTED_SEED_PACK",
      getters.selectedSeedPack === itemId ? null : itemId
    );
  },
  seedlingItemSelect({ commit, getters }, itemId) {
    commit(
      "SET_SELECTED_SEEDLING_ITEM",
      getters.selectedSeedlingItem === itemId ? null : itemId
    );
  },
};

export const getters = {
  seedsList: (state) => {
    return state.seedsList;
  },
  seedlingsList: (state) => {
    return state.seedlingsList;
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
  manufacturerList: (state) => {
    return state.manufacturerList;
  },

  selectedPlantOfSeeds: (state) => {
    return state.selectedPlantOfSeeds;
  },
  selectedPlantOfSeedlings: (state) => {
    return state.selectedPlantOfSeedlings;
  },
  selectedSeedPack: (state) => {
    return state.selectedSeedPack;
  },
  selectedSeedlingItem: (state) => {
    return state.selectedSeedlingItem;
  },

  loading: (state) => {
    return state.loading;
  },
  error: (state) => {
    return state.error;
  },
};
