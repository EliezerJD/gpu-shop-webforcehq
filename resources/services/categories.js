import ApiConnection from "./api";

export default  {

    getCategories() {
        return ApiConnection().get('/api/categories');
    }
}