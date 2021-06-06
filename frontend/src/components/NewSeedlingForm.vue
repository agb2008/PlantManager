<template>
  <div>
    <div
      class="flex items-center justify-center px-3 py-2 text-gray-700 border-green-400 rounded bg-green-300 cursor-pointer hover:bg-green-400 hover:text-gray-900"
      @click="openModal(true)"
    >
      <h3 class="px-3 py-2 text-gray-700 border-gray-300 cursor-pointer">
        {{ "Добавить новый тип семян" }}
      </h3>
    </div>
    <div
      id="modal_overlay"
      class="absolute inset-0 bg-black bg-opacity-30 h-screen w-full flex justify-center items-start md:items-center pt-10 md:pt-0"
      :class="{ hidden: !isOverlayShow }"
    >
      <!-- modal -->
      <div
        id="modal"
        class="transform relative w-10/12 md:w-1/2 h-auto md:h-3/4 px-6 py-12 bg-white rounded shadow-lg transition-opacity transition-transform duration-300"
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
        <div class="border-b border-gray-200 mb-8">
          <h1 class="text-2xl font-bold mb-8">Form With Floating Labels</h1>
        </div>
        <span>
          <svg
            class="fill-current h-4 w-4 transform group-hover:-rotate-180 transition duration-150 ease-in-out"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
          >
            <path
              d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
            />
          </svg>
        </span>
        <!-- body -->
        <div class="relative z-0 w-full mb-5">
          <select
            v-model="selectedPlant"
            name="select"
            value=""
            type="number"
            onclick="this.setAttribute('value', this.value);"
            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none z-1 focus:outline-none focus:ring-0 focus:border-black border-gray-200"
          >
            <option value="" selected disabled hidden></option>
            <option
              v-for="itemType in plantTypeList"
              :key="itemType.id"
              :value="itemType.id"
            >
              {{ itemType.name }}
            </option>
          </select>
          <label
            for="select"
            class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500"
            >Выберите тип растения</label
          >
          <span class="text-sm text-red-600 hidden" id="error"
            >Option has to be selected</span
          >
        </div>
        <div class="relative z-0 w-full mb-5">
          <input
            v-model="plantName"
            type="text"
            name="name"
            placeholder=" "
            required
            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
          />
          <label
            for="name"
            class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500"
            >Введите название</label
          >
          <span class="text-sm text-red-600 hidden" id="error"
            >Name is required</span
          >
        </div>
        <div class="relative z-0 w-full mb-5">
          <select
            v-model="manufacturerId"
            name="select"
            value=""
            type="number"
            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none z-1 focus:outline-none focus:ring-0 focus:border-black border-gray-200"
          >
            <option value="" selected disabled hidden></option>
            <option
              v-for="itemManufact in manufacturerList"
              :key="itemManufact.id"
              :value="itemManufact.id"
            >
              {{ itemManufact.name }}
            </option>
          </select>
          <label
            for="select"
            class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500"
            >Выберите производителя</label
          >
          <span class="text-sm text-red-600 hidden" id="error"
            >Option has to be selected</span
          >
        </div>
        <div class="relative z-0 w-full mb-5">
          <input
            v-model="purchaseDate"
            type="text"
            name="date"
            placeholder=" "
            onclick="this.setAttribute('type', 'date');"
            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
          />
          <label
            for="date"
            class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500"
            >Дата приобретения</label
          >
          <span class="text-sm text-red-600 hidden" id="error"
            >Date is required</span
          >
        </div>
        <div class="relative z-0 w-full mb-5">
          <input
            v-model="plantDate"
            type="text"
            name="date"
            placeholder=" "
            onclick="this.setAttribute('type', 'date');"
            class="pt-3 pb-2 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
          />
          <label
            for="date"
            class="absolute duration-300 top-3 -z-1 origin-0 text-gray-500"
            >Дата посадки</label
          >
          <span class="text-sm text-red-600 hidden" id="error"
            >Date is required</span
          >
        </div>

        <div class="relative z-0 w-full mb-5">
          <input
            v-model="amount"
            type="number"
            name="money"
            placeholder=" "
            class="pt-3 pb-2 pl-5 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
          />
          <div class="absolute top-0 left-0 mt-3 ml-1 text-gray-400"></div>
          <label
            for="money"
            class="absolute duration-300 top-3 left-5 -z-1 origin-0 text-gray-500"
            >Количество саженцев</label
          >
          <span class="text-sm text-red-600 hidden" id="error"
            >Amount is required</span
          >
        </div>
        <div class="relative z-0 w-full mb-5">
          <input
            v-model="price"
            type="number"
            name="money"
            placeholder=" "
            class="pt-3 pb-2 pl-5 block w-full px-0 mt-0 bg-transparent border-0 border-b-2 appearance-none focus:outline-none focus:ring-0 focus:border-black border-gray-200"
          />
          <div class="absolute top-0 left-0 mt-3 ml-1 text-gray-400"></div>
          <label
            for="money"
            class="absolute duration-300 top-3 left-5 -z-1 origin-0 text-gray-500"
            >Цена за саженец</label
          >
          <span class="text-sm text-red-600 hidden" id="error"
            >Amount is required</span
          >
        </div>
        <div
          class="group inline-block empty relative h-10 input-component mb-5"
        >
          <input
            id="name"
            type="text"
            name="name"
            class="h-full w-10/12 border-gray-300 px-2 transition-all border-blue rounded-sm"
          />
          <label
            for="name"
            class="absolute left-2 transition-all bg-white px-1"
          >
            Выберите тип растения
          </label>
          <ul
            class="bg-white border rounded-sm transform scale-0 group-hover:scale-100 absolute transition duration-150 ease-in-out origin-top min-w-32"
          >
            <li class="rounded-sm px-3 py-1 hover:bg-gray-100">Programming</li>
            <li class="rounded-sm px-3 py-1 hover:bg-gray-100">DevOps</li>
            <li class="rounded-sm relative px-3 py-1 hover:bg-gray-100"></li>
          </ul>
        </div>

        <div class="w-full p-3">
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Asperiores,
          quis tempora! Similique, explicabo quaerat maxime corrupti tenetur
          blanditiis voluptas molestias totam? Quaerat laboriosam suscipit
          repellat aliquam blanditiis eum quos nihil.
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
export default {
  props: {
    newData: Function,
    plantTypeList: Array,
    manufacturerList: Array,
  },

  data() {
    return {
      isOverlayShow: false,
      isModalShow: false,
      selectedPlant: undefined,
      plantName: undefined,
      manufacturerId: undefined,
      amount: undefined,
      price: undefined,
      purchaseDate: undefined,
      plantDate: undefined,
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
        id: 19,
        name: this.plantName,
        typePlant: this.selectedPlant,
        amount: this.amount,
        price: this.price,
        manufacturerId: this.manufacturerId,
        purchaseDate: this.purchaseDate,
        plantDate: this.plantDate,
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
