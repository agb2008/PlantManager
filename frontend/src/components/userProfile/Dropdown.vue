<template>
  <div
    class="menu-item flex text-white font-bold px-4 py-2 rounded-md"
    @click="isOpen = !isOpen"
  >
    <a href="#">{{ title }}</a>
    <svg viewBox="0 0 20 20">
      <path
        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
        fill="#fff"
      />
    </svg>
    <transition name="fade" appear>
      <div class="sub-menu rounded-md" v-if="isOpen">
        <ul>
          <li class="menu-item block px-4 py-2 rounded-md">
            <router-link to="/user/options" exact
              >Настойки пользователя</router-link
            >
          </li>
          <li class="menu-item block px-4 py-2 rounded-md">
            <router-link to="/user/support">Служба поддержки</router-link>
          </li>
        </ul>
        <!-- <div v-for="(item, i) in items" :key="i" class="menu-item block px-4 py-2 rounded-md">
        <a :href="item.link">{{ item.title }}</a>
      </div> -->
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  props: ["title", "items"],
  data() {
    return {
      isOpen: false,
    };
  },
};
</script>

<style>
.menu-item svg {
  width: 20px;
  margin-left: 15px;
}

.menu-item {
  position: relative;
  border-bottom: 3px solid transparent;
  transition: 0.4s;
}

.menu-item.active,
.menu-item:hover {
  border-bottom-color: #ecf59d;
}

.menu-item .sub-menu {
  position: absolute;
  background-color: rgb(70, 163, 127);
  top: calc(100% + 18px);
  left: 50%;
  transform: translateX(-50%);
  width: max-content;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}

.fade-enter-active,
.fade-leave-active {
  transition: all 0.5s ease-out;
}
</style>
