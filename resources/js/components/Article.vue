<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" v-for="article in this.articles">
                    <div class="card-header">{{ article.title }}</div>
                    <div class="card-body">
                        <h4>{{ article.text }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            'id': this.$route.params.id,
            'articles': {},
            'errors': {}
        }
    },
    mounted() {
        this.get_articles();
    },
    methods: {
        get_articles() {
            axios.get('http://backend.test/api/articles/show/' + this.id)
                .then((response) => {
                    this.articles = response.data;
                    console.log(this.articles);
                }).catch((error) => {

                this.errors = error.response;
            });
        }
    }
}
</script>
