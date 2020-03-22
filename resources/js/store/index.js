export default {
    state: {
        categories: [],
    },
    getters: {
        getCategoriesFormGetters(state){ //take parameter state
            return state.categories.data
         },   
    },
    actions: {
        async allCategories(context){
            await  axios.get("app/controller/products/categories.php")
                    .then((res)=>{
                       
                        context.commit("categories",res.data) //categories will be run from mutation  
                    })
                    .catch((err)=>{
                        console.log(err)
                    })
        }
    },
    mutations: {
        categories(state,data) {
           return state.categories = data
        }, 
    }
}