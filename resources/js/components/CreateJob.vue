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
                        <form @submit.prevent="submit_form()">
                            <label for="basic-url">Your vanity URL</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">https://example.com/users/</span>
                                </div>
                                <input type="text" v-model="fields.urls" class="form-control" id="basic-url"
                                       aria-describedby="basic-addon3">
                            </div>
                            <button :disabled="form_submitting" type="submit" class="btn btn-primary">Submit</button>
                        </form>
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
                'urls': ''
            },
            success: '',
            errors: {
                'urls': ''
            },
        }
    },
    mounted() {
    },
    methods: {
        submit_form() {
            this.form_submitting = true;
            axios.post('http://backend.test/api/job/store', this.fields)
                .then((response) => {
                    this.form_submitting = false;
                    this.success = response.data.success;
                }).catch((error) => {
                this.form_submitting = false;
                this.success = '';
                this.errors = error.response.data;

            });
        }
    }
}
</script>
