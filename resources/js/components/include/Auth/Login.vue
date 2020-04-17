<template>
    <div class="row position-absolute" :key="key">
        <div class="col-lg-6 d-none d-lg-block overflow-hidden px-0">
            <img class="img_100" src="/img/theme/login.jpeg" alt="Login">
        </div>
        <div class="col-lg-6 sm-shadow">
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
                    id="login-form"
                    @submit.prevent="submitLogin($event.target.id)"
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
                        class="btn btn-primary br10 px-3 py-2 position-relative btn-block"
                    >
                        <span>Login</span>
                        <span class="d-block loading">
                                <span class="effect-1 effects"></span>
                                <span class="effect-2 effects"></span>
                                <span class="effect-3 effects"></span>
                            </span>
                        <span class="ra-center upsuccess d-flex justify-content-center align-items-center">
                                <svg><use xlink:href="#i-check"></use></svg>
                            </span>
                        <span class="ra-center upfailed d-flex justify-content-center align-items-center">
                                <svg><use xlink:href="#i-close"></use></svg>
                            </span>
                    </button>
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
    import UploadUi from "../../../utils/UploadUi";
    export default {
        name: "Login",
        data() {
            return {
                email: '',
                pass: '',
                remember: false,
                arlet: false,
                key: 'login'
            }
        },
        methods: {
            submitLogin($id){
                let $el = UploadUi.addClassBeforeProcess('#'+$id);
                axios.post('/api/login', {
                    email: this.email,
                    pass: this.pass,
                    remember: this.remember
                }).then(({ data }) => {
                    UploadUi.uploadProcess(!data, $el);
                    if (data){
                        setTimeout(()=> {
                            window.location.href = '/'
                        }, 1000);
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
    button[type="submit"]{
        height: 41px;
    }
    button[type="submit"]>span:first-child~* {
        width: 35px;
        height: 35px;
        font-size: 25px;
    }

    .loading .effect-1, .loading .effect-2, .loading .effect-3 {
        border-left: 3px solid #f6f7f9;
    }
</style>
