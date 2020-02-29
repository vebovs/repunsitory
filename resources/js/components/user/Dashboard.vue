<template>
  <div class="container">
    <div class="text-center">
      <div class="btn-group btn-group-lg mt-2" role="group" aria-label="Basic example">
        <button v-on:click="state = false" type="button" class="btn btn-secondary">Show</button>
        <button v-on:click="state = true" type="button" class="btn btn-secondary border-left">Create</button>
      </div>
    </div>
    <div v-if="state">
      <form class="m-4" @submit.prevent="submit" method="post">
            <div class="form-group">
              <label for="title">Title</label>
              <input v-model="title" type="text" class="form-control">
          </div>
          <div class="form-group">
              <label for="body">Body</label>
              <textarea v-model="body" class="form-control" rows="8"></textarea>
          </div>
          <button type="submit" class="btn btn-primary mt-2">Submit</button>
      </form>
    </div>
    <div v-if="!state">
      <div class="card card-body m-4" v-for="pun in puns" v-bind:key="pun.id">
            <h3>{{ pun.title }}</h3>
            <p>{{ pun.body }}</p>
        </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  data() {
    return {
      title: '',
      body: '',
      state: false
    }
  },

  computed: {
        ...mapState([
            'puns'
        ])
    },

  methods: {
    submit() {
      if(this.title && this.body) {
        this.$store.dispatch('create', {
          title: this.title,
          body: this.body
        })
        .then(() => {
          this.state = false;
        });
      }
    }
  }
};
</script>