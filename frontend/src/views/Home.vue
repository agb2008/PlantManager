<template>
  <div class="max-w-lg p-5 m-auto">
    <article class="p-5">
      <h1
        class="mb-4 text-6xl font-bold text-transparent bg-gradient-to-r bg-clip-text from-green-300 to-green-700"
      >
        PlantManager
      </h1>
      <p class="font-bold mt-2 text-center">
        Зарегистрироваться можно
        <router-link to="/register" class="base-link">здесь</router-link>.
      </p>
    </article>
    <article class="p-5 mt-5 text-gray-600">
      <p class="text-center">
        Информация о проекте PlantManager доступна на GitHub'е:
        <a href="https://github.com/agb2008/PlantManager" class="base-link"
          >https://github.com/agb2008/PlantManager</a
        >
      </p>
    </article>
  </div>
</template>

<script>
export default {
  name: "Home",
};
</script>
