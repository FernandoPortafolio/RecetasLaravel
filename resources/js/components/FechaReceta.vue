<template>
    <p style="display:inline-block;">
      {{ formatDate }}
    </p>
</template>

<script>
export default {
    props: ['fecha'],
    computed: {
        formatDate(){
            return moment(this.fecha).locale('es').format('DD [de] MMMM [del] YYYY')
        }
    }
}
</script>