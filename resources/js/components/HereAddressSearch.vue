<template>
  <address-search
    :label="label"
    :search-function="search"
    :get-result-value-function="getResultValue"
    @input="buildResult"
  />
</template>

<script>
/* global axios */
import AddressSearch from './AddressSearch'

export default {
  components: { AddressSearch },
  props: {
    value: {
      type: Array,
      required: true
    },
    label: {
      type: String,
      required: true
    },
    apiKey: {
      type: [String, null],
      default: null
    },
    isProxy: {
      type: Boolean,
      default: false
    },
    apiUrl: {
      type: String,
      default: 'https://discover.search.hereapi.com/v1/discover'
    },
    referencePoint: {
      type: String,
      required: true
    },
    fieldOptions: {
      type: Object,
      required: true
    }
  },
  methods: {
    async search (searchText) {
      if (!(this.apiKey || this.isProxy)) {
        console.error('Here api key or proxy not set')
        return []
      }

      try {
        const params = {
          q: searchText,
          at: this.referencePoint
        }

        if (this.apiKey) {
          params.apiKey = this.apiKey
        }

        const { data } = await axios.get(this.apiUrl, {
          params: params
        })

        if (data && data.items) {
          return data.items
        }

        return []
      } catch (e) {
        console.error(e)
        return []
      }
    },
    getResultValue (item) {
      return item.title
    },
    buildResult (hereResponse) {
      const result = {}

      const address = hereResponse.address
      const position = hereResponse.position

      for (const [key, value] of Object.entries(this.fieldOptions)) {
        if (address[value.here]) {
          result[key] = address[value.here]
        } else {
          result[key] = this.value[key]
        }
      }

      this.$emit('input', result)
      this.$emit('latitude', position.lat)
      this.$emit('longitude', position.lng)
    }
  }
}
</script>

<style scoped>

</style>
