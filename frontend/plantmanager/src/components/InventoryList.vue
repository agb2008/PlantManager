<template>
<div>
	<h1 class="text-3xl">Инвентарь пользователя {{ user }} </h1>
	<div class="inventory flex flex-wrap p-4 mx-auto lg:mt-24">
		<!-- Семена -->
		<div class="seeds w-auto" style="width: 33.3333%;">	
			<div class="rounded-md bg-gray-100 pt-4 m-2 overflow-hidden">
				<h2 class="px-3 py-2 mx-3 mb-2 font-bold text-gray-800 bg-gray-200 rounded-md">Семена</h2>
				<ul class="">
					<li v-for="plantType in seedsData.typePlant" :key="plantType.id"
					@click="seedsPlantTypeSelect(plantType.id)"
					class="px-3 py-2 text-gray-700 border-gray-300 cursor-pointer hover:bg-gray-200 hover:text-gray-900"
					:class="{ 'bg-gray-200': selectedPlantOfSeeds === plantType.id }"
					:title="plantType.notes">
						<h3 class="">{{ plantType.name }}</h3>
						<ul :class="{ active: selectedPlantOfSeeds === plantType.id }"
						v-if="selectedPlantOfSeeds === plantType.id"
						class="bg-gray-100">
							<li v-for="seeds in seedsOfType" :key="seeds.id"
							@click.stop="seedItemSelect(seeds.id)"
							class="">
								<div class="flex justify-between items-center px-3 py-2 text-gray-700 border-gray-400 cursor-pointer hover:bg-gray-200 hover:text-gray-900"
								:class="{ 'bg-gray-300 hover:bg-gray-300 hover:text-gray-900': selectedSeedPack === seeds.id }">
									<h4 class=" font-mono text-sm">{{ seeds.name }}</h4>								
									
										
										<div class="items-center px-1 py-0.5 rounded bg-gray-50">Всего семян:{{ seeds.numberOfSeeds * seeds.amount }}</div>
										
									
								</div>
								
								<div v-if="selectedSeedPack === seeds.id">
									<SeedPackCard
									:seedPack="seeds"
									:family="seedsFamilyOfType"
									:species="seedsSpeciesOfType"
									:manufacturer="seedsManufacturerOfType"
									:changeAmount="changingSeedPack"
									></SeedPackCard>
								</div>
							</li>
						</ul>					
					</li>
					<li>
						<NewPlantForm
						:newData="addNewSeedsPack"
						:plantTypeList="seedsData.plantTypeList"
						></NewPlantForm>
					</li>
				</ul>
			</div>
		</div>
		<!-- Рассада -->
		<div class="seedling w-auto" style="width: 33.3333%;">
			<div class="rounded-md bg-gray-100 pt-4 m-2 overflow-hidden">
				<h2 class="px-3 py-2 mx-3 mb-2 font-bold text-gray-800 bg-gray-200 rounded-md">Рассада</h2>
				<ul>
					<li v-for="plantType in seedlingData.typePlant" :key="plantType.id"
					@click="seedlingPlantTypeSelect(plantType.id)"
					class="px-3 py-2 text-gray-700 border-gray-300 cursor-pointer hover:bg-gray-200 hover:text-gray-900"
					:class="{ 'bg-gray-200': selectedPlantOfSeedlings === plantType.id }"
					:title="plantType.notes">
						<h3 class="">{{ plantType.name }}</h3>

						<ul :class="{ active: selectedPlantOfSeedlings === plantType.id }"
						v-if="selectedPlantOfSeedlings === plantType.id"
						class="bg-gray-100">
							<li v-for="seedling in seedlingsOfType" :key="seedling.id"
							@click.stop="seedlingItemSelect(seedling.id)"
							class="">
								<div class="flex justify-between items-center px-3 py-2 text-gray-700 border-gray-400 cursor-pointer hover:bg-gray-200 hover:text-gray-900"
								:class="{ 'bg-gray-300 hover:bg-gray-300 hover:text-gray-900': selectedSeedlingItem === seedling.id }">
									<h4 class=" font-mono text-sm">{{ seedling.name }}</h4>								
									<div class="items-center px-1 py-0.5 rounded bg-gray-50">Всего саженцев:{{  seedling.amount }}</div>
								</div>
								<div v-if="selectedSeedlingItem === seedling.id">
									<SeedlingCard
									:seedling="seedling"
									:family="seedlingFamilyOfType"
									:species="seedlingSpeciesOfType"
									:manufacturer="seedlingManufacturerOfType"
									:changeAmount="changingSeedling">

									</SeedlingCard>
								</div>
							</li>
						</ul>
					</li>
					<li>
						<NewPlantForm
						:newData="addNewSeedsPack"
						:plantTypeList="seedsData.plantTypeList"
						></NewPlantForm>
					</li>
				</ul>
			</div>
		</div>
