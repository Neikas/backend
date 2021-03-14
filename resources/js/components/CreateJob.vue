<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Created New Job</div>
                    <div class="card-body">
                        <div v-if="errors.message" class="alert alert-danger">
                            <h4>{{ errors.message }}</h4>
                            <ul>
                                <li v-for="error in errors.errors.urls ">{{ error }}</li>
                            </ul>
                        </div>
                        <div v-if="success" class="alert alert-success">
                            {{ success }}
                        </div>

                        <p class="text-center">Url must be same as in Google example!</p>
                        <div class="form-group">
                            <div class="col-sm-12">
                                    <span class="input-group-text" id="basic-addon3">https://www.google.lt</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <md-chips v-model="fields.urls" md-placeholder="Insert URL here and press enter"></md-chips>
                            </div>
                        </div>
                            <div class="d-inline">
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" v-on:click="submit_form">Add new job</button>
                                    <button class="btn btn-primary btn-block" v-on:click="insert_news_portals">URLs for test</button>
                                </div>
                            </div>

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
            form_submitting: false,
            fields: {
                'urls': [],
            },
            success: '',
            errors: {
                'urls': '',
                'message': '',
            },
        }
    },
    mounted() {

    },
    methods: {
        submit_form() {
            this.form_submitting = true;
            axios.post('/api/job/store', this.fields)
                .then((response) => {
                    this.form_submitting = false;
                    this.success = response.data.success;
                    this.errors = {
                        'urls': '',
                        'message': '',
                    }
                }).catch((error) => {
                this.form_submitting = false;
                this.success = '';
                this.errors = error.response.data;
            });
        },
        insert_news_portals()
        {
            var newProtals = [
                'https://www.delfi.lt/', 'https://www.supermama.lt/', 'https://www.skelbiu.lt',
                'https://www.plius.lt', 'https://www.lrs.lt', 'https://www.vz.lt/',
                'https://www.delfi.lt/krepsinis/', 'https://www.15min.lt/',
                'http://www.ltv.lt/ziniasklaida/', 'https://www.lrt.lt/',
                'https://www.alfa.lt/', 'https://www.m-1.fm/', 'https://laikas.tv3.lt/',
                'https://www.lietus.fm/', 'https://alkas.lt/', 'https://www.delfi.lt/orai/',
                'https://www.delfi.lt/horoskopai/', 'https://www.delfi.lt/news/daily/crime/',
                'https://www.delfi.lt/seima/', 'https://alytausgidas.lt/', 'https://bbc.co.uk',
                'https://edition.cnn.com/', 'https://www.nytimes.com/', 'https://www.delfi.lt/verslas/',
                'https://www.delfi.lt/mokslas/', 'http://www.technologijos.lt/',
                'http://www.technologijos.lt/laisvalaikis', 'http://www.technologijos.lt/laisvalaikis/sventes',
                'http://www.technologijos.lt/diskusijos/',
            ];
            this.fields.urls = newProtals;
        }
    }
}
</script>
