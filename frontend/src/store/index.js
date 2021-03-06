import Vue from "vue";
import Vuex from "vuex";

import * as auth from "@/store/modules/Auth";
import * as user from "@/store/modules/User";
import * as message from "@/store/modules/Message";
import * as todos from "@/store/modules/Todos";
import * as inventory from "@/store/modules/Inventory";
import * as gardenbed from "@/store/modules/GardenBed";

Vue.use(Vuex);

export default new Vuex.Store({
  strict: true,

  modules: {
    auth,
    user,
    message,
    todos,
    inventory,
    gardenbed,
  },
});
