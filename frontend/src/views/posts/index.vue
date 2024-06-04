<script setup>

    //import ref and onMounted
    import { ref, onMounted } from 'vue';

    //import api
    import api from '../../api';

    //define state
    const posts = ref([]);

    //method fetchDataPosts
    const fetchDataPosts = async () => {

        //fetch data 
        await api.get('/api/posts')

        .then(response => {

            //set response data to state "posts"
            posts.value = response.data.data.data

        });
    }

    //run hook "onMounted"
    onMounted(() => {

        //call method "fetchDataPosts"
        fetchDataPosts();
    });
    
    //method deletePost
    const deletePost = async (id) => {

    //delete post with API
    await api.delete(`/api/posts/${id}`)
    .then(() => {

        //call method "fetchDataPosts"
        fetchDataPosts();
    })

    };
</script>

<template>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> Post </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Post</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container">
                <router-link :to="{ name: 'posts.create' }" class="btn btn-sm btn-success rounded shadow border-0 mb-3">ADD NEW POST</router-link>
                <div class="row">
                    <div class="col-12">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Post</h3>

                          <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
          
                              <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                  <i class="fas fa-search"></i>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                          <table class="table table-hover text-nowrap">
                            <thead>
                              <tr>
                                <th>TITLE</th>
                                <th>CONTENT</th>
                                <th>IMAGE</th>
                                <th>ACTION</th>
                              </tr>
                            </thead>
                            <tbody>
                                <tr v-if="posts.length == 0">
                                    <td colspan="4" class="text-center">
                                        <div class="alert alert-danger mb-0">
                                            Data Belum Tersedia!
                                        </div>
                                    </td>
                                </tr>
                                <tr v-else v-for="(post, index) in posts" :key="index">
                                    
                                    <td>{{ post.title }}</td>
                                    <td>{{ post.content }}</td>
                                    <td class="text-center">
                                        <img :src="post.image" class="img-circle img-size-32 mr-2"/>
                                    </td>
                                    <td class="text-center">
                                        <router-link :to="{ name: 'posts.edit', params:{id: post.id} }" class="btn btn-sm btn-primary rounded-sm shadow border-0 me-2">EDIT</router-link>
                                        <button @click.prevent="deletePost(post.id)" class="btn btn-sm btn-danger rounded-sm shadow border-0">DELETE</button>
                                    </td>
                                </tr>
                            </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <!-- /.card -->
                    </div>
                  </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    
    <!-- /.control-sidebar -->
</template>