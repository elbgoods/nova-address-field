<template>
  <panel-item :field="field">
    <template slot="value">
      <div
        v-for="(fieldProps, fieldKey) in field.field_options"
        :key="fieldKey"
      >
        <span class="text-80 leading-tight">{{ fieldProps.label }}:&nbsp;</span>
        <span>{{ address[fieldKey] }}</span>
      </div>
    </template>
  </panel-item>
</template>

<script>
export default {
  props: {
    resource: {
      type: Object,
      required: true
    },
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
  computed: {
    address () {
      return this.field.value
    }
  }
}
</script>
