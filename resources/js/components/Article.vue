<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" v-for="(article, index) in articles">
                    <div class="card-header">{{ article[0].title }}</div>
                    <div class="card-body">
                            {{ article[0].text }}
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
            'articles': {},
            'errors': {}
        }
    },
    mounted() {
        this.get_articles();
    },
    methods: {
        get_articles() {
            axios.get('http://backend.test/api/articles')
                .then((response) => {
                    console.log('here');
                    this.articles = response.data;
                    console.log(this.articles );
                }).catch((error) => {
                this.errors = error.response;
            });
        }
    }
}
</script>
