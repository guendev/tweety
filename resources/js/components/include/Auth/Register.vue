<template>
    <div class="row position-absolute" :key="key">
        <div class="col-lg-5 d-none d-lg-block px-0">
            <img class="img_100" src="/img/theme/register.jpeg" alt="Register">
        </div>
        <div class="col-lg-7">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">{{ completed ? 'Post something amazing': 'Create an Account!' }}</h1>
                </div>
                <p
                    v-if="msg && completed === false"
                    class="small text-danger text-center mt-n3 mb-1"
                >{{ msg }}</p>
                <form v-if="!completed" @submit.prevent="submitRegister()">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input
                                type="text"
                                class="form-control reset-form-control br10 px-3 py-4"
                                id="name"
                                placeholder="Your Name"
                                v-model="name"
                                autocomplete="new-password"
                                required
                            >
                        </div>
                        <div class="col-sm-6">
                            <input
                                type="text"
                                class="form-control reset-form-control br10 px-3 py-4"
                                id="user_name"
                                placeholder="user_name"
                                v-model="user_name"
                                autocomplete="new-password"
                                required
                            >
                        </div>
                    </div>
                    <div class="form-group">
                        <input
                            type="email"
                            class="form-control reset-form-control br10 px-3 py-4"
                            id="email"
                            placeholder="Email Address"
                            v-model="email"
                            autocomplete="new-password"
                            required
                        >
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input
                                type="password"
                                class="form-control reset-form-control br10 px-3 py-4"
                                id="pass"
                                placeholder="Password"
                                v-model="pass"
                                autocomplete="new-password"
                                required
                            >
                        </div>
                        <div class="col-sm-6">
                            <input
                                type="password"
                                class="form-control reset-form-control br10 px-3 py-4"
                                :class="repass.split('').length > 0 && repass !== pass ? 'text-danger' : ''"
                                id="repass"
                                v-model="repass"
                                placeholder="Repeat Password"
                                autocomplete="new-password"
                                required
                            >
                        </div>
                    </div>
                    <button
                        type="submit" class="btn btn-primary br10 px-3 py-2 btn-block"
                        :disabled="name==='' || user_name==='' || email ==='' || pass ==='' || repass==='' || repass !== pass"
                        :class="name==='' || user_name==='' || email ==='' || pass ==='' || repass ==='' || repass !== pass ? 'btn-dark' : 'btn-primary'"
                    >
                        Register Account
                    </button>
                </form>
                <div v-else class="d-flex flex-column justify-content-center align-items-center">
                    <div class="oh" style="max-width: 200px">
                        <img class="img_reponsive" src="/img/theme/social.png">
                    </div>
                    <div>
                        <a class="btn btn-danger mr-2 br10 px-3 py-1 text-light mt-3" :href="'/@'+user_name">Go to Profile</a>
                        <a class="btn btn-primary br10 px-3 py-1 text-light mt-3" href="/discovery">Discovery</a>
                    </div>
                </div>
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
        name: "Register",
        data() {
            return {
                name: '',
                user_name: '',
                email: '',
                pass: '',
                repass:'',
                msg: '',
                completed: false,
                key: 'register'
            }
        },
        methods: {
            submitRegister(){
                axios.post('api/register', {
                    name: this.name,
                    user_name: this.user_name,
                    email: this.email,
                    pass: this.pass
                }).then(({ data }) => {
                    if (data.error){
                        this.msg = data.msg
                    } else {
                        this.completed = true;
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
