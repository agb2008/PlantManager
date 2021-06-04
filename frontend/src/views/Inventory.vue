<template>
  <div class="w-full p-5 m-auto">
    <h1 class="text-3xl">Инвентарь пользователя {{ user }}</h1>
    <div class="inventory flex flex-wrap p-4 mx-auto lg:mt-24">
      <!-- Семена -->
      <div class="seeds sm: width: 100%" style="width: 100%">
        <div class="p-2 bg-white border rounded shadow">
          <h2
            class="px-3 py-2 mx-3 mb-2 mt-3 font-bold text-gray-800 bg-green-400 rounded-md"
          >
            Семена
          </h2>
          <ul class="">
            <li
              v-for="plantType in listOfType(seedsData.seeds)"
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
                        seedsPack.numberOfSeeds * seedsPack.amount
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
      <div class="seedlings w-auto" style="width: 33.3333%">
        <div class="rounded-md bg-gray-100 pt-4 m-2 overflow-hidden">
          <h2
            class="px-3 py-2 mx-3 mb-2 font-bold text-gray-800 bg-gray-200 rounded-md"
          >
            Рассада
          </h2>
          <ul>
            <li
              v-for="plantType in listOfType(seedlingData.seedlings)"
              :key="plantType.id"
              @click="seedlingPlantTypeSelect(plantType.id)"
              class="px-3 py-2 text-gray-700 border-gray-300 cursor-pointer hover:bg-gray-200 hover:text-gray-900"
              :class="{
                'bg-gray-200': selectedPlantOfSeedlings === plantType.id,
              }"
              :title="plantType.notes"
            >
              <h3 class="">{{ plantType.name }}</h3>

              <ul
                :class="{ active: selectedPlantOfSeedlings === plantType.id }"
                v-if="selectedPlantOfSeedlings === plantType.id"
                class="bg-gray-100"
              >
                <li
                  v-for="seedlings in seedlingsOfType"
                  :key="seedlings.id"
                  @click.stop="seedlingItemSelect(seedlings.id)"
                  class=""
                >
                  <div
                    class="flex justify-between items-center px-3 py-2 text-gray-700 border-gray-400 cursor-pointer hover:bg-gray-200 hover:text-gray-900"
                    :class="{
                      'bg-gray-300 hover:bg-gray-300 hover:text-gray-900':
                        selectedSeedlingItem === seedlings.id,
                    }"
                  >
                    <h4 class="font-mono text-sm">{{ seedlings.name }}</h4>
                    <div class="items-center px-1 py-0.5 rounded bg-gray-50">
                      Всего саженцев:{{ seedlings.amount }}
                    </div>
                  </div>
                  <div v-if="selectedSeedlingItem === seedlings.id">
                    <SeedlingCard
                      :seedling="seedlings"
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
            <li>
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
</template>

<script>
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
    user: { String, required: true },
    // seeds: Object,
    seedlings: Object,
  },

  data() {
    return {
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
      seedsData: {
        seeds: [
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
      },

      seedlingData: {
        seedlings: [
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
      },

      selectedPlantOfSeeds: null,
      selectedPlantOfSeedlings: null,
      selectedSeedPack: null,
      selectedSeedlingItem: null,
      addSeedsFormShow: false,
      response: true,
    };
  },

  methods: {
    listOfType(itemsList) {
      let typesIdList = itemsList.map((item) => item.typePlant);
      return this.plantTypeList.filter((item) => typesIdList.includes(item.id));
    },
    // методы управления выпадающим списком
    seedsPlantTypeSelect(itemId) {
      this.selectedPlantOfSeeds =
        this.selectedPlantOfSeeds === itemId ? null : itemId;
    },
    seedItemSelect(itemId) {
      this.selectedSeedPack = this.selectedSeedPack === itemId ? null : itemId;
    },
    seedlingPlantTypeSelect(itemId) {
      this.selectedPlantOfSeedlings =
        this.selectedPlantOfSeedlings === itemId ? null : itemId;
    },
    seedlingItemSelect(itemId) {
      this.selectedSeedlingItem =
        this.selectedSeedlingItem === itemId ? null : itemId;
    },
    // методы изменения данных
    addNewSeedsPack(newPack) {
      if (this.response) {
        newPack.id = this.seedsData.seeds.length + 1;
        this.seedsData.seeds.push(newPack);
        window.console.log(this.seedsData.seeds);
      }
    },
    changingSeedsPack(item, newAmount) {
      window.console.log(`${item.amount} ${newAmount}`);
      let action = newAmount - item.amount;
      let seedPackInd = this.seedsData.seeds.findIndex(
        (seedPack) => seedPack.id === item.id
      );
      if (seedPackInd != -1) {
        if (item.amount + action <= 0) {
          if (this.response) {
            this.seedsData.seeds.splice(seedPackInd, 1);
            window.console.log(this.seedsData.seeds[seedPackInd]);
          }
        } else {
          if (this.response) {
            // вызвать мутацию в сторе
            //this.seedsData.seeds.splice(seedPackInd,1,item);
            this.seedsData.seeds[seedPackInd].amount = newAmount;
            window.console.log(this.seedsData.seeds[seedPackInd]);
          }
        }
      }
    },

    addNewSeedling(newItem) {
      if (this.response) {
        this.seedlingData.seedlings.push(newItem);
        window.console.log(newItem);
      }
    },
    changingSeedling(item, newAmount) {
      let action = newAmount - item.amount;
      let seedlingInd = this.seedlingData.seedlings.findIndex(
        (seedlings) => seedlings.id === item.id
      );
      if (seedlingInd != -1) {
        if (item.amount + action <= 0) {
          if (this.response) {
            this.seedlingData.seedlings.splice(seedlingInd, 1);
          }
        } else {
          if (this.response) {
            // вызвать мутацию в сторе
            //this.seedlingData.seedlings.splice(seedlingInd,1,item);
            this.seedlingData.seedlings[seedlingInd].amount = newAmount;
          }
        }
      }
    },
  },

  computed: {
    seedsOfType() {
      return this.seedsData.seeds.filter(
        (item) => item.typePlant === this.selectedPlantOfSeeds
      );
    },
    seedlingsOfType() {
      return this.seedlingData.seedlings.filter(
        (item) => item.typePlant === this.selectedPlantOfSeedlings
      );
    },
  },
};
</script>

<style></style>
