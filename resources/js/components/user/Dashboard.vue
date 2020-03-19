<template>
  <div>
    <div>
      <nav class="navbar navbar-expand navbar-dark bg-dark">
            <ul class="navbar-nav">
                    <li class="nav-item">
                        <a v-on:click="overview = true, create = false, settings = false, liked = false" class="nav-link" href="#">Overview</a>
                    </li>
                    <li class="nav-item">
                        <a v-on:click="overview = false, create = false, settings = false, liked = true" class="nav-link" href="#">Liked</a>
                    </li>
                    <li class="nav-item">
                        <a v-on:click="overview = false, create = true, settings = false, liked = false" class="nav-link" href="#">Create</a>
                    </li>
                    <li class="nav-item">
                        <a v-on:click="overview = false, create = false, settings = true, liked = false" class="nav-link" href="#">Settings</a>
                    </li>
                </ul>
        </nav>
    </div>
    <div class="container">
      <div class="mt-4" v-if="liked">
        <div class="card card-body mb-2" v-for="pun in liked_puns" v-bind:key="pun.id">
                <h3>{{ pun.title }}</h3>
                <p>{{ pun.body }}</p>
            </div>
      </div>
      <div class="mt-4" v-if="create">
      <div class="card">
        <div class="card-header">
          Create a pun
        </div>
        <div class="card-body">
          <form @submit.prevent="submit" method="post">
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
      </div>
    </div>
    <div class="mt-4" v-if="settings">
      <div class="container">
        <div class="card">
          <div class="card-header">
            Settings
          </div>
          <div class="card-body">
            <h3>Delete account</h3>
            <p>This will remove your account and all of your posts</p>
            <button v-on:click="destroy()" class="btn btn-danger mt-2">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <div v-if="overview">
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
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  data() {
    return {
      title: '',
      body: '',
      overview: true,
      create: false,
      settings: false,
      liked: false,
      edit: {
        id: '',
        title: '',
        body: ''
      }
    }
  },

  computed: {
        ...mapState([
            'puns',
            'liked_puns'
        ])
    },

  created() {
    this.$store.dispatch('show');
    this.$store.dispatch('liked');
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
          this.title = '';
          this.body = '';
          this.overview = true, this.create = false, this.settings = false, this.liked = false;
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
    },

    destroy() {
      this.$store.dispatch('delete')
      .then(() => {
        this.$router.push({ name: 'home' });
      });
    }
  }
};
</script>
