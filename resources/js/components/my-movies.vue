<template>
    <div class="container">
        <vue-element-loading :active="isActive" :is-full-screen="true" :size="'80'" :color="'#FF6700'"/>
        <div class="flex-container" v-if="movies.length > 0">
            <div v-for="movie in movies" :key="movie.id">
                <movie-card :movie="movie"></movie-card>
            </div>
        </div>
        <div v-else>
            <h3> No movies on watch list </h3>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                movies: [],
                isActive : false
            }
        },
        methods: {
            getWatchLaterList() {
                this.isActive = true;
                axios.get('watchlater/' + this.$auth.user().id)
                    .then((data) => {
                        this.watchLaterList(data)
                        this.isActive = false;
                    })
                    .catch((error) => {
                        console.log("getWatchLaterList had this error" + error)
                    })
            },
            watchLaterList(data) {
                this.isActive = true;
                var moviesList = []
                data.data.forEach(function(item){
                    if (item.movie_id) {
                        axios.get(baseURL + 'movie/'+ item.movie_id +'?api_key=' + apiKey)
                        .then((data) => {
                            moviesList.push(data.data)
                        })
                        .catch((error) => {
                            console.log("watchLaterList had this error" + error)
                        })
                    }
                 
                });
                this.movies = moviesList;
                this.isActive = false;
            },
        },
        created() {
            this.getWatchLaterList();
            //event bus checking when movie is removed
            Fire.$on('MovieRemoved',() => {
                this.getWatchLaterList();
            });
        }

  }
</script>
