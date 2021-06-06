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

export const actions = {};

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
