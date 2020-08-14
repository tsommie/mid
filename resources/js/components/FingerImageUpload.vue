<template>
  <div class="row">
    <div class="col-12">
      <div class="mb-3">
        <figure class="figure">
          <!-- Button trigger modal -->
          <a href="#" role="button" data-toggle="modal" :data-target="`#modal-scan-${slug}`">
            <img :src="thumbnail" class="bd-placeholder-img rounded" width="100" height="100" />
          </a>
          <figcaption class="figure-caption">{{ title }}</figcaption>
        </figure>
        <!-- Modal -->
        <div class="modal fade" :id="`modal-scan-${slug}`" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-body">
                <figure class="figure">
                  <img :src="imagePreview" class="bd-placeholder-img rounded" width="100%" height="100%" />
                  <figcaption class="figure-caption">{{ title }}</figcaption>
                </figure>

                <div class="mb-3">
                  <div class="form-file">
                    <input type="file" @change="imageSelected" class="form-file-input" id="customFile">
                    <label class="form-file-label" for="customFile">
                      <span class="form-file-text">Choose file...</span>
                      <span class="form-file-button">Browse</span>
                    </label>
                  </div>
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ $t('Close') }}</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "FingerImageUpload",

  props: {
    title: {
      type: String,
      required: true
    },
    slug: {
      type: String,
      required: true
    },
  },

  data() {
    return {
      image: null,
      thumbnail: '/img/placeholders/thumbprint.png',
      imagePreview: '/img/placeholders/hand-scan.png'
    }
  },

  methods: {
    imageSelected: function(e) {
      this.image = e.target.files[0]

      let reader = new FileReader()
      reader.readAsDataURL(this.image)
      reader.onload = e => {
        this.imagePreview = e.target.result
        this.thumbnail = e.target.result
      }

      this.$emit('image-selected', { image: this.image })
    }
  }
}
</script>

<style scoped>

</style>
