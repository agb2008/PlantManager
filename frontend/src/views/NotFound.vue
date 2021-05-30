<template>
  <div class="max-w-lg p-5 m-auto">
    <article class="p-5">
      <h1
        class="mb-2 text-6xl font-bold text-transparent bg-gradient-to-r bg-clip-text from-green-300 to-green-700 text-center"
      >
        4O4
      </h1>
      <p class="font-bold text-center">
        Такой страницы здесь нет.
        <router-link to="/dashboard" class="base-link">Вернуться на домашнюю страницу</router-link>.
      </p>
    </article>
  </div>
</template>

<script>
export default {
  name: "NotFound",
};
</script>
