<template>
    <div>
        <div class="images">
            <input type="hidden" name="_method" value="PUT">
            <a v-for="result in results" :key="result.id" v-if="result.url">
                <img :src="result.url" :alt="result.title" />
                <span @click="fav(result.id, result.user_id)">
                    <i class="material-icons amaranth"
                        v-bind:style="result.user_id ? { color: '#ff7878' } : { color: '#fff' }">favorite</i>
                    <abbr v-if="result.favs">{{ result.favs }}</abbr>
                </span>
            </a>
            <a v-for="result in results" :key="result.id" v-if="result.name">
                {{ result.name }}<br />
                <i class="material-icons amaranth">favorite</i> {{ result.favs }} Likes
            </a>
        </div>
        <paginate v-model="page" :page-count="totalPages" :margin-pages="2" :page-range="5"
            :container-class="'ui pagination menu'" :page-link-class="'item'" :prev-link-class="'item'"
            :next-link-class="'item'" :break-view-link-class="'break-view-link'" :no-li-surround="true"
            :page-class="'page-item'" :click-handler="paginateCallback"></paginate>
    </div>
</template>

<script>
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios)
export default {
    data() {
        return {
            page: 1,
            totalPages: 1,
            results: [],
            userId: null,
            weekday: null,
            weekString: null
        }
    },
    mounted() {
        this.userId = document.querySelector("meta[name='user-id']").getAttribute('content');
        this.weekday = document.querySelector("meta[name='weekday']").getAttribute('content');
        this.weekString = '&weekend=1';

        if (this.weekday) {
            this.weekString = '&weekday=1';
        }
        this.fetchData();
    },
    methods: {

        async fav(imageId, userId) {

            if (!this.userId) {
                alert("User not logged in.");
            }
            else {
                await axios.post("fav", { userId: this.userId, imageId: imageId }).then((response) => {
                    if (!response.data.isLoggedIn) {
                        alert("User not logged in")
                    }
                    else if (response.data.detach) {
                        alert("image removed from favourate list")
                    } else {
                        alert("image added to favourate list")
                    }
                });
                this.fetchData();
            }
        },
        fetchData() {

            axios.get('photo?page=1' + this.weekString)
                .then(response => {
                    this.results = response.data;
                    this.totalPages = response.data.totalPages;
                })
        },
        paginateCallback: function (pageNumber) {
            axios.get("photo?page=" + pageNumber + this.weekString)
                .then((response) => {
                    this.results = response.data
                });
        }
    }
}
</script>

