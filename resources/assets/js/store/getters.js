import { state } from "./state";

export const getters= {
    urls: () => {
        return state.urls;
    },
    isLoading: () => {
        return state.isLoading;
    },
    isSidebar: () => {
        return state.isSidebar;
    },
    menus: () => {
        return state.menus;
    }
};