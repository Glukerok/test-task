import service from './service';

export default {
    //Ad
    async getAd(id, data) {
        return await service.get("/api/ad/" + id, data)
    },
    async createAd(id, data) {
        return await service.post("/api/ad/", data)
    },
    async getAds(data) {
        return await service.get("/api/ad", data)
    },
}
