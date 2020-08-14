<template>
  <div class="row">
    <div v-if="isLoading" class="col-12">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>

    <div v-else class="col-12">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col" style="width: 5%">#</th>
            <th scope="col" style="width: 30%">{{ $t('Name') }}</th>
            <th scope="col" style="width: 30%">{{ $t('Email') }}</th>
            <th scope="col" style="width: 10%">{{ $t('Phone number') }}</th>
            <th scope="col" style="width: 10%">{{ $t('Created') }}</th>
            <th scope="col" style="width: 10%">{{ $t('Updated') }}</th>
            <th scope="col" style="width: 5%"></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(organization, index) in organizations.data" :key="organization.id">
            <th scope="row">{{ ++index }}</th>
            <td>{{ organization.name }}</td>
            <td>{{ organization.email }}</td>
            <td>{{ organization.phone_number }}</td>
            <td>{{ organization.created_at | fromNow }}</td>
            <td>{{ organization.updated_at | fromNow }}</td>
            <td>
              <router-link class="btn btn-primary btn-sm" :to="{ name: 'organizations.show', params: {organizationId: organization.id} }">
                <i class="fas fa-eye"></i>
              </router-link>
            </td>
          </tr>
        </tbody>
      </table>

      <pagination :data="organizations" align="center" @pagination-change-page="fetchData"></pagination>
    </div>
  </div>
</template>

<script>
import _ from "lodash";

export default {
  name: "Index",

  data() {
    return {
      placeholder: 'No result was returned.',
      isLoading: true,
      hasError: false,
      organizations: null,
      searchKey:  ''
    }
  },

  methods: {
    fetchData: function (page = 1) {
      this.isLoading = true
      this.placeholder = 'Searching...'

      axios.get('/organizations?page='+page).then(response => {

        this.organizations = response.data.organizations

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
      axios.get(`/organizations?search=${escape(search)}`)
        .then(response => {
          vm.organizations = response.data.organizations
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

</style>
