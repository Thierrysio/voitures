<template>
  <div>
    <input :value="modelValue" @keyup.enter="onEnterPressed">
  </div>
</template>

<script>
export default {
  name: 'Exemple2',
  props: {
    modelValue: {
      type: String,
      default: ''
    }
  },
  methods: {
    onEnterPressed(event) {
      this.$emit('update:modelValue', event.target.value);
    }
  }
};
</script>
