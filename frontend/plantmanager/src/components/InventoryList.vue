<template>
	<div class="inventory-list wrapper">
		<h1>Инвентарий пользователя {{ user }} </h1>
		<tabs>
			<tab name="Seeds" :selected="true">
				<h1>Семена</h1>
				<p>Какой-то контент</p>
			</tab>
			<tab name="Seedling">
				<h1>Рассады</h1>
			</tab>
			<tab name="Fertilizers">
				<h1>Удобрения</h1>
			</tab>
		</tabs>
	</div>
</template>

<script>

import Tab from './Tab.vue'
import Tabs from './Tabs.vue'

export default {
  components: {
    Tab,
    Tabs
  },
  props: {
    msg: String
  },

  data() {
        
        return {
            user: 'User1'
        };
        
    },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.wrapper {
    width: 100%;
    min-height: 100vh;
    background-color: #f8f8f8;
    margin: 0;
    padding: 20px;
  }
</style>
