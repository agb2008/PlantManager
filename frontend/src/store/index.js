import Vue from "vue";
import Vuex from "vuex";

import * as auth from "@/store/modules/Auth";
import * as user from "@/store/modules/User";
import * as message from "@/store/modules/Message";
import * as gardenbed from "@/store/modules/GardenBed"
import * as tasks from "@/store/modules/Tasks"

Vue.use(Vuex);

export default new Vuex.Store({
  strict: true,

  modules: {
    auth,
    user,
    message,
    gardenbed,
    tasks,
  },
});
