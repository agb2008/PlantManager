<template>
  <div class="w-full p-5 m-auto">
    <h1 class="text-3xl text-center">
      Инвентарь пользователя {{ authUser.name }}
    </h1>
    <div class="inventory flex justify-center py-2 mx-auto lg:mt-16">
      <div
        class="flex flex-wrap justify-between w-80 sm:w-96 md:w-full lg:justify-evenly"
      >
        <!-- Семена -->
        <div class="seedsList w-80 lg:w-5/12">
          <div class="p-2 mb-2 bg-white border rounded shadow">
            <h2
              class="px-3 py-2 mb-2 mt-3 font-bold text-gray-800 bg-green-400 rounded-md"
            >
              Семена
            </h2>
            <ul class="">
              <li
                v-for="plantType in listOfType(seedsList)"
                :key="plantType.id"
                @click="seedsPlantTypeSelect(plantType.id)"
                class="mt-1"
                :title="plantType.notes"
                :class="{
                  'border rounded border-green-200':
                    selectedPlantOfSeeds === plantType.id,
                }"
              >
                <h3
                  class="px-3 py-2 text-gray-700 rounded cursor-pointer hover:bg-green-200"
                  :class="{
                    'bg-white border-green-200':
                      selectedPlantOfSeeds != plantType.id,
                    'bg-green-200 rounded-b-none':
                      selectedPlantOfSeeds === plantType.id,
                  }"
                >
                  {{ plantType.name }}
                </h3>
                <ul
                  :class="{ active: selectedPlantOfSeeds === plantType.id }"
                  v-if="selectedPlantOfSeeds === plantType.id"
                  class="p-2"
                >
                  <li
                    v-for="seedsPack in seedsOfType"
                    :key="seedsPack.id"
                    @click.stop="seedItemSelect(seedsPack.id)"
                    class=""
                    :class="{
                      'border-2 rounded border-green-400':
                        selectedSeedPack === seedsPack.id,
                    }"
                  >
                    <div
                      class="flex justify-between items-center px-3 py-2 text-gray-700 cursor-pointer hover:bg-green-100"
                      :class="{
                        'bg-green-100': selectedSeedPack === seedsPack.id,
                      }"
                    >
                      <h4 class="font-mono text-sm">
                        {{ seedsPack.name }}
                      </h4>

                      <div class="items-center px-1 py-0.5 rounded">
                        Всего семян:{{
                          seedsPack.number_of_seeds * seedsPack.amount
                        }}
                      </div>
                    </div>

                    <div v-if="selectedSeedPack === seedsPack.id">
                      <SeedPackCard
                        :seedPack="seedsPack"
                        :plantType="plantType"
                        :family="familyList"
                        :species="speciesList"
                        :manufacturer="manufacturerList"
                        :changeAmount="changingSeedsPack"
                      ></SeedPackCard>
                    </div>
                  </li>
                </ul>
              </li>
              <li class="my-1">
                <NewSeedForm
                  :newData="addNewSeedsPack"
                  :plantTypeList="plantTypeList"
                  :manufacturerList="manufacturerList"
                ></NewSeedForm>
              </li>
            </ul>
          </div>
        </div>
        <!-- Рассада -->
        <div class="seedlingsList w-80 lg:w-5/12">
          <div class="p-2 bg-white border rounded shadow">
            <h2
              class="px-3 py-2 mb-2 mt-3 font-bold text-gray-800 bg-green-400 rounded-md"
            >
              Рассада
            </h2>
            <ul>
              <li
                v-for="plantType in listOfType(seedlingsList)"
                :key="plantType.id"
                @click="seedlingPlantTypeSelect(plantType.id)"
                class="mt-1"
                :class="{
                  'border rounded border-green-200':
                    selectedPlantOfSeedlings === plantType.id,
                }"
                :title="plantType.notes"
              >
                <h3
                  class="px-3 py-2 text-gray-700 rounded cursor-pointer hover:bg-green-200"
                  :class="{
                    'bg-white border-green-200':
                      selectedPlantOfSeedlings != plantType.id,
                    'bg-green-200 rounded-b-none':
                      selectedPlantOfSeedlings === plantType.id,
                  }"
                >
                  {{ plantType.name }}
                </h3>

                <ul
                  :class="{ active: selectedPlantOfSeedlings === plantType.id }"
                  v-if="selectedPlantOfSeedlings === plantType.id"
                  class="p-2"
                >
                  <li
                    v-for="seedlingsList in seedlingsOfType"
                    :key="seedlingsList.id"
                    @click.stop="seedlingItemSelect(seedlingsList.id)"
                    class=""
                    :class="{
                      'border-2 rounded border-green-400':
                        selectedSeedlingItem === seedlingsList.id,
                    }"
                  >
                    <div
                      class="flex justify-between items-center px-3 py-2 text-gray-700 cursor-pointer hover:bg-green-100"
                      :class="{
                        'bg-green-100':
                          selectedSeedlingItem === seedlingsList.id,
                      }"
                    >
                      <h4 class="font-mono text-sm">
                        {{ seedlingsList.name }}
                      </h4>
                      <div class="items-center px-1 py-0.5 rounded">
                        Всего саженцев:{{ seedlingsList.amount }}
                      </div>
                    </div>
                    <div v-if="selectedSeedlingItem === seedlingsList.id">
                      <SeedlingCard
                        :seedling="seedlingsList"
                        :plantType="plantType"
                        :family="familyList"
                        :species="speciesList"
                        :manufacturer="manufacturerList"
                        :changeAmount="changingSeedling"
                      >
                      </SeedlingCard>
                    </div>
                  </li>
                </ul>
              </li>
              <li class="my-1">
                <NewSeedlingForm
                  :newData="addNewSeedling"
                  :plantTypeList="plantTypeList"
                  :manufacturerList="manufacturerList"
                ></NewSeedlingForm>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import { mapActions } from "vuex";

