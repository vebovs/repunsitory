<template>
    <div class="container">
        <div class="text-center">
            <div class="btn-group btn-group-lg mt-2" role="group" aria-label="Basic example">
                <button v-on:click="toggle = true" type="button" class="btn btn-secondary">Popular puns</button>
                <button v-on:click="toggle = false" type="button" class="btn btn-secondary border-left">Recent puns</button>
            </div>
        </div>
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