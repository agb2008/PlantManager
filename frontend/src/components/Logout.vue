<template>
  <button
    type="button"
    @click="logout"
    class="inline-flex items-center space-x-2"
  >
    <span class="hidden font-bold sm:inline">Выход</span>
    <LogoutIcon class="w-6 h-6 text-white" />
  </button>
</template>

<script>
import LogoutIcon from "@/components/icons/LogoutIcon";
export default {
  components: { LogoutIcon },
  name: "Logout",
  methods: {
    logout() {
      this.$store.dispatch("auth/logout");
    },
  },
};
</script>
