<template>
    <div class="card mr-3 mb-2">
        <img :src="'https://image.tmdb.org/t/p/w500/'+ movie.poster_path"  class="card-img-top" :alt="movie.original_title" >
            <div class="card-img-overlay h-75">
                <span class="badge badge-primary">{{ movie.vote_average }}</span>
            </div>
        <div class="card-body">
            <h5 class="card-title">{{ movie.original_title }}</h5>
            <small>Release Date {{ movie.release_date }}</small>
            <button  @click="watchLater(movie.id)" class="btn btn-primary">Watch Later</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            movie: Object,
            myMovies: Object
        },
        data(){
            return {
            }
        },
        methods: {
            watchLater(id) {
                // check if user is logged in
                if (this.$auth.check()) {
                   this.saveWatchLater(id)  
                } else {
                    // tell user to login
                    this.$router.push({ name: 'login' })

                }
            },
            saveWatchLater(id) {
                axios.post('watchlater', {
                        movie_id: id,
                        user_id: this.$auth.user().id
                       
                    }).then((response) => {
                       
                        
                    }).catch((error)=>{
                        console.log("saveWatchLater had this error" + error)
                    });
            },
            
            checkWatchLaterList(movieID) {
                if (typeof this.myMovies !== 'undefined') {
                    console.log('ss')
                    for (var i=0; i < this.myMovies.length; i++) {
                        if (this.myMovies[i].id === movieID) {
                            return false;
                        } else {
                            return true;
                        }
                    }
                }
            }

        }
    }
</script>
