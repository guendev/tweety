<template>
    <div class="row">
        <div class="col-lg-6 d-none d-lg-block bg-password-image">
            <img class="img_100" src="/img/theme/forgot.jpeg" alt="Forgot">
        </div>
        <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                    <p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</p>
                </div>
                <form class="user">
                    <div class="form-group">
                        <input type="email" class="form-control reset-form-control br10 px-3 py-4" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <a href="login.html" class="btn btn-primary br10 px-3 py-2  btn-block">
                        Reset Password
                    </a>
                </form>
                <hr>
                <div class="text-center">
                    <div class="text-center">
                        <router-link
                            :to="{name: 'register'}"
                            tag="a"
                            class="small"
                        >Create an Account!</router-link>
                    </div>
                </div>
                <div class="text-center">
                    <router-link
                        :to="{name: 'login'}"
                        tag="a"
                        class="small"
                    >Already have an account? Login!</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Forgot"
    }
</script>

<style scoped>
    .reset-form-control, .reset-form-control:hover, .reset-form-control:focus {
        background: #e9f0fe;
    }
</style>
