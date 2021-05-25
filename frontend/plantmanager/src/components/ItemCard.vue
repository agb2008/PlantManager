<template>
	<div class="card">
		<div class="card__header">{{ items.name }}</div>
		
		<p class="card__date">{{ items.prodDate }}</p>
		<p class="card__date">{{ items.expirDate }}</p>
		<p class="card__date">{{ items.harvestYear }}</p>
		<p class="card__numbers">Всего семян:{{ items.numberOfSeeds }}шт</p>
	</div>
</template>

<script>


export default {
components: {
    
},

props: {
	items: Object,
},

}
</script>

<style>

</style>