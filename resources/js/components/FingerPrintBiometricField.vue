<template>
  <div class="">
    <h6>{{ title }}</h6>

    <div class="row mb-3">

      <div class="col-md-2">
        <finger-image-upload :slug="prepSlug('Thumb')"
                             @image-selected="onThumbSelected" :title="$t('Thumb')"></finger-image-upload>
      </div>

      <div class="col-md-2">
        <finger-image-upload :slug="prepSlug('Index finger')"
                             @image-selected="onIndexFingerSelected" :title="$t('Index finger')"></finger-image-upload>
      </div>

      <div class="col-md-2">
        <finger-image-upload :slug="prepSlug('Middle finger')"
                             @image-selected="onMiddleFingerSelected" :title="$t('Middle finger')"></finger-image-upload>
      </div>

      <div class="col-md-2">
        <finger-image-upload :slug="prepSlug('Ring finger')"
                             @image-selected="onRingFingerSelected" :title="$t('Ring finger')"></finger-image-upload>
      </div>

      <div class="col-md-2">
        <finger-image-upload :slug="prepSlug('Pinky')"
                             @image-selected="onPinkySelected" :title="$t('Pinky')"></finger-image-upload>
      </div>
    </div>
  </div>
</template>

<script>
import FingerImageUpload from "./FingerImageUpload";
export default {
  name: "FingerPrintBiometricField",
  components: {FingerImageUpload},
  props: {
    title: {
      type: String,
      required: true
    },
  },

  data() {
    return {
      data: {
        thumb: '',
        index_finger: '',
        middle_finger: '',
        ring_finger: '',
        pinky: '',
      }
    }
  },

  methods: {
    prepSlug: function (title) {
      let string = this.title.replace(" ", "-") + '-' + title.replace(" ", "-")
      return string.toLowerCase()
    },

    onThumbSelected: function ({ image }) {
      this.data.thumb = image
      this.$emit('data-ready', { data: this.data })
    },

    onIndexFingerSelected: function ({ image }) {
      this.data.index_finger = image
      this.$emit('data-ready', { data: this.data })
    },

    onMiddleFingerSelected: function ({ image }) {
      this.data.middle_finger = image
      this.$emit('data-ready', { data: this.data })
    },

    onRingFingerSelected: function ({ image }) {
      this.data.ring_finger = image
      this.$emit('data-ready', { data: this.data })
    },

    onPinkySelected: function ({ image }) {
      this.data.pinky = image
      this.$emit('data-ready', { data: this.data })
    },
  }
}
</script>

<style scoped>

</style>
