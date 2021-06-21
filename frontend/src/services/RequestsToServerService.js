import * as API from "@/services/API";

export default {
  getData(api) {
    return API.apiClient.get(api);
  },
  postData(api, payload) {
    return API.apiClient.post(api, payload);
  },
  changeData(api, id, payload) {
    console.log(payload);
    return API.apiClient.patch(`${api}/${id}`, payload);
  },
  deleteData(api, id) {
    return API.apiClient.delete(`${api}/${id}`);
  },
};
