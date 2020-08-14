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
            <router-link :to="{ name: 'users.show', params: {userId: user.id} }">
              <img class="img-thumbnail" src="/img/placeholders/user.png" :alt="user.name">
            </router-link>
            <figcaption class="figure-caption">
              <span class="font-weight-bold">{{ user.name }}</span> <br />
              {{ user.created_at | fromNow }}
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
  name: "Index",

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
    fetchData: function (page = 1) {
      this.isLoading = true
      this.placeholder = 'Searching...'

      axios.get('/users?page='+page).then(response => {

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
      axios.get(`/users?search=${escape(search)}`)
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
