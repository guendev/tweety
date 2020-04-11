<template>
    <div>

        <div class="profile-cover">
            <div class="container bg-black overflow-hidden">
                <div class="g_thumb">
                    <form
                        id="formImg"
                        enctype="multipart/form-data"
                        @submit.prevent="submitImg()"
                    >
                    <label for="cover" class="cover-overlay">
                        <svg class="ra-center text-light fs24 z1"><use xlink:href="#i-camera"></use></svg>
                        <img
                            :src="formData.cover"
                            :alt="formData.name"
                        >
                        <input
                            id="cover"
                            accept="image/png, image/jpeg, image/jpg"
                            class="hide w-100 h-100 l0"
                            type="file"
                            name="cover"
                            ref="cover"
                            @change="uploadImg($event)"
                        >
                    </label>
                    </form>
                </div>
            </div>
        </div>
        <div class="profile-meta">
            <div class="container">
                <div class="row">
                    <div class="col-4 position-relative">
                        <div class="profile-avatar rounded-circle overflow-hidden">
                            <label for="avatar" class="position-relative cover-overlay">
                                <svg class="ra-center z1 fs24 text-light"><use xlink:href="#i-camera"></use></svg>
                                <img alt="Forek"
                                     :src="formData.avatar"
                                     :alt="formData.name"
                                     class="img_100">
                                <input
                                    id="avatar"
                                    accept="image/png, image/jpeg, image/jpg"
                                    class="hide w-100 h-100 l0"
                                    type="file"
                                    form="formImg"
                                    name="avatar"
                                    ref="avatar"
                                    @change="uploadImg($event)"
                                >
                            </label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="profile-action text-right mt-2 d-flex">
                            <button
                                v-if="formImg.avatar !== undefined || formImg.cover !== undefined"
                                form="formImg"
                                type="submit"
                                class="btn bg-none bd-none btn-outline-primary mt-2 font-weight-bold text-primary br30 ml-2"
                            >Upload</button>
                            <!--<a
                                @click="back()"
                               class="btn btn-outline-primary mt-2 font-weight-bold text-primary br30"
                            >Back </a>-->
                        </div>
                    </div>


                    <form
                        class="needs-validation col-12 mt-3"
                        novalidate
                        @submit.prevent="submitProfile(2)"
                    >
                        <div class="form-row">
                            <div class="col-md-8 mb-3">
                                <label class="text-light"  for="name">Name</label>
                                <input
                                    type="text"
                                    class="form-control reset-form-control bg-dark-1"
                                    id="name"
                                    placeholder="Name"
                                    v-model="formData.name"
                                    required
                                >
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="text-light"  for="user_name">Username</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-dark-1 reset-form-control" id="inputGroupPrepend">@</span>
                                    </div>
                                    <input
                                        type="text"
                                        class="form-control reset-form-control bg-dark-1"
                                        id="user_name"
                                        placeholder="username"
                                        name="user_name"
                                        required
                                        v-model="formData.user_name"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-9 mb-3">
                                <label class="text-light" for="email">Email</label>
                                <input
                                    type="email"
                                    class="form-control reset-form-control bg-dark-1"
                                    id="email"
                                    v-model="formData.email"
                                    required
                                >
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="text-light"  for="local">Country</label>
                                <input type="text"
                                       class="form-control reset-form-control bg-dark-1"
                                       id="local"
                                       placeholder="Viet Nam"
                                       v-model="formData.local"
                                >
                            </div>
                        </div>
                        <div class="form-group">
                            <div
                                class="form-check d-flex choice-sex"
                            >
                                <div
                                    v-for="(sex, index) in sexs" :key="index"
                                    class="col-md-3 mb-3"
                                >
                                    <input
                                        class="form-check-input"
                                        name="sex"
                                        type="radio"
                                        :value="index+1"
                                        v-model="formData.sex"
                                    >
                                    <label class="form-check-label text-light" :for="sex">{{ sex }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label class="text-light"  for="story">Story</label>
                                <textarea
                                    class="form-control reset-form-control bg-dark-1"
                                    name="story"
                                    id="story"
                                    rows="4"
                                    v-model="formData.story"
                                >{{ formData.story }}</textarea>
                            </div>
                        </div>
                        <button
                            class="btn btn-outline-primary font-weight-bold text-primary br30 float-right clearfix"
                            type="submit"
                        >Update Your Info</button>
                    </form>

                    <form
                        class="col-12 mt-3"
                        @submit.prevent="submitPassword()"
                    >
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label class="text-light" for="oldpassword">Old Password</label>
                                <input
                                    type="password"
                                    class="form-control reset-form-control bg-dark-1"
                                    id="oldpassword"
                                    v-model="formPass.oldPass"
                                    required
                                >
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="text-light"  for="password">New Password</label>
                                <input
                                    type="password"
                                    class="form-control reset-form-control bg-dark-1"
                                    id="password"
                                    v-model="formPass.newPass"
                                    required
                                >
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="text-light"  for="repassword">Re Enter Password</label>
                                <input
                                    type="password"
                                    class="form-control reset-form-control bg-dark-1"
                                    id="repassword"
                                    v-model="formPass.rePass"
                                    required
                                >
                            </div>
                        </div>
                        <button class="btn btn-outline-primary font-weight-bold text-primary br30 float-right clearfix" type="submit">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Form from "../../support/Form";

   export default {
        name: "form-edit-profile",
        props: ['userid', 'is_edit'],
        data() {
            return {
                form: '',
                sexs: ['Boy', 'Girl', 'LGBT'],
                formHasChange: true,
                user: this.userid,
                user_data: {
                    id: this.userid,
                    name: '',
                    user_name:'',
                    email: '',
                    avatar: '',
                    cover: '',
                    story: '',
                    sex: '',
                    local: ''
                },
                formImg: new FormData(),
                formData: {
                    id: this.userid,
                    name: '',
                    user_name:'',
                    email: '',
                    story: '',
                    sex: '',
                    local: '',
                    cover: '',
                    avatar: ''
                },
                formPass: new Form( {
                    oldPass: '',
                    newPass:'',
                    rePass: '',
                })
            }
        },


        methods: {
          back(){
              this.$emit('back', this.user_data)
          },
          submitProfile(){
              axios.post('update-profile', {
                  params: {
                      data: this.formData
                  }
              }).then(({ data }) => {
                  this.user_data = data.data;
                  this.formData = data.data;
              })
          },
            submitPassword(){
              this.formPass.post('changePass')
                  .then(response => {
                  console.log('Change Pass')
              })
            },


            submitImg(){
                axios.post('changeProfileImg',
                    this.formImg
                ).then(response => {
                    this.formData.avatar = response.data.data.avatar === undefined ? this.user_data.avatar : response.data.data.avatar;
                    this.formData.cover = response.data.data.cover === undefined ? this.user_data.cover : response.data.data.cover;
                })
            },


            uploadImg($event){
              let target = $event.target;
              this.formImg[target.name] = target.files;
              this.formImg.append(target.name, target.files[0]);
              this.formData[target.name] = URL.createObjectURL(target.files[0]);
              this.formImg.status = true;
            }
        },


        created() {
            axios.get('/get-user', {
                params: {
                    user_id: this.user
                }
            }).then(({ data }) => {
                this.user_data = data;
                this.formData = data;
            });
        },
    }
</script>

<style scoped>
    .cover-overlay:after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background: #00000042;
        left: 0;
    }
    .profile-action:before {
        margin-top: 0.5rem;
    }
</style>
