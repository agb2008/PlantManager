<template>
  <div class="flex m-10 justify-center font-bold">
    <ul>
      <li class="text-lg pb-4">
        <router-link to="/inventory" exact>Инвентарный список</router-link>
      </li>
      <li class="text-lg pb-4">
        <router-link to="/seedling">Рассада</router-link>
      </li>
      <li class="text-lg pb-4">
        <router-link to="/garden">Грядки</router-link>
      </li>
      <li class="text-lg pb-4">
        <router-link to="/stats">Статистика</router-link>
      </li>
    </ul>
  </div>
</template>
