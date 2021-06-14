<template>
  <div class="card p-2 cursor-auto bg-white" @click.stop="">
    <div class="flex w-full">
      <div class="relative z-0 w-full mb-2">
        <input
          type="number"
          name="money"
          placeholder=" "
          class="pt-3 pb-2 pl-5 block px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black cursor-pointer"
          @click.stop=""
          @change="changeQuant"
          v-model="packAmount"
        />
        <div class="absolute top-0 left-0 mt-3 ml-1 text-gray-400"></div>
        <label
          for="money"
          class="absolute duration-300 top-5 left-5 -z-1 origin-0 text-gray-500"
          >Кол-во:</label
        >
        <span class="text-sm text-red-600 hidden" id="error"
          >Amount is required</span
        >
      </div>
      <div class="w-full p-1">
        <p>Цена: {{ seedPack.price }}</p>
      </div>
    </div>

    <div class="flex w-full">
      <div class="w-full border-2 border-green-300 rounded p-1 mr-1">
        <p class="card__date">Дата проиводства: {{ seedPack.production_date }}</p>
        <p class="card__date">Срок годности: {{ seedPack.expiration_date }}</p>
        <p class="card__date">{{ seedPack.harvestYear }}</p>
      </div>
      <div
        class="w-full border-2 border-green-300 rounded p-1"
        :title="seedsManufacturerOfType.notes"
      >
        <p>Производитель: {{ manufacturer.name }}</p>
        <p>Адрес: {{ seedsManufacturerOfType.address }}</p>
        <p>Email: {{ seedsManufacturerOfType.email }}</p>
        <p>Phone: {{ seedsManufacturerOfType.phone }}</p>
        <a
          class="cursor-pointer underline"
          :href="seedsManufacturerOfType.website"
          >Вебсайт</a
        >
      </div>
    </div>
    <div class="w-full border-2 border-green-300 rounded p-1 mt-1">
      <p class="card__string" :title="seedsFamilyOfType.description">
        Семейство: {{ seedsFamilyOfType.name }}
      </p>
      <p class="card__string" :title="seedsSpeciesOfType.description">
        Разновидность: {{ seedsSpeciesOfType.name }}
      </p>
    </div>
  </div>
</template>

<script>
export default {
  components: {},

  props: {
    seedPack: Object,
    plantType: Object,
    family: Array,
    species: Array,
    manufacturer: Array,
    changeAmount: Function,
  },

  data() {
    return {
      packAmount: undefined,
    };
  },

  computed: {
    seedsFamilyOfType() {
      //let familyId = this.plantTypeList.find( item => item.id === this.selectedPlantOfSeeds).familyId;
      return this.family.find((item) => item.id === this.plantType.family_id);
    },
    seedsSpeciesOfType() {
      //let speciesId = this.plantTypeList.find( item => item.id === this.selectedPlantOfSeeds).speciesId;
      return this.species.find((item) => item.id === this.plantType.species_id);
    },
    seedsManufacturerOfType() {
      return this.manufacturer.find(
        (item) => item.id === this.seedPack.manufacturer_id
      );
    },
  },

  methods: {
    changeQuant() {
      //this.seedPack.amount = this.packAmount;
      this.changeAmount({
        seedPack: this.seedPack,
        newAmount: this.packAmount,
      });
    },
  },

  mounted() {
    this.packAmount = this.seedPack.amount;
  },
};
</script>

<style>
.-z-1 {
  z-index: -1;
}

.origin-0 {
  transform-origin: 0%;
}

input:focus ~ label,
select:focus ~ label {
  /* @apply text-black; left-0; */
  --tw-text-opacity: 1;
  color: rgba(0, 0, 0, var(--tw-text-opacity));
  left: 0px;
}
</style>
