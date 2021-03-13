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

                        <label>Your vanity URL</label>
                        <div class="input-group mb-3">
                            <div class="d-inline">
                                <div class="input-group-prepend mr-2">
                                    <span class="input-group-text" id="basic-addon3">https://www.google.lt</span>
                                </div>
                                <div class="input-group-prepend">
                                    <md-chips v-model="fields.urls" md-placeholder="Add URLS"></md-chips>
                                </div>
                            </div>
                            <div class="d-inline">
                                <div class="form-group">
                                    <button class="btn btn-primary" v-on:click="submit_form">Add new job</button>
                                </div>
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
        }
    }
}
</script>
