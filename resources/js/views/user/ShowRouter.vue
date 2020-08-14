<template>
  <div class="row">
    <div v-if="isLoading" class="col-12">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>

    <div v-else class="col-12 my-3">
      <div class="row">
        <div class="p-5 bg-white">
          <h1 class="h3">{{ fullName }}</h1>
        </div>
      </div>
    </div>

    <div v-if="user !== null" class="col-md-2">
      <div class="list-group">
        <router-link class="list-group-item list-group-item-action" :to="{ name: 'users.show', params: {userId: user.id} }" exact>
          <i class="fas fa-user"></i> {{ $t('View') }}
        </router-link>

        <router-link class="list-group-item list-group-item-action" :to="{ name: 'users.edit', params: {userId: user.id} }">
          <i class="fas fa-user-edit"></i> {{ $t('Edit') }}
        </router-link>

        <delete-button redirect="users.index" :url="`/users/${user.id}`" classes="list-group-item list-group-item-action">
          {{ $t('Delete') }}
        </delete-button>
      </div>
    </div>

    <div class="col-md-10">
      <transition appear name="slide-fade" mode="out-in">
        <router-view/>
      </transition>
    </div>
  </div>
</template>

<script>
import { fetchData } from '../../helpers'
import DeleteButton from "../../components/DeleteButton";

export default {
  name: "ShowRouter",
  components: {DeleteButton},
  data() {
    return {
      user: null,
      hasError: false,
      isLoading: false
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
      if (this.user === null) return ''

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
