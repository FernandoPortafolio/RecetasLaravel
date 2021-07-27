<template>
  <input type="submit" value="Eliminar" class="btn btn-danger btn-sm" @click="eliminarReceta" />
</template>

<script>
  export default {
    props: ['recetaId'],
    methods: {
      eliminarReceta() {
        this.$swal({
          title: '¿Estas Seguro?',
          text: 'Esta acción no se puede deshacer!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Sí, Eliminar!',
          cancelButtonText: 'NO',
        }).then((result) => {
          if (result.isConfirmed) {
            axios
              .post(`/recetas/${this.recetaId}`, { _method: 'delete' })
              .then((resp) => {
                this.$swal(
                  'Eliminado',
                  'La receta ha sido eliminada.',
                  'success'
                );
                this.$el.parentNode.parentNode.parentNode.removeChild(
                  this.$el.parentNode.parentNode
                );
              })
              .catch(console.log);
          }
        });
      },
    },
  };
</script>