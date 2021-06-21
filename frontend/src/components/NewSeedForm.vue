<template>
  <div>
    <div
      class="flex items-center justify-center px-3 py-2 text-gray-700 border-green-400 rounded bg-green-300 cursor-pointer hover:bg-green-400 hover:text-gray-900"
      @click="openModal(true)"
    >
      <h3 class="px-3 py-2 text-gray-700 border-gray-300 cursor-pointer">
        {{ "Добавить семяна" }}
      </h3>
    </div>
    <div
      id="modal_overlay"
      class="fixed inset-0 bg-black bg-opacity-30 h-screen w-full flex justify-center items-start md:items-center pt-10 md:pt-0"
      :class="{ hidden: !isOverlayShow }"
    >
      <!-- modal -->
      <div
        id="modal"
        class="transform relative w-72 px-3 py-6 sm:w-1/2 h-auto md:px-6 md:py-12 bg-white rounded shadow-lg transition-opacity transition-transform duration-300"
        :class="modalClassObj"
      >
        <!-- button close -->
        <button
          @click="openModal(false)"
          class="absolute -top-3 -right-3 bg-red-500 hover:bg-red-600 text-2xl w-10 h-10 rounded-full focus:outline-none text-white"
        >
          &cross;
        </button>

        <!-- header -->
        <div class="mb-2 md:mb-4">
          <h1 class="text-2xl font-bold mb-3 md:mb-8 md:text-3xl">
            Новые семена
          </h1>
        </div>
        <!-- body -->

        <div class="lg:flex justify-around">
          <BaseInputSelect
            v-model="selectedPlant"
            name="select"
            label="Выберите тип растения"
            :options="plantTypeList"
          />
          <BaseInputSelect
            v-model="manufacturerId"
            name="select"
            label="Выберите производителя"
            :options="manufacturerList"
          />
        </div>

        <CustomInput
          type="text"
          label="Введите название"
          name="name"
          v-model="plantName"
          class="mb-2"
        />

        <div class="lg:flex justify-around">
          <CustomInput
            type="date"
            label="Дата упаковки семян"
            name="date"
            v-model="prodDate"
            class="mb-2"
          />
          <CustomInput
            type="date"
            label="Дата сбора семян"
            name="date"
            v-model="harvestYear"
            class="mb-2"
          />
          <CustomInput
            type="date"
            label="Срок годности до"
            name="date"
            v-model="expirDate"
            class="mb-2"
          />
        </div>

        <div class="lg:flex justify-around mb-14">
          <CustomInput
            type="number"
            label="Кол-во семян"
            name="money"
            v-model="numberOfSeeds"
            class="mb-2 lg:mr-1"
          />

          <CustomInput
            type="number"
            label="Кол-во пачек"
            name="money"
            v-model="amount"
            class="mb-2 lg:mr-1"
          />

          <CustomInput
            type="number"
            label="Цена за пачку"
            name="name"
            v-model="price"
            class="mb-2"
          />
        </div>

        <!-- footer -->
        <div
          class="absolute bottom-0 left-0 px-4 py-3 border-t border-gray-200 w-full flex justify-end items-center gap-3"
        >
          <button
            class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white focus:outline-none"
            @click="saveData"
          >
            Save
          </button>
          <button
            @click="openModal(false)"
            class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white focus:outline-none"
          >
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// import BaseInput from "./BaseInput";
import CustomInput from "./CustomInput";
import BaseInputSelect from "./BaseInputSelect";

export default {
  components: {
    BaseInputSelect,
    CustomInput,
  },
  props: {
    newData: Function,
    plantTypeList: Array,
    manufacturerList: Array,
    user_id: Number,
  },

  data() {
    return {
      isOverlayShow: false,
      isModalShow: false,
      selectedPlant: undefined,
      plantName: undefined,
      numberOfSeeds: undefined,
      amount: undefined,
      price: undefined,
      prodDate: undefined,
      expirDate: undefined,
      harvestYear: undefined,
      manufacturerId: undefined,
    };
  },

  methods: {
    openModal(value) {
      if (value) {
        this.isOverlayShow = value;
        setTimeout(() => {
          this.isModalShow = value;
        }, 100);
      } else {
        setTimeout(() => {
          this.isModalShow = value;
        }, 100);
        setTimeout(() => (this.isOverlayShow = value), 300);
      }
    },

    saveData() {
      this.newData({
        name: this.plantName,
        type_id: this.selectedPlant,
        number_of_seeds: this.numberOfSeeds,
        amount: this.amount,
        price: this.price,
        notes: "Описание",
        img_id: 1,
        user_id: this.user_id,
        manufacturer_id: this.manufacturerId,
        production_date: this.prodDate,
        expiration_date: this.expirDate,
        harvest_date: this.harvestYear,
      });
      this.openModal(false);
    },
  },

  computed: {
    modalClassObj() {
      return {
        "opacity-0": !this.isModalShow,
        "-translate-y-full": !this.isModalShow,
        "scale-150": !this.isModalShow,
      };
    },
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
input:not(:placeholder-shown) ~ label,
textarea:focus ~ label,
textarea:not(:placeholder-shown) ~ label,
select:focus ~ label,
select:not([value=""]):valid ~ label {
  /* @apply transform; scale-75; -translate-y-6; */
  --tw-translate-x: 0;
  --tw-translate-y: 0;
  --tw-rotate: 0;
  --tw-skew-x: 0;
  --tw-skew-y: 0;
  transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y))
    rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y))
    scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
  --tw-scale-x: 0.75;
  --tw-scale-y: 0.75;
  --tw-translate-y: -1.5rem;
}

input:focus ~ label,
select:focus ~ label {
  /* @apply text-black; left-0; */
  --tw-text-opacity: 1;
  color: rgba(0, 0, 0, var(--tw-text-opacity));
  left: 0px;
}
label {
  top: 0%;
  transform: translateY(-50%);
  font-size: 11px;
  color: rgba(37, 99, 235, 1);
}
.empty input:not(:focus) + label {
  top: 50%;
  transform: translateY(-50%);
  font-size: 14px;
}
input:not(:focus) + label {
  color: rgba(70, 70, 70, 1);
}
input {
  border-width: 1px;
}
input:focus {
  outline: none;
  border-color: rgba(37, 99, 235, 1);
}

.group:hover .group-hover\:scale-100 {
  transform: scale(1);
}
.group:hover .group-hover\:-rotate-180 {
  transform: rotate(180deg);
}
.scale-0 {
  transform: scale(0);
}
.min-w-32 {
  min-width: 8rem;
}
</style>
