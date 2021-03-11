<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8"
                <div class="card" v-for="(job, index) in jobs[0]">
                    <div class="card-header">{{ job.name }}</div>
                    <div class="card-body">
                        <h1>{{job.articles[0].title}}</h1>
                        <h1>{{job.articles[0].text}}</h1>
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
            'jobs': {},
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
                    this.jobs = response.data;
                    console.log(this.jobs);
                }).catch((error) => {
                this.errors = error.response;
            });
        }
    }
}
</script>
