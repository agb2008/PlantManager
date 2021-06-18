<template>
  <div class="sm:flex justify-between sm:w-full">
    <div>
      <ul class="tabs__header flex mb-5 p-3 bg-white sm:flex-col">
        <li
          v-for="(tab, index) in tabs"
          :key="tab.title"
          @click="selectTab(index)"
          class="mr-2 cursor-pointer p-0.5"
          :class="{ tabs__selected: index == selectedIndex }"
        >
          {{ tab.title }}
        </li>
      </ul>
    </div>

    <div class="flex w-full justify-center">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      selectedIndex: 0,
      tabs: [],
    };
  },
  methods: {
    selectTab(i) {
      this.selectedIndex = i;
      this.tabs.forEach((tab, index) => {
        tab.isActive = index === i;
      });
    },
  },
  created() {
    this.tabs = this.$children;
  },
};
</script>
<style>
.tabs__selected {
  text-decoration: underline;
  /* background-color: rgba(52, 211, 153, var(--tw-bg-opacity)); */
}
</style>
