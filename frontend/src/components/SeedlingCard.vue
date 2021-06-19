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

    <div class="flex flex-wrap w-full text-sm text-left whitespace-pre-wrap">
      <div class="w-full border-2 border-green-300 rounded p-1">
        <p class="card__date">
          <span class="font-semibold">Дата приобретения:</span>
          {{ seedling.purchase_date }}
        </p>
        <p class="card__date">
          <span class="font-semibold">Дата посадки сем:</span>
          {{ seedling.plant_date }}
        </p>
      </div>
      <div
        class="w-full border-2 border-green-300 rounded p-1 mt-1"
        :title="seedlingManufacturerOfType.notes"
      >
        <p>
          <span class="font-semibold">Производитель:</span>
          {{ seedlingManufacturerOfType.name }}
        </p>
        <p class="whitespace-normal">
          <span class="font-semibold">Адрес:</span>
          {{ seedlingManufacturerOfType.address }}
        </p>
        <p>
          <span class="font-semibold">Email:</span>
          <a
            class="cursor-pointer underline"
            :href="'mailto:' + seedlingManufacturerOfType.email"
          >
           {{ seedlingManufacturerOfType.email }}
          </a>
          
        </p>
        <a :href="'tel:' + seedlingManufacturerOfType.phone" class="block">
          <span class="font-semibold">Phone:</span>
          {{ seedlingManufacturerOfType.phone }}
        </a>
        <p>
          <span class="font-semibold no-underline">Наш вебсайт:</span>
          <a
            class="cursor-pointer underline"
            :href="seedlingManufacturerOfType.website"
          >
            {{ seedlingManufacturerOfType.website }}
          </a>
        </p>
      </div>
    </div>
    <div class="w-full border-2 border-green-300 rounded p-1 mt-1">
      <p class="card__string" :title="seedlingFamilyOfType.notes">
        <span class="font-semibold">Семейство:</span>
        {{ seedlingFamilyOfType.name }}
      </p>
      <p class="card__string" :title="seedlingSpeciesOfType.notes">
        <span class="font-semibold"> Разновидность:</span>
        {{ seedlingSpeciesOfType.name }}
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
        newAmount: this.seedlingAmount,
      });
    },
  },

  mounted() {
    this.seedlingAmount = this.seedling.amount;
  },
};
</script>

<style></style>
