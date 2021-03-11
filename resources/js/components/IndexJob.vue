<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Check Job Status</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Status</th>
                                <th scope="col">Started_at</th>
                                <th scope="col">Articles</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(job, index) in jobs">
                                <th scope="row">{{ index }}</th>
                                <td>{{ job.status }}</td>
                                <td>{{ job.started_at }}</td>
                                <td>
                                    <router-link :to="{name: 'article.show', params: {'id' : job.id } }" class="btn btn-primary m-4">Chceck articles</router-link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
export default {
    props: {
        article: {
            type: String,
            required: true,
        }
    },
    data() {
        return {
            jobs: {},
            article_url: this.article,
        };
    },
    mounted() {
        this.get_jobs();

    },
    methods: {
        get_jobs() {
            axios.get('http://backend.test/api/job/index')
                .then((response) => {
                    this.jobs = response.data.data;
                }).catch((e) => {

            });
        }
    }
}
</script>
