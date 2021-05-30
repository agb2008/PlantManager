<template>
  <form @submit.prevent="registerUser">
    <BaseInput
        type="text"
        label="Фамилия"
        name="lastname"
        v-model="lastname"
        placeholder="Фамилия"
        class="mb-2"
    />
    <BaseInput
        type="text"
        label="Имя"
        name="name"
        v-model="name"
        placeholder="Имя"
        class="mb-2"
    />
    <BaseInput
      type="text"
      label="Отчество"
      name="midname"
      v-model="midname"
      placeholder="Отчество (опционально)"
      class="mb-2"
    />
    <BaseInput
      type="email"
      label="E-mail"
      name="email"
      v-model="email"
      placeholder="e-mail@plantmanager.ru"
      class="mb-2"
    />
    <BaseInput
        type="text"
        label="Имя пользователя"
        name="username"
        v-model="username"
        placeholder="Имя пользователя"
        class="mb-2"
    />
    <BaseInput
      type="password"
      label="Пароль"
      name="password"
      v-model="password"
      class="mb-2"
    />
    <BaseInput
      type="password"
      label="Подтвердите пароль"
      name="password-confirm"
      v-model="passwordConfirm"
      class="mb-4"
    />
    <BaseBtn type="submit" text="Зарегистрироваться" />
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
  name: "RegisterForm",
  components: {
    BaseBtn,
    BaseInput,
    FlashMessage,
  },
  data() {
    return {
      lastname: null,
      name: null,
      midname: null,
      email: null,
      username: null,
      password: null,
      passwordConfirm: null,
      error: null,
    };
  },
  methods: {
    registerUser() {
      this.error = null;
      const payload = {
        lastname: this.lastname,
        name: this.name,
        midname: this.midname,
        email: this.email,
        username: this.username,
        password: this.password,
        password_confirmation: this.passwordConfirm,
      };
      AuthService.registerUser(payload)
        .then(() => this.$router.push("/dashboard"))
        .catch((error) => (this.error = getError(error)));
    },
  },
};
</script>
