<template>
<table>
    <thead>
        <tr>
            <th>id</th>
            <th>Name</th>
            <th>Numbers of seed</th>
            <th>Amount</th>
            <th>Type id</th>
            <th>Manufacturer id</th>
            <th>production_date</th>
            <th>expiration_date</th>
            <th>harvest_year</th>
            <th>notes</th>
            <th>price</th>
            <th>img_id</th>
            <th>created_at</th>
            <th>updated_at</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="item in seed">
            <td>{{ item.name }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>
</template>

<script>
import api from "../../../api/routes";

export default {
    data() {
        return {
            seed: "",
        };
    },
    created() {
        api.find(this.$route.params.id).then((response) => {
                setTimeout(() => {
                    this.loaded = true;
                    this.seed = response.data;
                    console.log(this.seed);
                }, 1000);
        });
    },
    methods: {

        }

}


</script>

<style scoped>

</style>
