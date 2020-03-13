<template>
    <div class="container">
        <vue-element-loading :active="isActive" :is-full-screen="true" :size="'80'" :color="'#FF6700'"/>
        <div class="flex-container">
            <div v-for="movie in movies.results" :key="movie.id">
                <movie-card :movie="movie"></movie-card>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                movies:{},
                isActive : false
            }
        },
        methods: {
            getPopularMovies() {
                this.isActive = true;
                axios.get('https://api.themoviedb.org/3/movie/popular?api_key=' + apiKey)
                        .then((data) => {
                            this.movies = data.data
                            this.isActive = false
                        })
                    .catch((error) => {
                        console.log("searchMovie had this error" + error)
                    })
            }
        },
        created() {
            this.getPopularMovies();
        }
    }
</script>
