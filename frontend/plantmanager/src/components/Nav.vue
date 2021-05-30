<template>
  <header>
    <h1 class="font-bold text-4xl mb-5 mt-5">Менеджер растений - веб портал</h1>
    <nav>
      <div class="wrapper-1">
        <div class="nav-left">
          <div class="menu-item"><a href="/">Домашняя страница</a></div>
          <div class="menu-item"><a href="/profile">Личный кабинет</a></div>
          <div class="menu-item"><a href="/about">О нас</a></div>
        </div>
        <div class="nav-right">
          <div class="flex -space-x-2 overflow-hidden mr-10 ml-20">
            <img
              class="inline-block h-10 w-10 rounded-full ring-2 ring-white"
              src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
              alt=""
            />
          </div>
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

.wrapper-1 {
  display: flex;
  width: 100vw;
  background-color: #222;
  padding: 15px;
}

nav {
  display: flex;
  align-items: center;
  justify-content: center;
}

.nav-left,
.nav-right {
  display: flex;
  justify-content: space-between;
}

nav .menu-item {
  display: flex;
  color: #fff;
  padding: 10px 20px;
  position: relative;
  text-align: center;
  border-bottom: 3px solid transparent;
  transition: 0.4s;
}

nav .menu-item.active,
nav .menu-item:hover {
  background-color: #444;
  border-bottom-color: #f58;
}

nav .menu-item a {
  color: inherit;
  text-decoration: none;
}
</style>
