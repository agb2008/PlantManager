<template>
  <div class="flex p-4 h-full justify-start text-red-800 font-bold">
    <ul>
      <li class="link px-4 py-2 rounded-md text-base">
        <router-link to="/inventory" exact>Инвентарный список</router-link>
      </li>
      <li class="link px-4 py-2 rounded-md text-base">
        <router-link to="/seedling">Рассада</router-link>
      </li>
      <li class="link px-4 py-2 rounded-md text-base">
        <router-link to="/garden">Грядки</router-link>
      </li>
      <li class="link px-4 py-2 rounded-md text-base">
        <router-link to="/stats">Статистика</router-link>
      </li>
    </ul>
  </div>
</template>

<style scoped>
.link.active, .link:hover {
  background-color: #FFF9D0;
  border-bottom-color: #003e12;
}

.link {
  position: relative;
  border-bottom: 3px solid transparent;
  transition: 0.4s;
}

</style>
