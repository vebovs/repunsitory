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
        <div class="text-right">
          <button v-on:click="display(pun.id)" data-toggle="modal" data-target="#Modal" type="button" class="btn btn-primary">Edit</button>
          <button v-on:click="remove(pun.id)" type="button" class="btn btn-primary btn-danger">Delete</button>
        </div>

          <!-- Modal -->
          <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Edit</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                      <label for="title">Title</label>
                      <input v-model="edit.title" type="text" class="form-control">
                  </div>
                  <div>
                      <label for="body">Body</label>
                      <textarea v-model="edit.body" class="form-control" rows="8"></textarea>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button v-on:click="update(edit.id)" data-dismiss="modal" type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>

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
      state: false,
      edit: {
        id: '',
        title: '',
        body: ''
      }
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
    },

    display(id) {
      this.edit = this.puns.find(e => e.id === id);
    },

    update(id) {
      this.$store.dispatch('update', {
        id: id,
        title: this.edit.title,
        body: this.edit.body
      });
    },

    remove(id) {
      this.$store.dispatch('remove', {
        id: id
      });
    }
  }
};
</script>
