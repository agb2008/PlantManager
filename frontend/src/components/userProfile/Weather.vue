<template>
  <div class="h-full">
    <div class="flex items-center justify-start">
      <div class="flex flex-col rounded p-4 w-full max-w-xs">
        <h3 class="font-bold text-2xl">Погода в</h3>
        <form
          class="search-location mb-5 justify-center"
          @submit.prevent="getWeather"
        >
          <input
            type="text"
            class="border border-gray-300 p-2 my-2 rounded-md focus:outline-none focus:ring-2 ring-blue-200"
            placeholder="Выберете город"
            v-model="citySearch"
            autocomplete="off"
          />
        </form>
        <p class="underline text-red-500" v-if="notCityFound">
          К сожалению, такой город не найден!
        </p>
        <div v-if="visible">
          <div class="font-bold text-xl">{{ weather.cityName }}</div>
          <div class="text-sm text-gray-500">{{ date }}</div>
          <div
            class="mt-6 text-6xl self-center inline-flex items-center justify-center rounded-lg text-indigo-400 h-24 w-24"
          >
            <!-- <img :src="`./components/userProfile/icons/${weatherIcon}.png`" alt="icon"> -->
          </div>
          <div class="flex flex-row items-center justify-center mt-6">
            <div class="font-medium text-6xl">
              {{ weather.temperature }}&deg;
            </div>
            <div class="flex flex-col items-center ml-6">
              <div>{{ weather.description }}</div>
              <div class="mt-1">
                <span class="text-sm"
                  ><i class="far fa-long-arrow-up"></i
                ></span>
                <span class="text-sm font-light text-gray-500"
                  >{{ weather.highTemp }}&deg;C</span
                >
              </div>
              <div>
                <span class="text-sm"
                  ><i class="far fa-long-arrow-down"></i
                ></span>
                <span class="text-sm font-light text-gray-500"
                  >{{ weather.lowTemp }}&deg;C</span
                >
              </div>
            </div>
          </div>
          <div class="flex flex-row justify-around mt-6">
            <div class="flex flex-col items-center">
              <div class="font-medium text-sm">Ветер</div>
              <div class="text-sm text-gray-500">{{ weather.wind }}k/h</div>
            </div>
            <div class="flex flex-col items-center">
              <div class="font-medium text-sm">Влажность</div>
              <div class="text-sm text-gray-500">{{ weather.humidity }}%</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      visible: false,
      notCityFound: false,
      date: new Date(),
      interval: null,
      weather: {
        citySearch: "",
        cityName: "---",
        weatherIcon: "",
        temperature: "-",
        description: "-",
        highTemp: "-",
        lowTemp: "-",
        wind: "-",
        humidity: "-",
      },
    };
  },
  methods: {
    getWeather: async function () {
      console.log(this.citySearch);
      const key = "dcd5629b25f777681467ef325df6256c";
      const url = `http://api.openweathermap.org/data/2.5/find?q=${this.citySearch}&appid=${key}&units=metric`;

      try {
        let response = await fetch(url);
        let data = await response.json();
        console.log(data);
        this.citySearch = "";
        this.weather.cityName = data.list[0].name;
        this.weather.weatherIcon = data.list[0].weather.icon;
        this.weather.temperature = Math.round(data.list[0].main.temp);
        this.weather.description = data.list[0].weather[0].main;
        this.weather.highTemp = Math.round(data.list[0].main.temp_max);
        this.weather.lowTemp = Math.round(data.list[0].main.temp_min);
        this.weather.wind = data.list[0].wind.speed;
        this.weather.humidity = data.list[0].main.humidity;
        this.weatherIcon = data.list[0].weather[0].icon;

        this.visible = true;
        this.notCityFound = false;
      } catch (error) {
        console.log(error);
        this.notCityFound = true;
      }
    },
  },
  mounted() {
    this.interval = setInterval(() => {
      this.date = new Date()
    }, 1000)
  },
  beforeDestroy() {
    clearInterval(this.interval)
  }
};
</script>

