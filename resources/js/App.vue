<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="/">
                    Laravel
                </a>

                <router-link to="/" class="btn btn-primary m-4">
                    <p class="text-dark">Jobs List</p>
                </router-link>
                <router-link to="/job/create" class="btn btn-primary m-4">
                    <p class="text-dark">Create New job</p>
                </router-link>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="">
                    <span class="navbar-toggler-icon"></span>
                </button>


            </div>
        </nav>
        <main class="py-4">
            <router-view></router-view>
        </main>
    </div>
</template>
<script>
export default {
    mounted() {
    }
}
</script>
