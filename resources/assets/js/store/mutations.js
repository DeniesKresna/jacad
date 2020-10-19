export const mutations = {
    SET_DATA(state, payload){
        state.data = payload;  
    },
    LOADING_START(state){
        state.isLoading = true;
    },
    LOADING_FINISH(state){
        state.isLoading = false;
    }
 };