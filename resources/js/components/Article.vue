<template>
    <div class="container">
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75"
                 aria-valuemin="0" aria-valuemax="100" v-bind:style="{'width' : ( greenBar+'%' )}">
            </div>
            <div class="progress-bar bg-danger" role="progressbar" v-bind:style="{'width' : ( redBar +'%')}"
                 aria-valuenow="25"
                 aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="row" v-for="url in urls">
            <div class="col-sm-12 text-center m-1">
                <h4>{{ url.url }}</h4>
            </div>
            <div class="col-sm-4" v-for="article in url.articles">
                <div class="card m-2" v-bind:class="{ 'bg-danger': (article.status == 0) }">
                    <div class="card-body">
                        <h5 class="card-title">{{ url.title == '' ? 'Website title empty' : url.title }}</h5>
                        <p class="card-text">{{ article.text }}</p>
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
            'urls': {},
            'errors': {},
            'greenBar': 0,
            'redBar': 0,
        }
    },
    mounted() {
        this.get_articles();
    },
    methods: {
        get_articles() {

            axios.get('/api/articles/show/' + this.id)
                .then((response) => {
                    this.urls = response.data.data;
                    this.calculateFailedUrl();
                }).catch((error) => {
                this.errors = error.response;
                    if(error.response.status === 404 )
                    {
                        window.location.href = "/404";
                    }
            });
        },
        calculateFailedUrl() {
            let success = 0;
            console.log(this.urls);
            this.urls.map(index => {
                if (index.articles[0].status == 1) success++;
            });
            this.greenBar = (success / this.urls.length) * 100;
            this.redBar = 100 - this.greenBar;
        }

    }
}
</script>
