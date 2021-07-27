<template>
  <div>
    <span class="like-btn" @click="likeReceta" :class="{'like-active': isLiked}"></span>
    <p>{{cantLikes}} Les gustó esta receta</p>
  </div>
</template>

<script>
  export default {
    props: ['recetaId', 'like', 'likes'],
    data: function () {
      return {
        isLiked: this.like,
        cantLikes: this.likes,
      };
    },
    methods: {
      likeReceta() {
        axios
          .post(`/recetas/${this.recetaId}/like`)
          .then((resp) => {
            if (resp.data.attached.length > 0) this.cantLikes++;
            else this.cantLikes--;
          })
          .catch((error) => {
            if (error.response.status === 401) {
              window.location = '/register';
            }
          });
        this.isLiked = !this.isLiked;
      },
    },
  };
</script>