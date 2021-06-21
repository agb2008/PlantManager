<template>
  <form @submit.prevent="updateUser">
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
      type="text"
      label="Имя пользователя"
      name="username"
      v-model="username"
      placeholder="Имя пользователя"
      class="mb-2"
    />
    <BaseInput
      type="email"
      label="E-mail"
      name="email"
      v-model="email"
      autocomplete="email"
      placeholder="email@plantmanager.ru"
      class="mb-4"
    />
    <BaseBtn type="submit" text="Обновить" />
    <FlashMessage :message="message" :error="error" />
  </form>
</template>

<script>
import { mapGetters } from "vuex";
import { getError } from "@/utils/helpers";
import BaseBtn from "@/components/BaseBtn";
import BaseInput from "@/components/BaseInput";
import AuthService from "@/services/AuthService";
import FlashMessage from "@/components/FlashMessage";

export default {
  name: "AuthUserForm",
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
      username: null,
      email: null,
      error: null,
      message: null,
    };
  },
  computed: {
    ...mapGetters("auth", ["authUser"]),
  },
  methods: {
    updateUser() {
      this.error = null;
      this.message = null;
      const payload = {
        lastname: this.lastname,
        name: this.name,
        midname: this.midname,
        username: this.username,
        email: this.email,
      };
      AuthService.updateUser(payload)
        .then(() => this.$store.dispatch("auth/getAuthUser"))
        .then(() => (this.message = "Данные пользователя обновлены."))
        .catch((error) => (this.error = getError(error)));
    },
  },
  mounted() {
    this.lastname = this.authUser.lastname;
    this.name = this.authUser.name;
    this.midname = this.authUser.midname;
    this.email = this.authUser.email;
    this.username = this.authUser.username;
  },
};
</script>
