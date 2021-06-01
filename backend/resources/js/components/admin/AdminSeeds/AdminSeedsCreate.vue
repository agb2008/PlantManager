<template>
    <form @submit.prevent="onSubmit">
        <div>
            <label for="seed_name">Name</label>
            <input id="seed_name" v-model="seed.name" class="border"/>
        </div>
        <div>
            <label for="seed_number">Seeds number</label>
            <input id="seed_number" v-model="seed.number_of_seeds" class="border"/>
        </div>
        <div>
            <label for="seed_amount">Amount</label>
            <input id="seed_amount" v-model="seed.amount" class="border"/>
        </div>
        <div>
            <label for="seed_production_date">Prod date</label>
            <input id="seed_production_date" v-model="seed.production_date" class="border"/>
        </div>
        <div>
            <label for="seed_expiration_date">Exp date</label>
            <input id="seed_expiration_date" v-model="seed.expiration_date" class="border"/>
        </div>
        <div>
            <label for="seed_harvest_year">Year</label>
            <input id="seed_harvest_year" v-model="seed.harvest_year" class="border"/>
        </div>
        <div>
            <label for="seed_notes">Notes</label>
            <input id="seed_notes" v-model="seed.notes" class="border"/>
        </div>
        <div>
            <label for="seed_price">Price</label>
            <input id="seed_price" v-model="seed.price" class="border"/>
        </div>
        <div>
            <label for="seed_manufacturer">Manufacturer</label>
            <input id="seed_manufacturer" v-model="seed.manufacturer_id" class="border"/>
        </div>
        <div>
            <label for="seed_type">Type</label>
            <input id="seed_type" v-model="seed.type_id" class="border"/>
        </div>
        <div>
            <button type="submit">Save</button>
        </div>
    </form>
</template>

<script>
import api from '../../../api/routes';

export default {
    data() {
        return {
            seed: {
                name: '',
                number_of_seeds: '',
                amount: '',
                production_date: '',
                expiration_date: '',
                harvest_year: '',
                notes: '',
                price: '',
                type_id: '',
                manufacturer_id: ''
            }
        }
    },
    methods: {
        onSubmit() {
            console.log(this.seed);
            api.create('seeds', this.seed)
                .then((response) => {
                    this.$router.push({ name: 'adminSeedEdit', params: { id: response.data.id } });
                })
                .catch((e) => {
                    this.message = e.response.data.message || 'There was an issue creating the seed.';
                })
                .then(() => this.saving = false)
        }
    }
}
</script>
<style scoped>
.border {
    border: 1px solid #6cb2eb;
}
</style>
