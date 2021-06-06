<template>
  <header class="bg-green-200 h-full text-center">
    <h1 class="font-bold text-3xl pt-5 text-red-900">Менеджер растений - веб портал</h1>
    <nav class="p-3 pb-2 flex items-center justify-center">
      <div class="wrapper-1 flex justify-between w-screen p-5">
        <div class="nav-left flex space-x-2">
          <div class="menu-item px-4 py-2 rounded-md text-red-800 font-bold"><a href="/">Домашняя страница</a></div>
          <div class="menu-item px-4 py-2 rounded-md text-red-800 font-bold"><a href="/profile">Личный кабинет</a></div>
          <div class="menu-item px-4 py-2 rounded-md text-red-800 font-bold"><a href="/about">О нас</a></div>
        </div>
        <div class="nav-right flex space-x-2">
            <img
              class="w-10 h-10 flex-none w-18 h-18 rounded-lg object-cover bg-gray-100"
              src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
              alt="avatar"
            />
            <Dropdown title="Options" :items="options" />
        </div>
      </div>
    </nav>
  </header>
</template>

<script>
import Dropdown from "@/components/Dropdown";

export default {
  data() {
    return {
      options: [
        {
          title: "Account settings",
          link: "#"
        },
        {
          title: "Support",
          link: "#"
        },
        {
          title: "Выйти",
          link: "#"
        }
      ]
    };
  },
  components: {
    Dropdown
  }
};
</script>

<style>

nav .menu-item {
  position: relative;
  border-bottom: 3px solid transparent;
  transition: 0.4s;
}

nav .menu-item.active,
nav .menu-item:hover {
  background-color: #FFF9D0;
  border-bottom-color: #003e12;
}

nav .menu-item a {
  color: inherit;
  text-decoration: none;
}
</style>
