<template>
    <div class="row">
        <div class="col-lg-6 d-none d-lg-block overflow-hidden">
            <img class="img_100" src="/img/theme/login.jpeg" alt="Login">
        </div>
        <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                </div>
                <p
                    v-if="arlet"
                    class="small text-danger text-center mt-2 mb-1"
                >Email or password not corect !!</p>
                <form
                    class="user"
                    @submit.prevent="submitLogin()"
                >
                    <div class="form-group">
                        <input
                            type="email"
                            class="form-control reset-form-control br10 px-3 py-4"
                            id="email"
                            placeholder="Enter Email Address..."
                            v-model="email"
                            autocomplete="new-password"
                        >
                    </div>
                    <div class="form-group">
                        <input
                            type="password"
                            class="form-control reset-form-control br10 px-3 py-4"
                            id="password"
                            placeholder="Password"
                            v-model="pass"
                            autocomplete="new-password"
                        >
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                            <input type="checkbox" class="custom-control-input" id="remember" v-model="remember">
                            <label class="custom-control-label" for="remember">Remember Me</label>
                        </div>
                    </div>
                    <button
                        type="submit"
                        class="btn btn-primary br10 px-3 py-2 btn-block"
                    >Login</button>
                </form>
                <hr>
                <div class="text-center">
                    <router-link
                        :to="{name: 'forgot'}"
                        tag="a"
                        class="small"
                    >Forgot Password?</router-link>
                </div>
                <div class="text-center">
                    <router-link
                        :to="{name: 'register'}"
                        tag="a"
                        class="small"
                    >Create an Account!</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Login",
        data() {
            return {
                email: '',
                pass: '',
                remember: false,
                arlet: false
            }
        },
        methods: {
            submitLogin(){
                axios.post('/api/login', {
                    email: this.email,
                    pass: this.pass,
                    remember: this.remember
                }).then(({ data }) => {
                    if (data){
                        window.location.href = '/';
                    } else {
                        this.arlet = true
                    }
                })
            }
        }
    }
</script>

<style scoped>
    .reset-form-control, .reset-form-control:hover, .reset-form-control:focus {
        background: #e9f0fe;
    }
</style>
