<template>
  <form @submit.prevent="login">
    <BaseInput
      type="email"
      label="E-mail"
      name="email"
      v-model="email"
      autocomplete="email"
      placeholder="user@plantmanager.ru"
      class="mb-2"
    />
    <BaseInput
      type="password"
      label="Пароль"
      name="password"
      v-model="password"
      class="mb-4"
    />
    <div class="flex justify-between">
      <BaseBtn type="submit" text="Войти" />
      <router-link to="/forgot-password" class="text-sm base-link">
        Забыли ваш пароль?
      </router-link>
    </div>
    <FlashMessage :error="error" />
  </form>
</template>

<script>
import { getError } from "@/utils/helpers";
import BaseBtn from "@/components/BaseBtn";
import BaseInput from "@/components/BaseInput";
import AuthService from "@/services/AuthService";
import FlashMessage from "@/components/FlashMessage";

export default {
  name: "LoginView",
  components: {
    BaseBtn,
    BaseInput,
    FlashMessage,
  },
  data() {
    return {
      email: null,
      password: null,
      error: null,
    };
  },
  methods: {
    async login() {
      const payload = {
        email: this.email,
        password: this.password,
      };
      this.error = null;
      try {
        await AuthService.login(payload);
        const authUser = await this.$store.dispatch("auth/getAuthUser");
        if (authUser) {
          this.$store.dispatch("auth/setGuest", { value: "isNotGuest" });
          this.$router.push("/dashboard");
        } else {
          const error = Error(
            "Unable to fetch user after login, check your API settings."
          );
          error.name = "Fetch User";
          throw error;
        }
      } catch (error) {
        this.error = getError(error);
      }
    },
  },
};
</script>
