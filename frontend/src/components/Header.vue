<template>
  <header class="p-5 text-white font-bold bg-green-500">
    <nav class="container flex items-center justify-between mx-auto">
      <div v-if="authUser" class="flex items-center space-x-5">
        <router-link to="/dashboard">
          <HomeIcon class="w-6 h-6 text-white" />
          <span class="sr-only">Dashboard</span>
        </router-link>
        <router-link to="/users" v-if="isAdmin">Users</router-link>
      </div>
      <router-link to="/" v-else>
        <HomeIcon class="w-6 h-6 text-white" />
      </router-link>

      <div class="inline-flex items-center space-x-5" v-if="authUser">
        <router-link to="/user">{{ authUser.username }}</router-link>
        <div class="flex space-x-2">
          <img
            class="w-10 h-10 flex-none w-18 h-18 rounded-lg object-cover bg-gray-100"
            src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
            alt="avatar"
          />
          <Dropdown title="Параметры" :items="options" />
        </div>
        <Logout />
      </div>

      <router-link
        v-else
        to="/login"
        class="inline-flex items-center space-x-2"
      >
        <span>Вход</span>
        <LoginIcon class="w-6 h-6 text-white" />
      </router-link>
    </nav>
  </header>
</template>

<script>
import { mapGetters } from "vuex";
import Logout from "@/components/Logout";
import HomeIcon from "@/components/icons/HomeIcon";
import LoginIcon from "@/components/icons/LoginIcon";
import Dropdown from "@/components/userProfile/Dropdown";

export default {
  name: "Header",
  data() {
    return {
      options: [
        {
          title: "Настройки аккаунта",
          link: "#",
        },
        {
          title: "Служба поддержки",
          link: "#",
        },
      ],
    };
  },
  components: {
    Logout,
    HomeIcon,
    LoginIcon,
    Dropdown,
  },
  computed: {
    ...mapGetters("auth", ["authUser", "isAdmin"]),
  },
};
</script>

<style scoped>
.menu-item {
  position: relative;
  border-bottom: 3px solid transparent;
  transition: 0.4s;
}

.menu-item.active,
.sub-menu.active,
.menu-item:hover {
  background-color: rgb(70, 163, 127);
  border-bottom-color: #fff;
}

.menu-item a {
  color: inherit;
  text-decoration: none;
}
</style>
