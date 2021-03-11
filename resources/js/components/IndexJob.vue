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
                                <th scope="col">Finished at</th>
                                <th scope="col">Articles</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(job, index) in jobs">
                                <th scope="row">{{ index }}</th>
                                <td>{{ job.status == 1 ? 'Sucessful': 'Failed'}}</td>
                                <td>{{ job.finished_at }}</td>
                                <td v-if="job.status == 1">
                                    <router-link :to="{name: 'article.show', params: {'id' : job.id } }"
                                                 class="btn btn-primary btn-sm">Chceck articles
                                    </router-link>
                                </td>
                                <td v-else>
                                    Job failed
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
