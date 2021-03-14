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
                                <th scope="col">Percentage</th>
                                <th scope="col">Started_at</th>
                                <th scope="col">Finished at</th>
                                <th scope="col">Articles</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(job, index) in jobs">
                                <th scope="row">{{ index }}</th>
                                <td>{{ job.status }}</td>
                                <td>
                                    <div class="progress" v>
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75"
                                             aria-valuemin="0" aria-valuemax="100" v-bind:style="{'width' : ( job.percentage +'%' )}">
                                            {{ job.percentage }}
                                        </div>
                                    </div>
                                </td>
                                <td>{{ job.started_at }}</td>
                                <td>{{ job.finished_at }}</td>
                                <td v-if="job.status == 'Done'">
                                    <router-link :to="{name: 'article.show', params: {'id' : job.id } }"
                                                 class="btn btn-primary btn-sm">
                                        <p class="text-dark">Chceck articles</p>
                                    </router-link>
                                </td>
                                <td v-else>
                                    Wait for execution
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
            toggle: false,
        };
    },
    mounted() {
        this.get_jobs();

    },
    methods: {
        get_jobs() {
            axios.get('/api/job/index')
                .then((response) => {
                    this.jobs = response.data.data;
                }).catch((e) => {
                alert(e);
            });
        },
    }
}
</script>
