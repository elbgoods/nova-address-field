<template>
  <div>
    <label
      for="search"
      class="inline-block text-80 leading-tight mb-1"
    >{{ label }}</label>
    <autocomplete
      id="search"
      :search="searchFunction"
      :class="'w-full'"
      :get-result-value="getResultValueFunction"
      :placeholder="label"
      :debounce-time="500"
      @submit="$emit('input', $event)"
    >
      <template
        #default="{inputProps, inputListeners, noResults, resultProps, resultListProps, resultListListeners, results}"
      >
        <div class="relative">
          <input
            type="text"
            class="w-full form-control form-input form-input-bordered mb-3"
            :placeholder="label"
            v-bind="inputProps"
            v-on="inputListeners"
          >
          <div
            v-if="noResults"
            class="absolute top-0 z-10 bg-white border rounded-lg p-2"
          >
            <span class="block p-2 text-90 text-sm rounded">
              No results found
            </span>
          </div>
          <div
            v-bind="resultListProps"
            class="place-autocomplete absolute top-0 z-10 bg-white rounded-lg p-2"
            v-on="resultListListeners"
          >
            <span
              v-if="noResults"
              class="block p-2 text-90 text-sm hover:bg-40 rounded"
            >
              No results found
            </span>
            <span
              v-for="(result, index) in results"
              :key="resultProps[index].id"
              v-bind="resultProps[index]"
              class="block p-2 text-90 text-sm hover:bg-40 rounded"
            >
              {{ result.title }}
            </span>
          </div>
        </div>
      </template>
    </autocomplete>
  </div>
</template>

<script>
import Autocomplete from '@trevoreyre/autocomplete-vue'

export default {
  components: { Autocomplete },
  props: {
    label: {
      type: String,
      required: true
    },
    searchFunction: {
      type: Function,
      required: true
    },
    getResultValueFunction: {
      type: Function,
      required: true
    }
  }
}
</script>

<style scoped>
  .place-autocomplete {
    border: 1px solid #c0c0c0;
  }
</style>
