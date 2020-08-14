<template>
  <div class="row">
    <div v-if="isLoading" class="col-12">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>

    <div v-else class="col-12 my-3">
      <div v-if="organization !== null" class="row">
        <div class="p-5 bg-white">
          <h1 class="h3">
            {{ organization.name }} <br />
            <small class="text-muted small">{{ organization.email }}</small>
          </h1>
        </div>
      </div>
    </div>

    <div v-if="organization !== null" class="col-md-2">
      <div class="list-group">
        <router-link class="list-group-item list-group-item-action" :to="{ name: 'organizations.show', params: {organizationId: organization.id} }" exact>
          <i class="fas fa-eye"></i> {{ $t('View') }}
        </router-link>

        <router-link class="list-group-item list-group-item-action" :to="{ name: 'organizations.edit', params: {organizationId: organization.id} }">
          <i class="fas fa-edit"></i> {{ $t('Edit') }}
        </router-link>

        <delete-button redirect="organizations.index" :url="`/organizations/${organization.id}`" classes="list-group-item list-group-item-action">
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
import DeleteButton from '../../components/DeleteButton'
import {fetchData} from '../../helpers'

export default {
  name: "ShowRouter",
  components: {DeleteButton},
  data() {
    return {
      organization: null,
      hasError: false,
      isLoading: false
    }
  },

  methods: {
    setData: function (organization, error) {
      if (error) {
        this.hasError = true
      }
      this.organization = organization
      this.isLoading = false
    },

    fetchOrganization: function () {
      fetchData(`/organizations/${this.$route.params.organizationId}`, (data, error) => {
        this.setData(data.organization, error)
      })
    }
  },

  beforeRouteEnter (to, from, next) {
    fetchData(`/organizations/${to.params.organizationId}`, (data, error) => {
      next(vm => {
        vm.isLoading = true
        vm.setData(data.organization, error)
      })
    })
  },

  // when route changes and this component is already rendered,
  // the logic will be slightly different.
  beforeRouteUpdate (to, from, next) {
    fetchData(`/organizations/${to.params.organizationId}`, (data, error) => {
      this.isLoading = true
      this.setData(data.organization, error)
      next()
    })
  },

  watch: {
    // call again the method if the route changes
    '$route': 'fetchOrganization'
  },

  created() {
    this.fetchOrganization()
  }
}
</script>

<style scoped>

</style>