</div>
</div>

</template>

<script>
import SeedPackCard from './SeedPackCard.vue'
import SeedlingCard from './SeedlingCard.vue'
import NewPlantForm from './NewPlantForm.vue'
 
export default {
  components: {
	SeedPackCard,
	NewPlantForm,
	SeedlingCard
  },

	props: {
		user: { String, required: true },
		// seeds: Object,
		seedling: Object,
	},

	data() {
		return {
			plantType: [],
			seedsData: { 
				seeds: [
					{'id': 1, 'name': 'carrot', 'typePlant': 5, 'numberOfSeeds': 100, 'amount': 2, 'price': 100, 'manufacturerId': 1, 'prodDate': '2020.03.11', 'expirDate': '2020.03.12', 'harvestYear': '2020.02.12'},
					{'id': 2, 'name': 'carrotca', 'typePlant': 5, 'numberOfSeeds': 50, 'amount': 5, 'price': 100, 'manufacturerId': 3, 'prodDate': '2020.03.11', 'expirDate': '2020.03.12', 'harvestYear': '2020.02.12'},
					{'id': 3, 'name': 'tomato', 'typePlant': 8, 'numberOfSeeds': 99, 'amount': 3, 'price': 100, 'manufacturerId': 2, 'prodDate': '2020.03.11', 'expirDate': '2020.03.12', 'harvestYear': '2020.02.12'}
				],
				typePlant: [
					{'id': 5, 'name': 'морковь', 'familyId': 1, 'speciesId': 1, 'notes': 'морковь однолетнее растение'},
					{'id': 8, 'name': 'свекла', 'familyId': 2, 'speciesId': 2, 'notes': 'свекла mоднолетнее растение'},
				],
				plantTypeList: [
					{'id': 5, 'name': 'морковь', 'familyId': 1, 'speciesId': 1, 'notes': 'морковь однолетнее растение'},
					{'id': 8, 'name': 'свекла', 'familyId': 2, 'speciesId': 2, 'notes': 'свекла mоднолетнее растение'},
				],
				manufacturer: [
					{ 'id': 1, 'name': 'агроФ', 'address': 'lorem ipsum', 'email': 'lorem ipsum@lorem', 'phone': '2384238', 'website': 'lorem ipsum', 'notes': 'бла бла бла бла' },
					{ 'id': 2, 'name': 'агроE', 'address': 'lorem ipsum', 'email': 'lorem ipsum@lorem', 'phone': '2384238', 'website': 'lorem ipsum', 'notes': 'бла бла бла бла' },
					{ 'id': 3, 'name': 'агроS', 'address': 'lorem ipsum', 'email': 'lorem ipsum@lorem', 'phone': '2384238', 'website': 'lorem ipsum', 'notes': 'бла бла бла бла' }
				],
				family: [
					{'id': 1, 'name': 'однолетнее', 'notes': ' однолетнее растение'},
					{'id': 2, 'name': 'многолетнее', 'notes': ' mоднолетнее растение'},
				],
				species: [
					{'id': 1, 'name': 'морковные', 'notes': 'семейство морковные'},
					{'id': 2, 'name': 'свекловные', 'notes': 'семейство свекловные'},
				]
			},

			seedlingData: {
				seedling: [
					{'id': 1, 'name': 'corn', 'typePlant': 1, 'amount': 2, 'price': 100, 'manufacturerId': 1, 'purchaseDate': '2020.03.11', 'plantDate': '2020.03.12', 'harvestYear': '2020.02.12'},
					{'id': 2, 'name': 'cornotca', 'typePlant': 1, 'amount': 5, 'price': 100, 'manufacturerId': 3, 'purchaseDate': '2020.03.11', 'plantDate': '2020.03.12', 'harvestYear': '2020.02.12'},
					{'id': 3, 'name': 'cyber cucumber', 'typePlant': 2, 'amount': 3, 'price': 100, 'manufacturerId': 2, 'purchaseDate': '2020.03.11', 'plantDate': '2020.03.12', 'harvestYear': '2020.02.12'}
				],
				typePlant: [
					{'id': 1, 'name': 'кукуруза', 'familyId': 1, 'speciesId': 3, 'notes': 'кукуруза однолетнее растение'},
					{'id': 2, 'name': 'огурец', 'familyId': 2, 'speciesId': 4, 'notes': 'огурец mоднолетнее растение'},
				],
				manufacturer: [
					{ 'id': 1, 'name': 'агроФ', 'address': 'lorem ipsum', 'email': 'lorem ipsum@lorem', 'phone': '2384238', 'website': 'lorem ipsum', 'notes': 'бла бла бла бла' },
					{ 'id': 2, 'name': 'агроE', 'address': 'lorem ipsum', 'email': 'lorem ipsum@lorem', 'phone': '2384238', 'website': 'lorem ipsum', 'notes': 'бла бла бла бла' },
					{ 'id': 3, 'name': 'агроS', 'address': 'lorem ipsum', 'email': 'lorem ipsum@lorem', 'phone': '2384238', 'website': 'lorem ipsum', 'notes': 'бла бла бла бла' }
				],
				family: [
					{'id': 1, 'name': 'однолетнее', 'notes': ' однолетнее растение'},
					{'id': 2, 'name': 'многолетнее', 'notes': ' mоднолетнее растение'},
				],
				species: [
					{'id': 3, 'name': 'кукурузновые', 'notes': 'семейство кукурузновые'},
					{'id': 4, 'name': 'огурецовые', 'notes': 'семейство огурецовые'},
				]
			},
			
			selectedPlantOfSeeds: null,
			selectedPlantOfSeedlings: null,
			selectedSeedPack: null,
			selectedSeedlingItem: null,
			addSeedsFormShow: false,
			response: true,

		};
	},

	methods: {
		// методы управления выпадающим списком
		seedsPlantTypeSelect(itemId) {
			this.selectedPlantOfSeeds = this.selectedPlantOfSeeds === itemId ? null : itemId;
		},
		seedItemSelect(itemId) {
			this.selectedSeedPack = this.selectedSeedPack === itemId ? null : itemId;
		},
		seedlingPlantTypeSelect(itemId) {
			this.selectedPlantOfSeedlings = this.selectedPlantOfSeedlings === itemId ? null : itemId;
		},
		seedlingItemSelect(itemId) {
			this.selectedSeedlingItem = this.selectedSeedlingItem === itemId ? null : itemId;
		},
		// методы изменения данных
		addNewSeedsPack(newPack) {
			if(this.response) {
				this.seedsData.seeds.push(newPack);
				window.console.log(newPack);
			}
		},
		changingSeedPack(item) {
			let seedPackInd = this.seedsData.seeds.findIndex( seedPack => seedPack.id === item.id);
			if(seedPackInd != -1) {
				if(item.amount <= 0) {
					if(this.response) {
						this.seedsData.seeds.splice(seedPackInd,1);
						window.console.log(this.seedsData.seeds[seedPackInd]);
					}
					
				} else {
					if(this.response) {
						this.seedsData.seeds.splice(seedPackInd,1,item);
						window.console.log(this.seedsData.seeds[seedPackInd]);
					}
				}	
			}
		},

		changingSeedling(item) {
			let seedlingInd = this.seedlingData.seedling.findIndex( seedling => seedling.id === item.id);			
			if(seedlingInd != -1) {
				if(item.amount <= 0) {
					if(this.response) {
						this.seedlingData.seedling.splice(seedlingInd,1);
					}					
				} else {
					if(this.response) {
						this.seedlingData.seedling.splice(seedlingInd,1,item);
					}
				}	
			}
		}

	},

	computed: {
		seedsOfType() {
			return this.seedsData.seeds.filter( item => item.typePlant === this.selectedPlantOfSeeds);
		},
		seedlingsOfType() {
			return this.seedlingData.seedling.filter( item => item.typePlant === this.selectedPlantOfSeedlings);
		},

		seedsFamilyOfType() {
			let familyId = this.seedsData.typePlant.find( item => item.id === this.selectedPlantOfSeeds).familyId;
			return this.seedsData.family.find( item => item.id === familyId);
		},
		seedlingFamilyOfType() {
			let familyId = this.seedlingData.typePlant.find( item => item.id === this.selectedPlantOfSeedlings).familyId;
			return this.seedlingData.family.find( item => item.id === familyId);
		},

		seedsSpeciesOfType() {
			let speciesId = this.seedsData.typePlant.find( item => item.id === this.selectedPlantOfSeeds).speciesId;
			return this.seedsData.species.find( item => item.id === speciesId);
		},
		seedlingSpeciesOfType() {
			let speciesId = this.seedlingData.typePlant.find( item => item.id === this.selectedPlantOfSeedlings).speciesId;
			return this.seedlingData.species.find( item => item.id === speciesId);
		},

		seedsManufacturerOfType() {
			let manufacturerId = this.seedsData.seeds.find( item => item.id === this.selectedSeedPack).manufacturerId;
			return this.seedsData.manufacturer.find( item => item.id === manufacturerId);
		},
		seedlingManufacturerOfType() {
			let manufacturerId = this.seedlingData.seedling.find( item => item.id === this.selectedSeedlingItem).manufacturerId;
			return this.seedlingData.manufacturer.find( item => item.id === manufacturerId);
		},
	},
}
</script>

<style>

</style>