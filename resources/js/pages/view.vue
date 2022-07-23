<template>
  <div class="container" v-if="!loading">
      <h2>Title: {{ ad.title }}</h2>
      <p>Price: {{ ad.title }}</p>
      <p>Photo: <a :href="ad.photo_preview['url']">{{ ad.photo_preview['url'] }}</a></p>
      <p>Created_at: {{ ad.created_at }}</p>

      <div class="form-check">
          <input class="form-check-input" type="checkbox" v-model="desc" @change="getAdApi()" id="desc">
          <label class="form-check-label" for="desc">
              Description
          </label>
      </div>
      <p v-if="desc == true">{{ad.desc}}</p>

      <div class="form-check">
          <input class="form-check-input" type="checkbox" v-model="photos" @change="getAdApi()" id="photos">
          <label class="form-check-label" for="photos">
              Photos
          </label>
      </div>
      <ul v-if="photos == true">
          <li v-for="photo in ad.photos"><a :href="photo.url">{{photo.url}}</a></li>
      </ul>

  </div>
</template>

<script>
import _api from '@/system/dataCore/_api';

export default {
    name: "view",
    data() {
        return {
            loading: false,
            ad: [],

            desc: 0,
            photos: 0,
        }
    },
    created() {
        this.getAdApi();
    },
    methods: {
        async getAdApi() {
            this.loading = true;
            await _api.getAd(
                this.$route.params.id,
                {
                    'fields[desc]': this.desc ? 1 : 0,
                    'fields[photos]': this.photos ? 1 : 0,
                }
            )
                .then((response) => {
                    this.loading = false;
                    this.ad = response.data.ad;
                })
                .catch((error) => {
                    this.loading = false;
                })
        },
    }
}
</script>
