<template>
  <div class="row">
    <div v-if="isLoading" class="col-12">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>

    <div v-else class="col-12">
      <div class="row">
        <div class="col-12">
          <!-- Project One -->
          <div class="row">
            <div class="col-md-7">
              <a href="#">
                <img class="img-fluid rounded mb-3 mb-md-0" src="http://placehold.it/700x300" alt="">
              </a>
            </div>
            <div class="col-md-5">
              <div class="pt-3">
                <h3>{{ organization.name }}</h3>
                <span class="text-muted small">{{ organization.created_at | date }}</span>
                <hr />
                <p>
                  {{ organization.description }}
                </p>
              </div>

              <div class="pt-3">
                <h3><i class="fas fa-phone"></i> {{ $t('Contact') }}</h3>

                <hr />

                <p>
                  <span class="font-weight-bold">{{ $t('Phone number') }}: </span>{{ organization.phone_number }} <br />
                  <span class="font-weight-bold">{{ $t('Email Address') }}: </span>{{ organization.email }} <br />
                </p>
              </div>

              <div class="pt-3">
                <h3><i class="fas fa-map-pin"></i> {{ $t('Address') }}</h3>

                <hr />

                <p>
                  <span class="font-weight-bold">{{ $t('Street') }}: </span>{{ organization.address.street }} <br />
                  <span class="font-weight-bold">{{ $t('Street 2') }}: </span>{{ organization.address.street_line_2 }} <br />
                  <span class="font-weight-bold">{{ $t('City') }}: </span>{{ organization.address.city }} <br />
                  <span class="font-weight-bold">{{ $t('Country') }}: </span>{{ organization.address.country }} <br />
                  <span class="font-weight-bold">{{ $t('Postal') }}: </span>{{ organization.address.postal }} <br />
                </p>
              </div>

              <div v-if="!isLoading" class="pt-3">
                <h3><i class="fas fa-user"></i> {{ $t('Administrator') }}</h3>

                <hr />

                <p>
                  <span class="font-weight-bold">{{ $t('Username') }}: </span>{{ organization.user.name }} <br />
                  <span class="font-weight-bold">{{ $t('Email') }}: </span>{{ organization.user.email }} <br />
                  <span class="font-weight-bold">{{ $t('Joined') }}: </span>{{ organization.user.created_at | date }} <br />
                </p>

                <router-link class="btn btn-block btn-sm btn-light" :to="{ name: 'users.show', params: {userId: organization.user.id} }">
                  {{ $t('View Administrator Profile') }}
                </router-link>
              </div>
            </div>
          </div>
          <!-- /.row -->

          <hr />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {fetchData} from '../../helpers'

export default {
  name: "Show",

  data() {
    return {
      organization: null,
      hasError: false,
      isLoading: true
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
    fetchData(`/Organizations/${to.params.organizationId}`, (data, error) => {
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
