<template>
  <div class="card p-2 cursor-auto bg-white" @click.stop="">
    <div class="flex w-full justify-around">
      <CustomInput
        type="number"
        label="Кол-во:"
        name="money"
        v-model="seedlingAmount"
        @change="changeQuant"
        class="mb-2 w-full"
      />

      <div class="w-full pt-6">
        <p class="text-center">Цена: {{ seedling.price }}</p>
      </div>
    </div>

    <div class="flex w-full">
      <div class="w-full border-2 rounded p-1">
        <p class="card__date">Дата приобретения: {{ seedling.purchaseDate }}</p>
        <p class="card__date">Дата посадки сем: {{ seedling.plantDate }}</p>
      </div>
      <div
        class="w-full border-2 rounded p-1"
        :title="seedlingManufacturerOfType.notes"
      >
        <p>Производитель: {{ seedlingManufacturerOfType.name }}</p>
        <p>Адрес: {{ seedlingManufacturerOfType.address }}</p>
        <p>Email: {{ seedlingManufacturerOfType.email }}</p>
        <p>Phone: {{ seedlingManufacturerOfType.phone }}</p>
        <a
          class="cursor-pointer underline"
          :href="seedlingManufacturerOfType.website"
          >Вебсайт</a
        >
      </div>
    </div>
    <div class="w-full border-2 rounded p-1">
      <p class="card__string" :title="seedlingFamilyOfType.notes">
        Семейство: {{ seedlingFamilyOfType.name }}
      </p>
      <p class="card__string" :title="seedlingSpeciesOfType.notes">
        Разновидность: {{ seedlingSpeciesOfType.name }}
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
    seedling: Object,
    plantType: Object,
    family: Array,
    species: Array,
    manufacturer: Array,
    changeAmount: Function,
  },

  data() {
    return {
      seedlingAmount: undefined,
    };
  },

  computed: {
    seedlingFamilyOfType() {
      return this.family.find((item) => item.id === this.plantType.family_id);
    },
    seedlingSpeciesOfType() {
      return this.species.find((item) => item.id === this.plantType.species_id);
    },
    seedlingManufacturerOfType() {
      return this.manufacturer.find(
        (item) => item.id === this.seedling.manufacturer_id
      );
    },
  },

  methods: {
    changeQuant() {
      this.changeAmount({
        seedling: this.seedling,
        newAmount: this.seedlingAmount,
      });
    },
  },

  mounted() {
    this.seedlingAmount = this.seedling.amount;
  },
};
</script>

<style>
</style>
