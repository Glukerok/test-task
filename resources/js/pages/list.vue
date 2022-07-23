<template>
  <div class="container">

      <div class="d-flex justify-content-between">
          <h1>Список</h1>
          <div class="d-flex">
              <div class="mx-1">
                  <label for="paginationPages" class="form-label">Страница</label>
                  <select
                      @change="getAdsApi()"
                      v-model="page"
                      class="form-select"
                      id="paginationPages"
                  >
                      <option v-for="page_number in last_page" :value="page_number">{{ page_number }}</option>
                  </select>
              </div>
              <div class="mx-1">
                  <label for="AdsSort" class="form-label">Сортировка</label>
                  <select
                      @change="getAdsApi()"
                      v-model="sort"
                      class="form-select"
                      id="AdsSort"
                  >
                      <option value="priceASC">По цене (возрастание)</option>
                      <option value="priceDESC">По цене (убывание)</option>
                      <option value="dateASC">По дате создания (возрастание)</option>
                      <option value="dateDESC">По дате создания (убывание)</option>
                  </select>
              </div>
          </div>
      </div>
      <table class="table">
          <thead>
          <tr>
              <th scope="col">Title</th>
              <th scope="col">Price</th>
              <th scope="col">Photo</th>
              <th scope="col">Date</th>
          </tr>
          </thead>
          <tbody v-if="!loading">
          <tr style="cursor: pointer" v-for="ad in ads">
              <td @click="this.$router.push('/'+ad.id)">
                  {{ ad.title }}
              </td>
              <td @click="this.$router.push('/'+ad.id)">
                  {{ ad.price }}
              </td>
              <td>
                  <template v-if="ad.photo_preview != null">
                      <a :href="ad.photo_preview['url']">{{ ad.photo_preview['url'] }}</a>
                  </template>
              </td>
              <td @click="this.$router.push('/'+ad.id)">
                  {{ ad.created_at }}
              </td>
          </tr>
          </tbody>
      </table>
  </div>
</template>

<script>
import _api from '@/system/dataCore/_api';

export default {
    name: "list",
    data() {
        return {
            loading: false,
            ads: [],
            page: 1,
            sort: null,
            last_page: null,
        }
    },
    created() {
        this.getAdsApi()
    },
    methods: {
        //Api
        async getAdsApi() {
            this.loading = true;
            await _api.getAds({
                page: this.page,
                sort: this.sort,
            })
                .then((response) => {
                    this.loading = false;
                    this.ads = response.data.data;
                    this.last_page = response.data.last_page;
                }).catch((error) => {
                    this.loading = false;
                })
        }
    }
}
</script>
