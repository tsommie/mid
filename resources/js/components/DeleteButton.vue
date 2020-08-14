<template>
  <a href="#" @click.prevent="onDelete" :class="classes">
    <div v-if="isDeleting" style="height: 20px; width: 20px;" class="spinner-border text-dark" role="status">
      <span class="sr-only">Loading...</span>
    </div>
    <span v-else>
      <slot name="icon">
        <i class="fas fa-trash-alt"></i>
      </slot>
    </span>
    <slot></slot>
  </a>
</template>

<script>
import { passwordVerification } from '../helpers'

export default {
  name: "DeleteButton",

  props: {
    url: {
      type: String,
      required: true
    },

    redirect: {
      type: String,
      required: true
    },

    classes: {
      type: String,
      default: 'btn btn-danger btn-sm'
    }
  },

  data() {
    return {
      isDeleting: false
    }
  },

  methods: {
    onDelete: function () {
      this.isDeleting = true

      passwordVerification((data) => {
        if (data.value) {
          axios.delete(this.url).then(response => {
            this.sweetAlert().fire({
              text: response.data.message,
              icon: 'success',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Continue'
            }).then((result) => {
              if (result.value) {
                this.isDeleting = false
                this.$router.push({ name: this.redirect})
              }
            })
          }).finally(() => {
            this.isDeleting = false
          })
        }
        this.isDeleting = false
      })
    }
  }
}
</script>

<style scoped>

</style>
