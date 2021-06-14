import { getError } from "@/utils/helpers";
import InventoryService from "../../services/InventoryService";
import * as API from "@/services/API";

export const namespaced = true;

export const state = {
  seedsList: [
    {
      id: 1,
      name: "carrot",
      typePlant: 5,
      numberOfSeeds: 100,
      amount: 2,
      price: 100,
      manufacturerId: 1,
      prodDate: "2020.03.11",
      expirDate: "2020.03.12",
      harvestYear: "2020.02.12",
    },
    {
      id: 2,
      name: "carrotca",
      typePlant: 5,
      numberOfSeeds: 50,
      amount: 5,
      price: 100,
      manufacturerId: 3,
      prodDate: "2020.03.11",
      expirDate: "2020.03.12",
      harvestYear: "2020.02.12",
    },
    {
      id: 3,
      name: "tomato",
      typePlant: 8,
      numberOfSeeds: 99,
      amount: 3,
      price: 100,
      manufacturerId: 2,
      prodDate: "2020.03.11",
      expirDate: "2020.03.12",
      harvestYear: "2020.02.12",
    },
  ],
  seedlingsList: [
    {
      id: 1,
      name: "corn",
      typePlant: 1,
      amount: 2,
      price: 100,
      manufacturerId: 1,
      purchaseDate: "2020.03.11",
      plantDate: "2020.03.12",
    },
    {
      id: 2,
      name: "cornotca",
      typePlant: 1,
      amount: 5,
      price: 100,
      manufacturerId: 3,
      purchaseDate: "2020.03.11",
      plantDate: "2020.03.12",
    },
    {
      id: 3,
      name: "cyber cucumber",
      typePlant: 2,
      amount: 3,
      price: 100,
      manufacturerId: 2,
      purchaseDate: "2020.03.11",
      plantDate: "2020.03.12",
    },
  ],
  plantTypeList: [
    {
      id: 5,
      name: "морковь",
      familyId: 1,
      speciesId: 1,
      notes: "морковь однолетнее растение",
    },
    {
      id: 8,
      name: "свекла",
      familyId: 2,
      speciesId: 2,
      notes: "свекла mоднолетнее растение",
    },
    {
      id: 1,
      name: "кукуруза",
      familyId: 1,
      speciesId: 3,
      notes: "кукуруза однолетнее растение",
    },
    {
      id: 2,
      name: "огурец",
      familyId: 2,
      speciesId: 4,
      notes: "огурец mоднолетнее растение",
    },
  ],
  familyList: [
    { id: 1, name: "однолетнее", notes: " однолетнее растение" },
    { id: 2, name: "многолетнее", notes: " mоднолетнее растение" },
  ],
  speciesList: [
    { id: 1, name: "морковные", notes: "семейство морковные" },
    { id: 2, name: "свекловные", notes: "семейство свекловные" },
    { id: 3, name: "кукурузновые", notes: "семейство кукурузновые" },
    { id: 4, name: "огурецовые", notes: "семейство огурецовые" },
  ],
  manufacturerList: [
    {
      id: 1,
      name: "агроФ",
      address: "lorem ipsum",
      email: "lorem ipsum@lorem",
      phone: "2384238",
      website: "lorem ipsum",
      notes: "бла бла бла бла",
    },
    {
      id: 2,
      name: "агроE",
      address: "lorem ipsum",
      email: "lorem ipsum@lorem",
      phone: "2384238",
      website: "lorem ipsum",
      notes: "бла бла бла бла",
    },
    {
      id: 3,
      name: "агроS",
      address: "lorem ipsum",
      email: "lorem ipsum@lorem",
      phone: "2384238",
      website: "lorem ipsum",
      notes: "бла бла бла бла",
    },
  ],
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
    commit("SET_LOADING", true);
    try {
      let response = await API.apiClient.get("/seeds");
      commit("SET_SEEDS_LIST", response.data.data);
      // let test = await API.apiClient.get("/seeds/2");
      // console.log(test);
      // response = await API.apiClient.get("/seedling");
      // commit("SET_SEEDLINGS_LIST", response.data.data);
      response = await API.apiClient.get("/plant_type");
      commit("SET_PLANTTYPE_LIST", response.data.data);
      response = await API.apiClient.get("/family");
      commit("SET_FAMILY_LIST", response.data.data);
      response = await API.apiClient.get("/species");
      commit("SET_SPECIES_LIST", response.data.data);
      response = await API.apiClient.get("/manufacturer");
      commit("SET_MANUFACTURER_LIST", response.data.data);
      commit("SET_LOADING", false);
    } catch (error) {
      commit("SET_LOADING", false);
      commit("SET_ERROR", getError(error));
    } 
  },
  async getSeedsList({ commit }, userId) {
    commit("SET_LOADING", true);
    try {
      const response = await InventoryService.getSeedsList(userId);
      commit("SET_SEEDS_LIST", response.data.data);
      console.log(response.data.data);
      commit("SET_LOADING", false);
      return response.data.data;
    } catch (error) {
      commit("SET_LOADING", false);
      console.log(error);
      //commit("SET_SEEDS_LIST", null);
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
      commit("SET_SEEDLINGS_LIST", null);
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
      await InventoryService.postSeedPack(payload);
      commit("ADD_NEW_SEED_PACK", payload.newPack);
      commit("SET_LOADING", false);
    } catch (error) {
      commit("SET_LOADING", false);
      commit("SET_ERROR", getError(error));
    }
    // newPack.id = state.seedsList.length + 1;
  },
  async changingSeedsPack({ commit }, payload) {
    const action = payload.newAmount - payload.seedPack.amount;
    if (payload.seedPack.amount + action <= 0) {
      commit("SET_LOADING", true);
      try {
        await InventoryService.deleteData("/seeds",payload.seedPack.id);
        commit("DELETE_SEED_PACK", payload.seedPack.id);
        commit("SET_LOADING", false);
      } catch (error) {
        commit("SET_LOADING", false);
        commit("SET_ERROR", getError(error));
      }
    } else {
      commit("SET_LOADING", true);
      try {
        let newPack = Object.assign({}, payload.seedPack);
        newPack.amount = payload.newAmount;
        //test
        const response = await InventoryService.changeData("/seeds", payload.seedPack.id, `amount=${payload.newAmount}`);
        console.log(response);
        commit("CHANGE_SEED_PACK_AMOUNT", {
          id: payload.seedPack.id,
          newAmount: payload.newAmount,
        });
        commit("SET_LOADING", false);
      } catch (error) {
        commit("SET_LOADING", false);
        commit("SET_ERROR", getError(error));
      }
    }
  },

  addNewSeedling({ commit, state }, newSeedling) {
    // eslint-disable-next-line no-constant-condition
    if (true) {
      newSeedling.id = state.seedlingsList.length + 1;
      commit("ADD_NEW_SEEDLING", newSeedling);
    }
  },
  changingSeedling({ commit }, payload) {
    const action = payload.newAmount - payload.seedling.amount;

    if (payload.seedling.amount + action <= 0) {
      // eslint-disable-next-line no-constant-condition
      if (true) {
        commit("DELETE_SEEDLING", payload.seedling.id);
      }
    } else {
      // eslint-disable-next-line no-constant-condition
      if (true) {
        commit("CHANGE_SEEDLING_AMOUNT", {
          id: payload.seedling.id,
          newAmount: payload.newAmount,
        });
      }
    }
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
  loading: (state) => {
    return state.loading;
  },
  error: (state) => {
    return state.error;
  },
};
