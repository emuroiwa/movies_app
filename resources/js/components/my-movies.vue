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
                movies: [],
                isActive : false
            }
        },
        methods: {
            getWatchLaterList() {
                axios.get('watchlater/' + this.$auth.user().id)
                    .then((data) => {
                        this.setWatchLaterList(data)
                    })
                    .catch((error) => {
                        console.log("getWatchLaterList had this error" + error)
                    })
            },
            setWatchLaterList(data) {
                this.isActive = true;
                let movies = [];
                
                var mainObject = [],
                    promises = [];
                var that = this;
                data.data.forEach(function(item){
                    if (item.movie_id) {
                        var myUrl = baseURL + 'movie/'+ item.movie_id +'?api_key=' + apiKey;
                        promises.push(axios.get(myUrl))
                    }
                });

                axios.all(promises).then((data) => {
                    this.movies = data;
                    console.log(data)
                }) 
                .catch((error) => {
                        console.log("setWatchLaterList had this error" + error)
                    })
                console.log(movies)
                this.isActive = false
            }   
        },
        created() {
            this.getWatchLaterList();
        }

  }
</script>
