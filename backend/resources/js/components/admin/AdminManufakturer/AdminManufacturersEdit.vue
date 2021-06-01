<template>
    <div>
        <h3>Редактирование - {{ manufacturer.name }}</h3>
        <div v-if="message" class="alert">{{ message }}</div>
        <div v-if="! loaded">Loading...</div>
        <form @submit.prevent="onSubmit($event)" v-else>
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
                <textarea id="man_notes" cols="30" rows="10" v-model="manufacturer.notes"class="border">{{ manufacturer.notes }}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" :disabled="saving">Сохранить</button>
            </div>
            <div>
                <button class="btn btn-danger" @click.prevent="onDelete">Удалить</button>
            </div>
        </form>
    </div>

</template>

<script>
import api from '../../../api/routes';
export default {
    data() {
        return {
            message: null,
            loaded: false,
            saving: false,
            manufacturer: {
                id: null,
                name: "",
                address: "",
                email: "",
                phone: "",
                website: "",
                notes: ""
            }
        }
    },
    created() {
        api.find('manufacturers', this.$route.params.id).then((response) => {
            setTimeout(() => {
                this.loaded = true;
                this.manufacturer = response.data;
            }, 1000);

        })
    },
    methods: {
        onSubmit(event) {
            this.saving = true;

            api.update('manufacturers', this.manufacturer.id, {
                name: this.manufacturer.name,
                address: this.manufacturer.address,
                email: this.manufacturer.email,
                phone: this.manufacturer.phone,
                website: this.manufacturer.website,
                notes: this.manufacturer.notes
            }).then((response) => {
                this.message = 'Обновлено';
                this.manufacturer = response.data;
                this.$router.go(0);
            }).catch(error => {
                console.log(this.manufacturer.id)
            }).then(_ => this.saving = false);
        },
        onDelete() {
            api.delete('manufacturers', this.manufacturer.id)
                .then((response) => {
                    this.$router.push({ name: 'adminManufacturers' });
                });
        }
    }
}
</script>

<style scoped>

</style>
