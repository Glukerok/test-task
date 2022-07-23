<template>
  <div class="container">
      <h2 class="text-center">Создание объявления</h2>

      <div class="d-flex flex-column">
          <label>Title</label>
          <input v-model="title">

          <label>Description</label>
          <textarea v-model="desc"></textarea>

          <label>Price</label>
          <input type="number" v-model="price">

          <label>Photos</label>
          <button @click="addPhoto()">Add Photo URL</button>
          <div class="d-flex" v-for="(photo, photoKey) in photos">
              <input v-model="photo.url">
              <button v-if="photo.is_preview == 0" @click="setMainPhoto(photoKey)">Main Photo</button>
          </div>
          <button @click="createAdApi()">Create</button>
      </div>

  </div>
</template>

<script>
import _api from '@/system/dataCore/_api';

export default {
    name: "create",
    data() {
        return {
            title: '',
            desc: '',
            price: 0,
            photos: [],
        }
    },
    methods: {
        addPhoto() {
            this.photos.push({
                'url': '',
                'is_preview': 0,
            })
        },
        setMainPhoto(key) {
            Object.keys(this.photos).forEach(key => {
                console.log(key)
                this.photos[key].is_preview = 0;
            });

            this.photos[key].is_preview = 1;
        },
        async createAdApi() {
            this.loading = true;
            await _api.createAd(
                this.$route.params.id,
                {
                    title: this.title,
                    desc: this.desc,
                    price: this.price,
                    photos: this.photos,
                }
            )
                .then((response) => {
                    //this.$router.push('/')
                })
                .catch((error) => {

                })
        },
    }
}
</script>
