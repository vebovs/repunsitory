<template>
    <div>
        <div class="text-center">
            <div class="btn-group btn-group-lg mt-2" role="group" aria-label="Basic example">
                <button id="popular" v-on:click="display" type="button" class="btn btn-secondary">Popular puns</button>
                <button id="recent" v-on:click="display" type="button" class="btn btn-secondary">Recent puns</button>
            </div>
        </div>
        <div class="mt-2">
            <puns :title="title"></puns>
        </div>
    </div>
</template>

<script>
import Puns from './Puns.vue';

export default {
    components: {
        'puns': Puns
    },
    data() {
        return {
            title: 'Popular puns'
        }
    },
    methods: {
        display: function (event) {
            let id = event.currentTarget.id;
            if(id === 'popular') {
                this.title = 'Popular puns';
            } else {
                this.title = 'Recent puns';
            }
        }
    }
    
}
</script>