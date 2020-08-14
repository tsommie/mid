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
            <th scope="col" style="width: 40%">{{ $t('Name') }}</th>
            <th scope="col" style="width: 25%">{{ $t('Email') }}</th>
            <th scope="col" style="width: 10%">{{ $t('Phone number') }}</th>
            <th scope="col" style="width: 10%">{{ $t('Deleted') }}</th>
            <th scope="col" style="width: 5%"></th>
            <th scope="col" style="width: 5%"></th>
          </tr>
        </thead>
        <tbody>
        <tr v-for="(organization, index) in organizations.data" :key="organization.id">
          <th scope="row">{{ ++index }}</th>
          <td>{{ organization.name }}</td>
          <td>{{ organization.email }}</td>
          <td>{{ organization.phone_number }}</td>
          <td>{{ organization.deleted_at | fromNow }}</td>
          <td>
            <button type="button" @click="onRestore(organization.id)" class="btn btn-light" data-dismiss="modal">
              <i class="fas fa-undo-alt"></i>
            </button>
          </td>
          <td>
            <button type="button" @click="onDelete(organization.id)" class="btn btn-danger" data-dismiss="modal">
              <i class="fas fa-trash-alt"></i>
            </button>
          </td>
        </tr>
        </tbody>
      </table>

      <pagination :data="organizations" align="center" @pagination-change-page="fetchData"></pagination>
    </div>
  </div>
</template>

<script>
export default {
  name: "Trash",

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
    onRestore: function (id) {
      axios.put(`/deleted/organizations/${id}`).then(response => {
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
      axios.delete(`/deleted/organizations/${id}`).then(response => {
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

      axios.get('/deleted/organizations?page='+page).then(response => {

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
      axios.get(`/deleted/organizations?search=${escape(search)}`)
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