import SeedPackCard from "../components/SeedPackCard.vue";
import SeedlingCard from "../components/SeedlingCard.vue";
import NewSeedForm from "../components/NewSeedForm.vue";
import NewSeedlingForm from "../components/NewSeedlingForm.vue";

export default {
  components: {
    SeedPackCard,
    NewSeedForm,
    NewSeedlingForm,
    SeedlingCard,
  },

  props: {
    // user: { String, required: true },
    // seedsList: Object,
  },

  data() {
    return {};
  },

  methods: {
    ...mapActions("inventory", [
      "addNewSeedsPack",
      "changingSeedsPack",
      "addNewSeedling",
      "changingSeedling",
      "seedsPlantTypeSelect",
      "seedlingPlantTypeSelect",
      "seedItemSelect",
      "seedlingItemSelect",
    ]),
    listOfType(itemsList) {
      let typesIdList = itemsList.map((item) => item.type_id);
      return this.plantTypeList.filter((item) => typesIdList.includes(item.id));
    },
  },

  computed: {
    ...mapGetters("inventory", [
      "loading",
      "error",
      "seedsList",
      "seedlingsList",
      "plantTypeList",
      "familyList",
      "speciesList",
      "manufacturerList",
      "selectedPlantOfSeeds",
      "selectedPlantOfSeedlings",
      "selectedSeedPack",
      "selectedSeedlingItem",
    ]),
    ...mapGetters("auth", ["authUser"]),
    seedsOfType() {
      return this.seedsList.filter(
        (item) => item.type_id === this.selectedPlantOfSeeds
      );
    },
    seedlingsOfType() {
      return this.seedlingsList.filter(
        (item) => item.type_id === this.selectedPlantOfSeedlings
      );
    },
  },

  mounted() {
    this.$store.dispatch("inventory/getAllData");
  },
};
</script>

<style></style>
