<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8"
                <div class="card" v-for="job in this.jobs" >
                    <div class="card-header">{{ job.title }}</div>
                    <div class="card-body">
                        <h4>{{ job.text}}</h4>
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
                    console.log(this.jobs );
                }).catch((error) => {

                this.errors = error.response;
            });
        }
    }
}
</script>
