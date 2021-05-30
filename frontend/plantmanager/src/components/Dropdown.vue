<template>
  <div class="menu-item" @click="isOpen = !isOpen">
    <a href="#">{{ title }}</a>
    <svg
      viewBox="0 0 20 20">
      <path
        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
        fill="#fff"/>
    </svg>
    <transition name="fade" appear>
    <div class="sub-menu" v-if="isOpen">
      <div v-for="(item, i) in items" :key="i" class="menu-item">
        <a :href="item.link">{{ item.title }}</a>
      </div>
    </div>
    </transition>
  </div>
</template>

<script>
export default {
  props: ['title', 'items'],
  data() {
    return {
      isOpen: false
    }
  }
};
</script>

<style>
nav .menu-item svg {
  width: 20px;
  margin-left: 15px;
}

nav .menu-item .sub-menu {
  position: absolute;
  background-color: #222;
  top: calc(100% + 18px);
  left: 50%;
  transform:translateX(-50%);
  width: max-content;
}

.fade-enter, .fade-leave-to {
  opacity: 0;
}

.fade-enter-active, .fade-leave-active {
  transition: all .5s ease-out
}
</style>
