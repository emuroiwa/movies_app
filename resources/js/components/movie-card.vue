<template>
    <div class="card movie-card">
        <router-link :to="{ name: 'movieDetails', params: { id: movie.id } }">
            <img :src="'https://image.tmdb.org/t/p/w500/'+ movie.poster_path"  class="card-img-top" :alt="movie.original_title" >
            <div class="card-img-overlay h-75">
                <span class="badge badge-primary">{{ movie.vote_average }}</span>
            </div>
        </router-link>
        <div class="card-body">
            <h5 class="card-title">{{ movie.original_title }}</h5>
            <small>
                <i class="fas fa-calendar-times"></i> {{ movie.release_date }} 
            </small>
            <!-- watch later routine -->
            <button v-if="!isWatchLater"  @click="watchLater(movie.id,'add')" class="btn btn-primary">
                <i class="fas fa-plus"></i> Watch Later
            </button>
            <button v-else  @click="saveWatchLater(movie.id,'remove')" class="btn btn-success">
                <i class="fas fa-check"></i> Added Watch List
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            movie: Object,
        },
        data(){
            return {
                isWatchLater: false,
            }
        },
        methods: {
            watchLater(id,operation) {
                // check if user is logged in
                if (this.$auth.check() && operation == 'add') {
                   this.saveWatchLater(id,operation)  
                } else if (this.$auth.check() && operation == 'remove') {
                   this.saveWatchLater(id,operation)  
                } else {
                     // tell user to login
                    this.$router.push({ name: 'login' })

                }
            },
            
            saveWatchLater(id,operation) {
                if (operation == 'add') {
                    axios.post('watchlater', {
                            movie_id: id,
                            user_id: this.$auth.user().id
                        
                        }).then((response) => {
                            this.checkWatchLaterList(id);
                            
                        }).catch((error)=>{
                            console.log("saveWatchLater had this error" + error)
                        });
                } else {
                    axios.delete('watchlater/'+id).then(()=>{
                            // remove movie event
                            Fire.$emit('MovieRemoved');
                            this.checkWatchLaterList(id);
                        }).catch((error)=>{
                            console.log("saveWatchLater had this error" + error)
                        });
                }
            },
            
            checkWatchLaterList(movie_id) {
                //get watch later from the backend
                axios.get('watchlater/' + this.$auth.user().id + '/' + movie_id)
                    .then((data) => {
                        if (data.data.length > 0) {
                            this.isWatchLater = true
                        } else {
                            this.isWatchLater = false
                        }
                    })
                    .catch((error) => {
                        console.log("checkWatchLaterList had this error" + error)
                    })
               
            }

        },
        created() {
            this.checkWatchLaterList(this.movie.id);
        }
    }
</script>
