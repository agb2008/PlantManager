<template>
  <div class="inventory flex flex-wrap p-4 mx-auto lg:mt-24">
	<div id="modal_overlay" class="absolute inset-0 bg-black bg-opacity-30 h-screen w-full flex justify-center items-start md:items-center pt-10 md:pt-0"
	:class="{ hidden: modalOpen }">
		<div id="modal" class="pacity-0 transform -translate-y-full scale-150  relative w-10/12 md:w-1/2 h-1/2 md:h-3/4 bg-white rounded shadow-lg transition-opacity transition-transform duration-300">

    <!-- button close -->
			<button 
			@click="addSeedsFormShow = false"
			class="absolute -top-3 -right-3 bg-red-500 hover:bg-red-600 text-2xl w-10 h-10 rounded-full focus:outline-none text-white">
			&cross;
			</button>

			<!-- header -->
			<div class="px-4 py-3 border-b border-gray-200">
			<h2 class="text-xl font-semibold text-gray-600">Title</h2>
			</div>

			<!-- body -->
			<div class="w-full p-3">
			Lorem ipsum, dolor sit amet consectetur adipisicing elit. Asperiores, quis tempora! Similique, explicabo quaerat maxime corrupti tenetur blanditiis voluptas molestias totam? Quaerat laboriosam suscipit repellat aliquam blanditiis eum quos nihil.
			</div>

			<!-- footer -->
			<div class="absolute bottom-0 left-0 px-4 py-3 border-t border-gray-200 w-full flex justify-end items-center gap-3">
			<button class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white focus:outline-none">Save</button>
			<button 
				@click="addSeedsFormShow = false"
				class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white focus:outline-none"
			>Close</button>
			</div>
		</div>
	</div>
    <h1 class="text-3xl">Инвентарий пользователя {{ user }} </h1>
	<div class="w-auto" style="width: 33.3333%;">	
		<div class="seeds rounded-md bg-gray-100 pt-4 m-2 overflow-hidden">
			<h2 class="px-3 py-2 mx-3 mb-2 font-bold text-gray-800 bg-gray-200 rounded-md">Семена</h2>
			<ul class="">
				<li v-for="plantType in seedItems.typeId" :key="plantType.id"
				@click="plantTypeSelect(plantType.id)"
				class="px-3 py-2 text-gray-700 border-gray-300 cursor-pointer hover:bg-gray-200 hover:text-gray-900"
				:class="{ 'bg-gray-200': selectedPlant === plantType.id }">
					<h3 class="">{{ plantType.name }}</h3>
					<ul :class="{ active: selectedPlant === plantType.id }"
					v-if="selectedPlant === plantType.id"
					class="bg-gray-100">
						<li v-for="seeds in seedsOfType" :key="seeds.id"
						@click.stop="seedItemSelect(seeds.id)"
						class="">
							<div class="flex justify-between items-center px-3 py-2 text-gray-700 border-gray-400 cursor-pointer hover:bg-gray-200 hover:text-gray-900"
							:class="{ 'bg-gray-300 hover:bg-gray-300 hover:text-gray-900': selectedSeedPack === seeds.id }">
								<h4 class=" font-mono text-sm">{{ seeds.name }}</h4>								
								<div class="flex">
									<button class=" px-1 py-0.5 rounded bg-gray-50 border border-green-600 text-green-600 shadow-sm hover:shadow-lg">-1</button>
									<button class=" px-1 py-0.5 rounded bg-gray-50 border border-green-600 text-green-600  shadow-sm hover:shadow-lg">-10</button>
									<div class="items-center px-1 py-0.5 rounded bg-gray-50 border border-green-600 cursor-text">{{ seeds.amount }}</div>
									<button class=" px-1 py-0.5 rounded bg-gray-50 border border-green-600 text-green-600  shadow-sm hover:shadow-lg">+10</button>
									<button class=" px-1 py-0.5 rounded bg-gray-50 border border-green-600 text-green-600 shadow-sm hover:shadow-lg">+1</button>
								</div>
							</div>
							
							<div v-if="selectedSeedPack === seeds.id">
								<ItemCard
								:items="seeds"></ItemCard>
							</div>
						</li>
					</ul>					
				</li>
				<li>
					<NewPlantForm
					:newData="addNewSeedsPack"
					:plantTypeList="seedItems.plantTypeList"></NewPlantForm>
				</li>
			</ul>
		</div>
	</div>
	
  </div>
</template>

<script>
import ItemCard from './ItemCard.vue'
import NewPlantForm from './NewPlantForm.vue'
 
export default {
  components: {
	ItemCard,
	NewPlantForm,
  },

	props: {
		user: { String, required: true },
		// seeds: Object,
		seedling: Object,
	},

	data() {
		return {
			plantType: [],
			seedItems: { 
				seeds: [
					{'id': 1, 'name': 'carrot', 'typeId': 5, 'numberOfSeeds': 100, 'amount': 2, 'prodDate': '2020.03.11', 'expirDate': '2020.03.12', 'harvestYear': '2020.02.12'},
					{'id': 2, 'name': 'carrotca', 'typeId': 5, 'numberOfSeeds': 50, 'amount': 5, 'prodDate': '2020.03.11', 'expirDate': '2020.03.12', 'harvestYear': '2020.02.12'},
					{'id': 3, 'name': 'tomato', 'typeId': 8, 'numberOfSeeds': 99, 'amount': 3, 'prodDate': '2020.03.11', 'expirDate': '2020.03.12', 'harvestYear': '2020.02.12'}
				],
				typeId: [
					{'id': 5, 'name': 'морковь', 'notes': 'морковь однолетнее растение'},
					{'id': 8, 'name': 'свекла', 'notes': 'свекла mоднолетнее растение'},
				],
				plantTypeList: [
					{'id': 5, 'name': 'морковь', 'notes': 'морковь однолетнее растение'},
					{'id': 8, 'name': 'свекла', 'notes': 'свекла mоднолетнее растение'},
				],
				manufacturer: [

				],
				family: [

				]
				},
			selectedPlant: null,
			selectedSeedPack: null,
			addSeedsFormShow: false,
			response: true,

		};
	},

	methods: {
		plantTypeSelect(itemId) {
			this.selectedPlant = this.selectedPlant === itemId ? null : itemId;
		},
		seedItemSelect(itemId) {
			this.selectedSeedPack = this.selectedSeedPack === itemId ? null : itemId;
		},

		addNewSeedsPack(newPack) {
			if(this.response) {
				this.seedItems.seeds.push(newPack);
				window.console.log(newPack);
			}
		}
	},

	computed: {
		seedsOfType() {
			return this.seedItems.seeds.filter( item => item.typeId === this.selectedPlant);
		},

		familyOfType() {
			return this.seedItems.family.filter( item => item.typeId === this.selectedPlant);
		},

		modalOpen() {
			return !this.addSeedsFormShow;
		}
	},
}
</script>

<style>

</style>