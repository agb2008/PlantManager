<template>
  <div class="card p-2 cursor-auto bg-white" @click.stop="">
    <div class="flex w-full justify-around">
      <CustomInput
        type="number"
        label="Кол-во:"
        name="money"
        v-model="packAmount"
        @change="changeQuant"
        class="mb-2 w-full"
      />
      <div class="w-full pt-6">
        <p class="text-center">Цена: {{ seedPack.price }}</p>
      </div>
    </div>
    <div class="flex w-full">
      <div class="w-full border-2 border-green-300 rounded p-1 mr-1">
        <p class="card__date">
          Дата проиводства: {{ seedPack.production_date }}
        </p>
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
import CustomInput from "./CustomInput";

export default {
  components: {
    CustomInput,
  },

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
      this.changeAmount({
        // seedPack: this.seedPack,
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
