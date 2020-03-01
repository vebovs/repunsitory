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
            <div class="card card-body mb-2" v-for="pun in puns" v-bind:key="pun.id">
                <h3>{{ pun.title }}</h3>
                <p>{{ pun.body }}</p>
                <div class="text-right">
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
import axios from 'axios';

export default {
    data() {
        return {
            puns: [],
            pagination: {},
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

    methods: {
        index(page_url) {
            page_url = (this.toggle) ? page_url || '/api/popular' : page_url || '/api/recent';
            this.title = (this.toggle) ? 'Popular puns' : 'Recent puns'
            axios.get(page_url)
            .then(res => {
                this.puns = res.data.data;
                this.pagination = {
                    current_page: res.data.meta.current_page,
                    last_page: res.data.meta.last_page,
                    next_page_url: res.data.links.next,
                    prev_page_url: res.data.links.prev
                };
            })  
            .catch(err => console.log(err));
        },

        like(id) {
            console.log(id);
        }
    }
    
}
</script>