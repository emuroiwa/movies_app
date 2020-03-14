<template>
    <div class="container">
        <vue-element-loading :active="isActive" :is-full-screen="true" :size="'80'" :color="'#FF6700'"/>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <!-- search textbox -->
                <div class="input-group">
                    <input class="form-control form-control-navbar search-textbox mb-2" @keyup="searchMovie" v-model="searchText" type="search" placeholder="Search Movie" aria-label="Search">
                    <span class="input-group-append">
                        <div class="input-group-text mb-2 w-80">
                            <i class="fa fa-search"></i>
                        </div>
                    </span>
                </div>
                <!-- latest-movies -->
                <latest-movies v-if="!movies.results"></latest-movies>
                 <!-- result area -->     
                <div class="flex-container" v-else>
                    <div v-for="movie in movies.results" :key="movie.id">
                        <movie-card :movie="movie"></movie-card>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                searchText:'',
                movies: {},
                myMovies: {},
                isActive: false,
            }
        },

        methods: {
                searchMovie() {
                    this.isActive = true;
                    let query = this.searchText;
                    
                    var instance = axios.create();
                    delete instance.defaults.headers.common['X-CSRF-TOKEN'];
                    delete instance.defaults.headers.common['X-Requested-With'];
                    axios.get(baseURL + 'search/movie?api_key=' + apiKey + '&query=' + query)
                        .then((data) => {
                            this.movies = data.data
                            this.isActive = false;
                        })
                    .catch((error) => {
                        console.log("searchMovie had this error" + error)
                    })
                },
                
        },
        created() {
        }
    }
</script>
