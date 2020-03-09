<template>
<div>
    <div>
        <nav class="navbar navbar-expand navbar-dark bg-dark">
            <ul class="navbar-nav">
                    <li class="nav-item">
                        <a v-on:click="toggle = true" class="nav-link" href="#">Popular puns</a>
                    </li>
                    <li class="nav-item">
                        <a v-on:click="toggle = false" class="nav-link" href="#">Recent puns</a>
                    </li>
                </ul>
        </nav>
    </div>
    <div class="container">
        <div class="mt-2">
            <div class="text-center">
            <h2>{{ title }}</h2>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="index(pagination.prev_page_url)">Previous</a></li>
                    <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="index(pagination.next_page_url)">Next</a></li>
                </ul>
            </nav>
            </div>
            <div class="card card-body mb-2" v-for="pun in home" v-bind:key="pun.id">
                <h3>{{ pun.title }}</h3>
                <p>{{ pun.body }}</p>
                <div class="text-right">
                    <p>Likes: {{ pun.likes }}</p>
                    <button v-on:click="like(pun.id)" type="button" class="btn btn-primary btn-success">Like</button>
                </div>
            </div>
            <nav class="mt-3" aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="index(pagination.prev_page_url)">Previous</a></li>
                    <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="index(pagination.next_page_url)">Next</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
    
</template>

<script>
import { mapState } from 'vuex';

export default {
    data() {
        return {
            title: 'Popular puns',
            toggle: true
        }
    },

    watch: {
      toggle: function () {
          this.index();
      }
     },

    created() {
        this.index();
    },

    computed: {
        ...mapState([
            'status',
            'home',
            'pagination',
            'error'
        ])
    },

    methods: {
        index(page_url) {
            page_url = (this.toggle) ? page_url || '/api/popular' : page_url || '/api/recent';
            this.title = (this.toggle) ? 'Popular puns' : 'Recent puns'
            this.$store.dispatch('home', {
                page_url: page_url
            });
        },

        like(id) {
            if(!this.status) {
                alert('You need to be logged in for this action');
            } else {
                this.$store.dispatch('like', {
                    id: id
                });
            }
        }
    }
    
}
</script>
