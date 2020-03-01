<template>
    <div>
        <div class="text-center">
            <h2>{{ title }}</h2>
            <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="test(pagination.prev_page_url)">Previous</a></li>
                <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="test(pagination.next_page_url)">Next</a></li>
            </ul>
            </nav>
        </div>
        <div class="card card-body mb-2" v-for="pun in puns" v-bind:key="pun.id">
            <h3>{{ pun.title }}</h3>
            <p>{{ pun.body }}</p>
        </div>
        <nav class="mt-3" aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="test(pagination.prev_page_url)">Previous</a></li>
                <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{ pagination.current_page }} of {{ pagination.last_page }}</a></li>
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="test(pagination.next_page_url)">Next</a></li>
            </ul>
        </nav>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        title: String
    },

    watch: {
      title: function () {
          this.test();
      }
     },

    data() {
        return {
            puns: [],
            pun: {
                id: '',
                title: '',
                body: ''
            },
            pagination: {}
        }
    },

    created() {
        this.getPuns();
        this.test();
    },

    methods: {
        test(page_url) {
            let vm = this;
            page_url = (this.title === 'Popular puns') ? page_url || '/api/popular' : page_url || '/api/recent';
            axios.get(page_url)
            .then(res => {
                console.log(res.data);
                this.puns = res.data.data;
                vm.makePagination(res.data.meta, res.data.links);
            })  
            .catch(err => console.log(err));
        },

        makePagination(meta, links) {
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev
            };
            this.pagination = pagination;
        },
    }
}
</script>