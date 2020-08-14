<template>
  <div class="row">
    <div v-if="isLoading" class="col-12">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>

    <div v-else class="col-12">
      <div class="row text-center">
        <div v-for="user in users.data" :key="user.id" class="col-sm-6 col-md-3 col-lg-3 col-xl-2 mb-3">
          <figure>
            <!-- Button trigger modal -->
            <a href="#" role="button" data-toggle="modal" :data-target="`#modal-${user.id}`">
              <img class="img-thumbnail" src="/img/placeholders/user.png" :alt="user.name">
            </a>

            <!-- Modal -->
            <div class="modal fade" :id="`modal-${user.id}`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    {{ user.name }}
                  </div>
                  <div class="modal-footer">
                    <button type="button" @click="onDelete(user.id)" class="btn btn-danger" data-dismiss="modal">{{ $t('Delete permanently')}}</button>
                    <button type="button" @click="onRestore(user.id)" class="btn btn-primary" data-dismiss="modal">{{ $t('Restore') }}</button>
                  </div>
                </div>
              </div>
            </div>
            <figcaption class="figure-caption">
              <span class="font-weight-bold">{{ user.name }}</span> <br />
              {{ user.deleted_at | fromNow }}
            </figcaption>
          </figure>
        </div>
      </div>

      <pagination :data="users" align="center" @pagination-change-page="fetchData"></pagination>
    </div>
  </div>
</template>

<script>
import _ from 'lodash'

export default {
  name: "Trash",

  data() {
    return {
      placeholder: 'No result was returned.',
      isLoading: true,
      hasError: false,
      users: null,
      searchKey:  ''
    }
  },

  methods: {
    onRestore: function (id) {
      axios.put(`/deleted/users/${id}`).then(response => {
        this.sweetAlert().fire({
          text: response.data.message,
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Continue'
        }).then((result) => {
          if (result.value) {
            this.fetchData()
          }
        })
      }).finally(() => {

      })
    },

    onDelete: function (id) {
      axios.delete(`/deleted/users/${id}`).then(response => {
        this.sweetAlert().fire({
          text: response.data.message,
          icon: 'success',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Continue'
        }).then((result) => {
          if (result.value) {
            this.fetchData()
          }
        })
      }).finally(() => {

      })
    },

    fetchData: function (page = 1) {
      this.isLoading = true
      this.placeholder = 'Searching...'

      axios.get('/deleted/users?page='+page).then(response => {

        this.users = response.data.users

      }).catch(error => {

        this.hasError = true

      }).finally(() => {

        this.isLoading = false
        this.placeholder = 'No result was returned.'

      })
    },

    onSearch: function () {
      this.search(this.searchKey, this);
    },

    search: _.debounce((search, vm) => {
      vm.isLoading = true
      vm.placeholder = 'Searching...'
      axios.get(`/deleted/users?search=${escape(search)}`)
        .then(response => {
          vm.users = response.data.users
        }).finally(() => {
        vm.isLoading = false
        vm.placeholder = 'No result was returned.'
      });
    }, 350)
  },

  mounted() {
    this.fetchData()
  }
}
</script>

<style scoped>
.user-avatar {
  width: 150px;
  height: auto;
}
</style>
