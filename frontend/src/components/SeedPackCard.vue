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
    <div class="flex flex-wrap w-full text-sm text-left whitespace-pre-wrap">
      <div class="w-full border-2 border-green-300 rounded p-1">
        <p class="card__date">
          <span class="font-semibold">Дата про-ва:</span>
          {{ seedPack.production_date }}
        </p>
        <p class="card__date">
          <span class="font-semibold">Срок год-сти:</span>
          {{ seedPack.expiration_date }}
        </p>
        <p class="card__date">
          <span class="font-semibold">Дата сбора:</span>
          {{ seedPack.harvest_date }}
        </p>
      </div>
      <div
        class="w-full border-2 border-green-300 rounded p-1 mt-1"
        :title="seedsManufacturerOfType.notes"
      >
        <p>
          <span class="font-semibold">Производитель:</span>
          {{ seedsManufacturerOfType.name }}
        </p>
        <p class="whitespace-normal">
          <span class="font-semibold">Адрес:</span>
          {{ seedsManufacturerOfType.address }}
        </p>
        <p>
          <span class="font-semibold">Email:</span>
          <a
            class="cursor-pointer underline"
            :href="'mailto:' + seedsManufacturerOfType.email"
          >
            {{ seedsManufacturerOfType.email }}
          </a>
        </p>
        <a :href="'tel:' + seedsManufacturerOfType.phone" class="block">
          <span class="font-semibold">Phone:</span>
          {{ seedsManufacturerOfType.phone }}
        </a>
        <p>
          <span class="font-semibold no-underline">Наш вебсайт:</span>
          <a
            class="cursor-pointer underline"
            :href="seedsManufacturerOfType.website"
          >
            {{ seedsManufacturerOfType.website }}
          </a>
        </p>
      </div>
    </div>
    <div class="w-full border-2 border-green-300 rounded p-1 mt-1">
      <p class="card__string" :title="seedsFamilyOfType.description">
        <span class="font-semibold">Семейство:</span>
        {{ seedsFamilyOfType.name }}
      </p>
      <p class="card__string" :title="seedsSpeciesOfType.description">
        <span class="font-semibold"> Разновидность:</span>
        {{ seedsSpeciesOfType.name }}
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
      return this.family.find((item) => item.id === this.plantType.family_id);
    },
    seedsSpeciesOfType() {
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
