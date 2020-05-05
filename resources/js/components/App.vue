<template>
    <v-card class="overflow-hidden">
        <v-content>
            <v-container fluid>
                <contents :articles="articles"></contents>
            </v-container>
        </v-content>

    </v-card>
</template>
<script>
    import Content from "./Content";
    import Vuetify from 'vuetify';

    export default {
        components: {Content},
        data() {
            return {
                articles: [],
                article : {
                    author: '',
                    title: '',
                    description: '',
                    url: '',
                    urltoImage: '',
                    publishedAt: '',
                    content: ''
                }
            }
        },
        created() {
            this.fetchNews();
        },
        methods: {
            fetchNews() {
                fetch('api/news/getAll').
                then(res => res.json())
                    .then(res => {
                        this.articles = res
                    })
            }
        }
    }
</script>
