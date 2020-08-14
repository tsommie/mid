<template>
  <div class="row">
    <div v-if="isLoading" class="col-12">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>

    <div v-else class="col-12">
      <div class="row">
        <div class="col-2">
          <figure>
            <img class="img-thumbnail" src="/img/placeholders/user.png" :alt="user.name">

            <figcaption class="figure-caption">
              <span class="font-weight-bold">{{ user.name }}</span> <br />
              {{ user.created_at | fromNow }}
            </figcaption>
          </figure>
        </div>
        <div class="col-10">
          <h1 class="h3">{{ fullName }}</h1>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { fetchData } from '../../helpers'

export default {
  name: "Show",

  data() {
    return {
      user: null,
      hasError: false,
      isLoading: true
    }
  },

  methods: {
    setData: function (user, error) {
      if (error) {
        this.hasError = true
      }
      this.user = user
      this.isLoading = false
    },

    fetchUser: function () {
      fetchData(`/users/${this.$route.params.userId}`, (data, error) => {
        this.setData(data.user, error)
      })
    }
  },

  beforeRouteEnter (to, from, next) {
    fetchData(`/users/${to.params.userId}`, (data, error) => {
      next(vm => {
        vm.isLoading = true
        vm.setData(data.user, error)
      })
    })
  },

  // when route changes and this component is already rendered,
  // the logic will be slightly different.
  beforeRouteUpdate (to, from, next) {
    fetchData(`/users/${to.params.userId}`, (data, error) => {
      this.isLoading = true
      this.setData(data.user, error)
      next()
    })
  },

  watch: {
    // call again the method if the route changes
    '$route': 'fetchUser'
  },

  created() {
    this.fetchUser()
  },

  computed: {
    fullName: function(){
      let middle = ' ';

      if (this.user.user_profile.other_names !== '' && this.user.user_profile.other_names !== null) {
        middle = ' ' + this.user.user_profile.other_names + ' '
      }

      return this.user.user_profile.first_name + middle + this.user.user_profile.last_name
    }
  }
}
</script>

<style scoped>

</style>
