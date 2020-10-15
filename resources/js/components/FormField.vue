<template>
  <default-field
    :field="field"
    :errors="errors"
    :show-help-text="showHelpText"
    class="pb-0"
  >
    <template slot="field">
      <here-address-search
        :value="value"
        :label="field.search_label"
        :api-key="field.api_key"
        :is-proxy="field.is_proxy"
        :api-url="field.api_url"
        :reference-point="field.here_at"
        :field-options="field.field_options"
        @latitude="emitLatitude"
        @longitude="emitLongitude"
        @input="setValue"
      />
      <div
        v-for="(fieldProps, fieldKey) in field.field_options"
        :key="fieldKey"
      >
        <label
          :for="getFieldId(fieldKey)"
          class="inline-block text-80 leading-tight mb-1"
        >{{ fieldProps.label }}</label>
        <input
          :id="getFieldId(fieldKey)"
          v-model="value[fieldKey]"
          type="text"
          class="w-full form-control form-input form-input-bordered mb-3"
          :class="errorClasses"
          :placeholder="fieldProps.label"
        >
      </div>
      <p
        v-if="hasError"
        class="my-2 text-danger"
      >
        {{ firstError }}
      </p>
    </template>
  </default-field>
</template>

<script>
/* global Nova */
import { FormField, HandlesValidationErrors } from 'laravel-nova'
import HereAddressSearch from './HereAddressSearch'

export default {
  components: { HereAddressSearch },
  mixins: [FormField, HandlesValidationErrors],
  props: {
    resourceName: {
      type: String,
      required: true
    },
    resourceId: {
      type: String,
      required: true
    },
    field: {
      type: Object,
      required: true
    }
  },
  methods: {
    getFieldId (fieldKey) {
      return this.field.name + ' ' + fieldKey
    },

    setValue ($event) {
      this.value = $event
      this.value.country_code = 'DE'
    },

    emitLatitude (latitude) {
      Nova.$emit(this.field.latitude + '-value', latitude)
    },

    emitLongitude (longitude) {
      Nova.$emit(this.field.longitude + '-value', longitude)
    },

    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue () {
      if (typeof this.field.value === 'object') {
        this.value = this.field.value || {}
      } else if (typeof this.field.value === 'string') {
        this.value = JSON.parse(this.field.value)
      } else {
        this.value = {}
      }

      this.value.country_code = 'DE'
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill (formData) {
      formData.append(this.field.attribute, JSON.stringify(this.value))
    }
  }
}
</script>
