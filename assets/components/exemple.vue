<template>
    <h1>{{ greetingMessage }}</h1>
</template>

<script>
export default {
    name: 'exemple',
    props: {
        greetingMessage: {
            type: String,
            default: 'Salut Vue.js depuis Symfony 6!'
        }
    }
};
</script>

<style scoped>
h1 {
    color: blue;
}
</style>