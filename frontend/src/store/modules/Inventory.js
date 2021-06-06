//import { getError } from "@/utils/helpers";

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
};

export const mutations = {
  SET_USERS(state, users) {
    state.users = users;
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
  addNewSeedsPack({ commit, state }, newPack) {
    // eslint-disable-next-line no-constant-condition
    if (true) {
      newPack.id = state.seedsList.length + 1;
      commit("ADD_NEW_SEED_PACK", newPack);
    }
  },
  changingSeedsPack({ commit }, payload) {
    const action = payload.newAmount - payload.seedPack.amount;
    window.console.log(typeof payload.seedPack.amount);

    if (payload.seedPack.amount + action <= 0) {
      // eslint-disable-next-line no-constant-condition
      if (true) {
        commit("DELETE_SEEDLING", payload.seedPack.id);
      }
    } else {
      // eslint-disable-next-line no-constant-condition
      if (true) {
        commit("CHANGE_SEED_PACK_AMOUNT", {
          id: payload.seedPack.id,
          newAmount: payload.newAmount,
        });
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
