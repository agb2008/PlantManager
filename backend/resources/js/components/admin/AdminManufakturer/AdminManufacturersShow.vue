<template>
    <div>
        <h3>Просмотр - {{this.manufacturer.name}}</h3>
        <table>
            <thead>
            <tr>
                <th>Id</th>
                <th>Название</th>
                <th>Адрес</th>
                <th>Email</th>
                <th>Телефон</th>
                <th>Сайт</th>
                <th>Описани</th>
                <th>Создано</th>
                <th>Обновлено</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{this.manufacturer.id}}</td>
                <td>{{this.manufacturer.name}}</td>
                <td>{{this.manufacturer.address}}</td>
                <td>{{this.manufacturer.email}}</td>
                <td>{{this.manufacturer.phone}}</td>
                <td>{{this.manufacturer.website}}</td>
                <td>{{this.manufacturer.notes}}</td>
                <td>{{this.manufacturer.created_at}}</td>
                <td>{{this.manufacturer.updated_at}}</td>
            </tr>
            </tbody>
        </table>
        <hr>
        <router-link :to="{ name: 'adminManufacturersEdit', params: this.manufacturer.id }">Edit</router-link>
        <button class="btn btn-danger" @click.prevent="onDelete">Delete</button>
    </div>
</template>

<script>
import api from '../../../api/routes';

export default {
    data() {
        return {
            manufacturer: {
                id: "",
                name: "",
                address: "",
                email: "",
                phone: "",
                website: "",
                notes: "",
                created_at: "",
                updated_at: ""
            }
        };
    },
    created() {
        api.find('manufacturers', this.$route.params.id)
            .then((response) => {
                this.manufacturer = response.data;
            });
    },
    methods: {
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
