<template>
    <div>
        <h3>Create</h3>
        <form @submit.prevent="onSubmit">
            <div>
                <label for="man_name">Name</label>
                <input id="man_name" v-model="manufacturer.name" class="border"/>
            </div>
            <div>
                <label for="man_address">Address</label>
                <input id="man_address" v-model="manufacturer.address" class="border"/>
            </div>
            <div>
                <label for="man_email">Email</label>
                <input id="man_email" v-model="manufacturer.email" class="border"/>
            </div>
            <div>
                <label for="man_phone">Tel</label>
                <input id="man_phone" v-model="manufacturer.phone" class="border"/>
            </div>
            <div>
                <label for="man_website">Website</label>
                <input id="man_website" v-model="manufacturer.website" class="border"/>
            </div>
            <div>
                <label for="man_notes">Notes</label>
                <textarea name="" id="man_notes" cols="30" rows="10" v-model="manufacturer.notes"class="border"></textarea>
            </div>

            <div>
                <button type="submit">Save</button>
            </div>
        </form>
    </div>

</template>

<script>
import api from '../../../api/routes';
export default {
    data() {
        return {
            manufacturer: {
                name: '',
                address: '',
                email: '',
                phone: '',
                website: '',
                notes: ''
            }
        }
    },
    methods: {
        onSubmit() {
            console.log(this.manufacturer);
            api.create('manufacturers', this.manufacturer)
                .then((response) => {
                    this.$router.push({ name: 'adminManufacturers'});
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

</style>
