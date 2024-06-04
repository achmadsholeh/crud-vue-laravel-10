<script setup>
    //import ref
    import {
        ref
    } from "vue";

    //import router
    import {
        useRouter
    } from 'vue-router';

    //import api
    import api from "../../api";

    //init router
    const router = useRouter();

    //define state
    const image = ref("");
    const title = ref("");
    const content = ref("");
    const errors = ref([]);

    //method for handle file changes
    const handleFileChange = (e) => {
        //assign file to state
        image.value = e.target.files[0];
    };

    //method "storePost"
    const storePost = async () => {

        //init formData
        let formData = new FormData();

        //assign state value to formData
        formData.append("image", image.value);
        formData.append("title", title.value);
        formData.append("content", content.value);

        //store data with API
        await api.post('/api/posts', formData)
            .then(() => {
                //redirect
                router.push({
                    path: "/posts"
                });
            })
            .catch((error) => {
                //assign response error data to state "errors"
                errors.value = error.response.data;
            });
    };
</script>

<template>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Create Post </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Post</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <!-- Main content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Create</h3>
                                    <router-link :to="{ name: 'posts.index' }" class="btn btn-sm btn-warning rounded shadow border-0">Back</router-link>
                                    <!-- <a href="">View Report</a> -->
                                </div>
                            </div>

                            <form @submit.prevent="storePost()">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input type="text" class="form-control" v-model="title" placeholder="Title Post">
                                        <div v-if="errors.title" class="alert alert-danger mt-2">
                                            <span>{{ errors.title[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Content</label>
                                        <textarea class="form-control" v-model="content" rows="5" placeholder="Content Post"></textarea>
                                        <div v-if="errors.content" class="alert alert-danger mt-2">
                                            <span>{{ errors.content[0] }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">File Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="form-control" @change="handleFileChange($event)" >
                                                <div v-if="errors.image" class="alert alert-danger mt-2">
                                                    <span>{{ errors.image[0] }}</span>
                                                </div>
                                            </div>
                                            <!-- <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div> -->
                                        </div>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-md btn-primary rounded-sm shadow border-0">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>