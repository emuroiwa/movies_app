<template>
    <div class="container">
        <vue-element-loading :active="isActive" :is-full-screen="true" :size="'80'" :color="'#FF6700'"/>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card flex-md-row mb-4 box-shadow h-md-250">
                    <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb" style="width: 250px; height: 300px;" :src="'https://image.tmdb.org/t/p/w500/'+ movie.poster_path"  :alt="movie.original_title" data-holder-rendered="true">

                    <div class="card-body d-flex flex-column align-items-start">
                    <div class="row w-100"> 
                        <div class="col-6">
                            
                            <span class="badge badge-primary d-inline-block" v-for="genre in movie.genres" :key="genre.id"> {{genre.name}} </span>
                            <h3 class="mb-0">
                                <a class="text-dark" :href="'https://www.imdb.com/title/' + movie.imdb_id" target="_blank">{{movie.title}}</a>
                            </h3>
                        <div class="mb-1 text-muted">{{movie.runtime}} mins | {{movie.release_date}} |
                             <p class="d-inline-block" v-for="production_country in movie.production_countries" :key="production_country.id"> {{production_country.name}} </p></div>
                        </div>
                        <div class="col-6 d-flex flex-column align-items-end">
                            <i class="fas fa-star"></i>{{movie.vote_average}} / 10
                            <small>{{movie.vote_count}}</small>
                        </div>
                    </div>
                            
                        <p class="card-text mb-auto">
                            {{movie.overview}}
                        </p>
                        <a :href="'https://www.imdb.com/title/' + movie.imdb_id" target="_blank">Continue reading</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['id'],
        data(){
            return {
                isActive : false,
                movie: {}
            }
        },
        methods: {
            getMovieDetails() {
                this.isActive = true;
                
                  axios.get(baseURL + 'movie/'+ this.id +'?api_key=' + apiKey)
                        .then((data) => {
                            this.movie = data.data
                            this.isActive = false
                        })
                    .catch((error) => {
                        console.log("searchMovie had this error" + error)
                    })
            }
        },
        created() {
            this.getMovieDetails()
        }
    }
</script>
