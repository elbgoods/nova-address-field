<template>
  <span class="inline-block">
    <div
      v-for="(fieldProps, fieldKey) in field.field_options"
      :key="fieldKey"
    >
      <span class="text-80 leading-tight">{{ fieldProps.label }}:&nbsp;</span>
      <span>{{ address[fieldKey] }}</span>
    </div>
  </span>
</template>

<script>
export default {
  props: {
    resourceName: {
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
