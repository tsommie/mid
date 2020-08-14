// ES6 Modules or TypeScript
import Swal from 'sweetalert2'
import moment from 'moment'
moment().format()

const mixin = {
  methods: {
    sweetAlert: function () {
      return Swal
    },

    hasSlot (name = 'default') {
      return !!this.$slots[ name ] || !!this.$scopedSlots[ name ];
    },
  },

  filters: {
    fromNow: function (value) {
      return moment(value).fromNow()
    },

    date: function (value) {
      return moment(value).format("dddd, MMMM Do YYYY, h:mm:ss a")
    }
  },
}

export default mixin
