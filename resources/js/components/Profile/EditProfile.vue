<template>
    <div>
        <div class="profile-cover">
            <div class="bg-black overflow-hidden">
                <div class="g_thumb">
                    <form
                        id="formImg"
                        enctype="multipart/form-data"
                        @submit.prevent="submitImg()"
                    >
                    <label for="cover" class="cover-overlay">
                        <svg class="ra-center text-light fs24 z1"><use xlink:href="#i-camera"></use></svg>
                        <img
                            :src="formData.cover ? formData.cover : '/img/theme/tweety.jpg'"
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
                    <div
                        class="col-4 position-relative"
                        style="height: 45px"
                    >
                        <div class="profile-avatar rounded-circle overflow-hidden">
                            <label for="avatar" class="w-100 position-relative cover-overlay">
                                <svg class="ra-center z1 fs24 text-light"><use xlink:href="#i-camera"></use></svg>
                                <img alt="Forek"
                                     :src="formData.avatar ? formData.avatar : '/img/theme/avatar-default.jpg'"
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
                                class="btn btn-outline-primary position-relative mt-2 font-weight-bold text-primary br30 ml-2"
                            >
                                <span>Upload</span>
                                <span class="d-block loading">
                                <span class="effect-1 effects"></span>
                                <span class="effect-2 effects"></span>
                                <span class="effect-3 effects"></span>
                            </span>
                                <span class="ra-center upsuccess">
                                <svg><use xlink:href="#i-check"></use></svg>
                            </span>
                                <span class="ra-center upfailed">
                                <svg><use xlink:href="#i-close"></use></svg>
                            </span>
                            </button>
                          <button
                              v-else
                              @click="back()"
                              class="btn btn-outline-primary mt-2 font-weight-bold text-primary br30"
                            >Back </button>
                        </div>
                    </div>


                    <form
                        class="needs-validation col-12 mt-3"
                        id="formInfo"
                        novalidate
                        @submit.prevent="submitProfile($event)"
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
                            class="btn btn-outline-primary position-relative font-weight-bold text-primary br30 float-right clearfix"
                            type="submit"
                        >
                            <span>Update Your Info</span>
                            <span class="d-block loading">
                                <span class="effect-1 effects"></span>
                                <span class="effect-2 effects"></span>
                                <span class="effect-3 effects"></span>
                            </span>
                            <span class="ra-center upsuccess">
                                <svg><use xlink:href="#i-check"></use></svg>
                            </span>
                            <span class="ra-center upfailed">
                                <svg><use xlink:href="#i-close"></use></svg>
                            </span>
                        </button>
                    </form>

                    <form
                        class="col-12 mt-3"
                        @submit.prevent="submitPassword($event)"
                        id="formPass"
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
                        <button
                            class="btn btn-outline-primary font-weight-bold position-relative text-primary br30 float-right clearfix"
                            type="submit"
                            :disabled="formPass.oldPass === '' || formPass.newPass ==='' || formPass.newPass !== formPass.rePass"
                        >
                            <span>Update Your Password</span>
                            <span class="d-block loading">
                                <span class="effect-1 effects"></span>
                                <span class="effect-2 effects"></span>
                                <span class="effect-3 effects"></span>
                            </span>
                            <span class="ra-center upsuccess">
                                <svg><use xlink:href="#i-check"></use></svg>
                            </span>
                            <span class="ra-center upfailed">
                                <svg><use xlink:href="#i-close"></use></svg>
                            </span>
                        </button>
                    </form>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Form from "../../support/Form";
    import UploadUi from "../../utils/UploadUi";
    export default {
        name: "form-edit-profile",
        props: ['userid', 'is_edit'],
        data() {
            let spreadElements = {
                id: this.userid,
                name: '',
                user_name: '',
                email: '',
                avatar: '',
                cover: '',
                story: '',
                sex: '',
                local: ''
            };
            return {
                form: '',
                sexs: ['Boy', 'Girl', 'LGBT'],
                formHasChange: true,
                user: this.userid,
                user_data: {
                    ...spreadElements
                },
                formImg: new FormData(),
                formData: {
                    ...spreadElements
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
          submitProfile($event){
              let $el = UploadUi.addClassBeforeProcess('#'+$event.target.id);
              axios.post('update-profile', {
                  params: {
                      data: this.formData
                  }
              }).then(({ data }) => {
                  UploadUi.uploadProcess(data.error, $el);
                  this.user_data = data.data;
                  this.formData = data.data;
              })
          },
            submitPassword($event){
                let $el = UploadUi.addClassBeforeProcess('#'+$event.target.id);
                this.formPass.post('changePass')
                  .then(({ data }) => {
                      UploadUi.uploadProcess(data.error, $el);
                  })
            },


            submitImg(){
                axios.post('changeProfileImg', this.formImg)
                    .then(({ data }) => {
                        UploadUi.uploadProcess(data.error, $el);
                        this.formData.avatar = data.data.avatar === undefined ? this.user_data.avatar : data.data.avatar;
                        this.formData.cover = data.data.cover === undefined ? this.user_data.cover : data.data.cover;
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

    .loading {
        width: 32px;
        height: 32px;
    }
    .btn{
        height: 37px;
    }
</style>
